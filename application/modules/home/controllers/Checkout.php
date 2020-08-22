<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
		$this->not_login_customer();
	}

    public function index()
	{
		$title = 'Checkout';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_checkout',
			'get_script' => 'home/script_checkout'
		];

		if (!$this->input->post()) {
            $this->master->template_home($data);
        } else {
            $process = TRUE;

            if ($this->input->post('checkout')) {
                if ($process == TRUE) {
                    $this->db->trans_start();

                    $param['field'] = '*';
                    $param['table'] = 'cart';
                    $param['where'] = [
                        'id_customer' => $this->session->userdata('customer')['id'],
                        'status_pilih' => 'Y'
                    ];

                    $data_parsing = $this->master_model->select_data($param);

                    $id_transaksi = $this->master_model->generate_code('T');

                    $total_qty = 0;
                    foreach ($data_parsing->result() as $key) {
                        $this->master_model->send_data([
                            'data' => [
                                'id_transaksi_detail' => $this->master_model->generate_code('TD'),
                                'id_transaksi' => $id_transaksi,
                                'id_produk' => $key->id_produk,
                                'qty' => $key->qty
                            ],
                            'table' => 'transaksi_detail'
                        ]);

                        $total_qty += $key->qty;
                    }

                    $data_pengiriman = explode(':', $this->input->post('pengiriman'));

                    $query = $this->master_model->send_data([
                        'data' => [
                            'id_transaksi' => $id_transaksi,
                            'id_customer' => $this->session->userdata('customer')['id'],
                            'no_order' => $this->master_model->generate_code('INV'),
                            'total_qty' => $total_qty,
                            'harga_transaksi' => $this->input->post('harga_transaksi'),
                            'ongkir' => $data_pengiriman[0],
                            'jenis_ongkir' => $data_pengiriman[1],
                            'etd_ongkir' => $data_pengiriman[2],
                            'harga_ongkir' => $data_pengiriman[3],
                            'total_transaksi' => $this->input->post('total_transaksi'),
                            'status' => 'Belum Dibayar',
                        ],
                        'table' => 'transaksi'
                    ]);

                    
                    if ($query == FALSE) {
                        $this->alert_popup2([
                            'name' => 'failed',
                            'swal' => [
                                'title' => 'Successfull!',
                                'text' => 'Pesanan gagal dibuat, silahkan coba lagi!',
                                'type' => 'error'
                            ]
                        ]);
                        redirect(base_url().'home/checkout','refresh');
                    } else {
                        $this->alert_popup2([
                            'name' => 'success',
                            'swal' => [
                                'title' => 'Successfull!',
                                'text' => 'Pesanan berhasil dibuat, mohon tunggu!',
                                'type' => 'success'
                            ]
                        ]);
                        redirect(base_url().'home','refresh');
                    }

                    $this->db->trans_complete();
                }
            } else {
                $process = FALSE;
            }
        }
	}
    
    public function order()
	{
        $this->param['field'] = 'cart.*, produk.nama_produk, produk.harga, produk.stok, produk.foto';
        $this->param['table'] = 'cart';
        $this->param['join'] = [
            [
                'table' => 'produk',
                'on' => 'produk.id_produk = cart.id_produk',
                'type' => 'inner'
            ]
        ];
        $this->param['where'] = [
            'id_customer' => decrypt_text($this->input->post('id_customer')),
            'status_pilih' => 'Y'
        ];
        $this->param['order_by'] = [
            'nama_produk' => 'asc'
        ];

        $this->data['data_parsing'] = $this->master_model->select_data($this->param);

        $get_data = [];
        if ($this->data['data_parsing'] == FALSE) {
            $this->data['output'] = [
                'error' => true,
                'data' => $get_data
            ];
        } else {
            $this->data['subtotal'] = $this->master_model->select_data([
                'field' => 'SUM(cart.qty * produk.harga) AS subtotal',
                'table' => 'cart',
                'join' => [
                    [
                        'table' => 'produk',
                        'on' => 'produk.id_produk = cart.id_produk',
                        'type' => 'inner'
                    ]
                ],
                'where' => [
                    'id_customer' => decrypt_text($this->input->post('id_customer'))
                ]
            ])->row()->subtotal;

            $this->data['count_pilih'] = $this->master_model->select_data([
                'field' => '*',
                'table' => 'cart',
                'where' => [
                    'id_customer' => decrypt_text($this->input->post('id_customer')),
                    'status_pilih' => 'Y'
                ]
            ])->num_rows();

            $get_data['html'] = '
            <table class="table">
                <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th class="text-center">Subtotal</th>
                </tr>
                </thead>
                <tbody>
            ';

            foreach ($this->data['data_parsing']->result() as $key) {
                $get_data['html'] .= '
                <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">
                                <img src="'.base_url().'assets/admin/images/upload/'.$key->foto.'">
                            </a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">'.$key->nama_produk.'</a><small>x '.$key->qty.'</small></h4>
                                <span><em>Harga Satuan:</em> '.rupiah($key->harga).'</span><span><em>Stok Tersisa:</em> '.$key->stok.'</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium">'.rupiah($key->qty * $key->harga).'</td>
                </tr>
                ';
            }
            
            $get_data['html'] .= '
            </tbody>
            </table>
            ';

            $this->data['output'] = [
                'error' => false,
                'data' => $get_data
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }

    public function pengiriman()
    {
        $this->data['data_parsing'] = $this->rajaongkir->cost(decrypt_text($this->input->post('destination')));

        $get_data = [];
        if ($this->data['data_parsing']->rajaongkir->status->code == 400) {
            $this->data['output'] = [
                'error' => true,
                'data' => $get_data
            ];
        } else {
            $get_data['html'] = '
            <table class="table table-hover">
                    <thead class="thead-default">
                    <tr>
                        <th></th>
                        <th>Kurir</th>
                        <th>Estimasi</th>
                        <th>Biaya Ongkir</th>
                    </tr>
                    </thead>
                    <tbody>
            ';

            $i = 1;
            foreach ($this->data['data_parsing']->rajaongkir->results[0]->costs as $key) {
                $value = $this->data['data_parsing']->rajaongkir->results[0]->name.':'.$key->description.' ('.$key->service.'):'.$key->cost[0]->etd.' Hari:'.$key->cost[0]->value;
                $checked = ($i == 1) ? 'checked' : '';

                $get_data['html'] .= '
                <tr>
                    <td class="align-middle">
                        <div class="custom-control custom-radio mb-0">
                            <input class="custom-control-input check_pengiriman" type="radio" id="'.$key->service.'" name="pengiriman" data-biaya="'.$key->cost[0]->value.':'.rupiah($key->cost[0]->value).'" value="'.$value.'" onchange="check_kurir('."'#".$key->service."'".');" '.$checked.' required>
                            <label class="custom-control-label" for="'.$key->service.'"></label>
                        </div>
                    </td>
                    <td class="align-middle"><span class="text-medium">'.$this->data['data_parsing']->rajaongkir->results[0]->name.'</span><br><span class="text-muted text-sm">'.$key->description.' ('.$key->service.')</span></td>
                    <td class="align-middle">'.$key->cost[0]->etd.' Hari</td>
                    <td class="align-middle">'.rupiah($key->cost[0]->value).'</td>
                </tr>
                ';

                $i++;
            }
            
            $get_data['html'] .= '
            </tbody>
            </table>
            ';

            $this->data['output'] = [
                'error' => false,
                'data' => $get_data
            ];
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
    }

}