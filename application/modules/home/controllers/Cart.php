<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {

    private $data = [];
	private $param = [];

	public function __construct()
	{
		parent::__construct();
		$this->not_login_customer();
	}

	public function index()
	{
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
				$this->db->trans_start();
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

				$stok = $this->master_model->select_data([
					'field' => 'stok',
					'table' => 'produk',
					'where' => [
						'id_produk' => decrypt_text($this->input->post('id_produk'))
					]
				])->row()->stok;

				$query2 = $this->master_model->send_data([
					'where' => [
						'id_produk' => decrypt_text($this->input->post('id_produk')),
					],
					'data' => [
						'stok' => $stok - $this->input->post('qty')
					],
					'table' => 'produk'
				]);

				if ($query == FALSE || $query2 == FALSE) {
					$output = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'warning'
					];
				} else {
					$output = [
						'error' => false
					];
				}
				$this->db->trans_complete();
			} else {
				$process = FALSE;
			}

			$this->output->set_content_type('application/json')->set_output(json_encode($output));
        }
	}

    public function mini()
	{
		$process = TRUE;

		if ($this->input->post('submit') == 'delete') {
			if ($process == TRUE) {
				$this->db->trans_start();
				$get_cart = $this->master_model->select_data([
					'field' => '*, produk.stok',
					'table' => 'cart',
					'join' => [
						[
							'table' => 'produk',
							'on' => 'produk.id_produk = cart.id_produk',
							'type' => 'inner'
						],
					],
					'where' => [
						'id_cart' => decrypt_text($this->input->post('id_cart'))
					]
				])->row();

				$query = $this->master_model->send_data([
					'where' => [
						'id_produk' => decrypt_text($this->input->post('id_produk')),
					],
					'data' => [
						'stok' => $get_cart->stok + $get_cart->qty
					],
					'table' => 'produk'
				]);

				$query2 = $this->master_model->delete_data([
					'where' => [
						'id_cart' => decrypt_text($this->input->post('id_cart'))
					],
					'table' => 'cart'
				]);

				if ($query == FALSE || $query2 == FALSE) {
					$this->data['output'] = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'error'
					];
				} else {
					$this->data['output'] = [
						'error' => false,
						'title' => 'Successfull!',
						'text' => 'Produk berhasil dihapus dari keranjang',
						'type' => 'success'
					];
				}
				$this->db->trans_complete();
			} else {
				$process = FALSE;
			}
		} else {
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
					$this->data['count_pilih'] = $this->master_model->select_data([
						'field' => '*',
						'table' => 'cart',
						'where' => [
							'id_customer' => decrypt_text($this->input->post('id_customer')),
							'status_pilih' => 'Y'
						]
					])->num_rows();

					$get_data['html'] = '
					<a href="#"></a>
					<i class="icon-bag"></i>
					<span class="count">'.$this->data['data_parsing']->num_rows().'</span>
					<span class="subtotal">'.rupiah($this->data['subtotal']).'</span>
					<div class="toolbar-dropdown">';

					foreach ($this->data['data_parsing']->result() as $key) {
						$get_data['html'] .= '
						<div class="dropdown-product-item">
							<span class="dropdown-product-remove" onclick="delete_cart_mini('."'".encrypt_text($key->id_cart)."'".');"><i class="icon-cross"></i></span>
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
							<button type="button" class="btn btn-sm btn-block btn-primary" onclick="checkout('.$this->data['count_pilih'].');">Checkout</button>
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
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

	public function all()
	{
		$process = TRUE;

		if ($this->input->post('submit') == 'update') {
			if ($process == TRUE) {
				if (!empty($this->input->post('qty'))) {
					$data_update = [
						'qty' => $this->input->post('qty')
					];
				} elseif (!empty($this->input->post('status_pilih'))) {
					$data_update = [
						'status_pilih' => $this->input->post('status_pilih')
					];
				}

				$query = $this->master_model->send_data([
					'where' => [
						'id_cart' => decrypt_text($this->input->post('id_cart')),
					],
					'data' => $data_update,
					'table' => 'cart'
				]);
				if ($query == FALSE) {
					$this->data['output'] = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'warning'
					];
				} else {
					$this->data['output'] = [
						'error' => false
					];
				}
			} else {
				$process = FALSE;
			}
		} elseif ($this->input->post('submit') == 'delete') {
			if ($process == TRUE) {
				$this->db->trans_start();
				$get_cart = $this->master_model->select_data([
					'field' => '*, produk.stok',
					'table' => 'cart',
					'join' => [
						[
							'table' => 'produk',
							'on' => 'produk.id_produk = cart.id_produk',
							'type' => 'inner'
						],
					],
					'where' => [
						'id_cart' => decrypt_text($this->input->post('id_cart'))
					]
				])->row();

				$query = $this->master_model->send_data([
					'where' => [
						'id_produk' => decrypt_text($this->input->post('id_produk')),
					],
					'data' => [
						'stok' => $get_cart->stok + $get_cart->qty
					],
					'table' => 'produk'
				]);

				$query2 = $this->master_model->delete_data([
					'where' => [
						'id_cart' => decrypt_text($this->input->post('id_cart'))
					],
					'table' => 'cart'
				]);

				if ($query == FALSE || $query2 == FALSE) {
					$this->data['output'] = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'error'
					];
				} else {
					$this->data['output'] = [
						'error' => false,
						'title' => 'Successfull!',
						'text' => 'Produk berhasil dihapus dari keranjang',
						'type' => 'success'
					];
				}
				$this->db->trans_complete();
			} else {
				$process = FALSE;
			}
		} elseif ($this->input->post('submit') == 'delete_all') {
			if ($process == TRUE) {
				$query = $this->master_model->delete_data([
					'where' => [
						'id_customer' => decrypt_text($this->input->post('id_customer'))
					],
					'table' => 'cart'
				]);
				if ($query == FALSE) {
					$this->data['output'] = [
						'error' => true,
						'title' => 'Failed!',
						'text' => 'Ada kesalahan teknis!',
						'type' => 'error'
					];
				} else {
					$this->data['output'] = [
						'error' => false,
						'title' => 'Successfull!',
						'text' => 'Produk berhasil dihapus dari keranjang',
						'type' => 'success'
					];
				}
			} else {
				$process = FALSE;
			}
		} else {
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
				'id_customer' => decrypt_text($this->input->post('id_customer'))
			];
			$this->param['order_by'] = [
				'nama_produk' => 'asc'
			];

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

					$this->data['count_pilih'] = $this->master_model->select_data([
						'field' => '*',
						'table' => 'cart',
						'where' => [
							'id_customer' => decrypt_text($this->input->post('id_customer')),
							'status_pilih' => 'Y'
						]
					])->num_rows();

					$get_data['html'] = '
					<div class="table-responsive shopping-cart">
						<table class="table">
							<thead>
							<tr>
								<th></th>
								<th>Nama Produk</th>
								<th class="text-center">Quantity</th>
								<th class="text-center">Subtotal</th>
								<th class="text-center">
									<button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_cart_all();">Empty Cart</button>
								</th>
							</tr>
							</thead>
							<tbody>
					';

					foreach ($this->data['data_parsing']->result() as $key) {
						$checked = ($key->status_pilih == 'Y') ? 'checked' : '';

						$get_data['html'] .= '
						<tr>
							<td>
								<div class="custom-control custom-checkbox">
									<input class="custom-control-input" type="checkbox" id="check_'.encrypt_text($key->id_cart).'" '.$checked.' onclick="check('."'".encrypt_text($key->id_cart)."'".');">
									<label class="custom-control-label" for="check_'.encrypt_text($key->id_cart).'"></label>
								</div>
							</td>
							<td>
								<div class="product-item">
									<a class="product-thumb" href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">
										<img src="'.base_url().'assets/admin/images/upload/'.$key->foto.'">
									</a>
									<div class="product-info">
										<h4 class="product-title"><a href="'.base_url().'home/produk/detail/'.encrypt_text($key->id_produk).'">'.$key->nama_produk.'</a></h4>
										<span><em>Harga Satuan:</em> '.rupiah($key->harga).'</span><span><em>Stok Tersisa:</em> '.$key->stok.'</span>
									</div>
								</div>
							</td>
							<td class="text-center">
								<button class="btn btn-rounded btn-sm btn-secondary" type="button" onclick="set_qty('."'minus'".", '".encrypt_text($key->id_cart)."', ".$key->stok.", ".$key->qty.')" style="margin-right: 20px;"><i class="fa fa-minus"></i></button>
								<span style="font-size: large;" id="qty_'.encrypt_text($key->id_cart).'">'.$key->qty.'</span>
								<button class="btn btn-rounded btn-sm btn-secondary" type="button" onclick="set_qty('."'plus'".", '".encrypt_text($key->id_cart)."', ".$key->stok.", ".$key->qty.')" style="margin-left: 20px;"><i class="fa fa-plus"></i></button>
							</td>
							<td class="text-center text-lg text-medium">'.rupiah($key->qty * $key->harga).'</td>
							<td class="text-center">
								<a class="remove-from-cart" href="javascript:;" data-toggle="tooltip" title="Remove item" onclick="delete_cart('."'".encrypt_text($key->id_cart)."'".');"><i class="icon-cross"></i></a>
							</td>
						</tr>
						';
					}
					
					$get_data['html'] .= '
					</tbody>
						</table>
					</div>
					<div class="shopping-cart-footer">
						<div class="column text-lg">Total: <span class="text-medium">'.rupiah($this->data['subtotal']).'</span></div>
					</div>
					<div class="shopping-cart-footer">
						<div class="column">
							<a class="btn btn-outline-secondary" href="'.base_url().'home/produk"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a>
						</div>
						<div class="column">
							<button type="button" class="btn btn-success" onclick="checkout('.$this->data['count_pilih'].');">Checkout</button>
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
				<h4>Keranjang Belanja Anda Kosong...</h4>
				';

				$this->data['output'] = [
					'error' => false,
					'data' => $get_data
				];
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($this->data['output']));
	}

}