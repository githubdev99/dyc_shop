<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->not_login_customer();

		$title = 'Keranjang Belanja';
		$data = [
			'setup_app' => $this->setup_app($title),
			'get_view' => 'home/v_cart',
			'get_script' => 'home/script_cart'
		];

		if (!$this->input->post()) {
            $this->master->template_home($data);
        } else {
            $process = TRUE;

            if ($process == TRUE) {
				$check_data = $this->master_model->select_data([
					'field' => '*',
					'table' => 'cart',
					'where' => [
						'id_produk' => decrypt_text($this->input->post('id_produk')),
						'id_customer' => decrypt_text($this->input->post('id_customer'))
					]
				]);

				if (!empty($check_data->result())) {
					$query = $this->master_model->send_data([
						'where' => [
							'id_cart' => $check_data->row()->id_cart,
						],
						'data' => [
							'id_produk' => decrypt_text($this->input->post('id_produk')),
							'id_customer' => decrypt_text($this->input->post('id_customer')),
							'qty' => $this->input->post('qty') + $check_data->row()->qty
						],
						'table' => 'cart'
					]);
				} else {
					$query = $this->master_model->send_data([
						'data' => [
							'id_cart' => $this->master_model->generate_code('PC'),
							'id_produk' => decrypt_text($this->input->post('id_produk')),
							'id_customer' => decrypt_text($this->input->post('id_customer')),
							'qty' => $this->input->post('qty'),
							'status_pilih' => 'Y'
						],
						'table' => 'cart'
					]);
				}

				if ($query == FALSE) {
					$output = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'warning'
					];
				} else {
					$output = [
						'error' => false,
						'message' => 'berhasil'
					];
				}
			} else {
				$process = FALSE;
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
    }

    public function mini()
	{
		$this->param['field'] = 'cart.*, produk.nama_produk, produk.harga, produk.foto';
        $this->param['table'] = 'cart';
        $this->param['join'] = [
            [
                'table' => 'produk',
                'on' => 'produk.id_produk = cart.id_produk',
                'type' => 'inner'
            ]
        ];
		$this->param['where'] = [
			'id_customer' => decrypt_text($this->input->post('id_customer'))
		];
		$this->param['order_by'] = [
			'nama_produk' => 'asc'
        ];
        $this->param['limit'] = 3;

		$this->data['data_parsing'] = $this->master_model->select_data($this->param);

        $get_data = [];
		if (!empty($this->data['data_parsing']->result())) {
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

                $get_data['html'] = '
                <a href="#"></a>
                <i class="icon-bag"></i>
                <span class="count">'.$this->data['data_parsing']->num_rows().'</span>
                <span class="subtotal">'.rupiah($this->data['subtotal']).'</span>
                <div class="toolbar-dropdown">';

                foreach ($this->data['data_parsing']->result() as $key) {
                    $get_data['html'] .= '
                    <div class="dropdown-product-item">
                        <span class="dropdown-product-remove" onclick="delete_cart("'.encrypt_text($key->id_cart).'");"><i class="icon-cross"></i></span>
                        <a class="dropdown-product-thumb" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">
                            <img src="'.base_url().'assets/admin/images/upload/'.$key->foto.'">
                        </a>
                        <div class="dropdown-product-info">
                            <a class="dropdown-product-title" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">'.$key->nama_produk.'</a>
                            <span class="dropdown-product-details">'.$key->qty.' x '.rupiah($key->harga).'</span>
                        </div>
                    </div>
                    ';
                }
                
                $get_data['html'] .= '
                <div class="toolbar-dropdown-group">
                    <div class="column">
                        <span class="text-lg">Total:</span>
                    </div>
                    <div class="column text-right">
                        <span class="text-lg text-medium">'.rupiah($this->data['subtotal']).'</span>
                    </div>
                </div>
                <div class="toolbar-dropdown-group">
                    <div class="column">
                        <a class="btn btn-sm btn-block btn-secondary" href="'.base_url().'home/cart">View Cart</a>
                    </div>
                    <div class="column">
                        <a class="btn btn-sm btn-block btn-success" href="'.base_url().'home/checkout">Checkout</a>
                    </div>
                </div>
                </div>
                ';

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
        } else {
            $get_data['html'] = '
            <a href="#"></a>
            <i class="icon-bag"></i>
            <span class="count">0</span>
            <div class="toolbar-dropdown">
            <div class="dropdown-product-item">
                Keranjang belanja kosong...
            </div>
            </div>
            ';

            $this->data['output'] = [
                'error' => false,
                'data' => $get_data
            ];
        }

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}