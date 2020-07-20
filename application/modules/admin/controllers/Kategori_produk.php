<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$title = 'Kategori Produk';
		$data = [
			'setup_app' => $this->setup_app($title),
			'plugin' => ['datatable', 'sweetalert', 'magnific-popup'],
			'get_script' => 'script_view',
			'modal_delete' => '
			<form action="" method="post" enctype="multipart/form-data" name="delete_kategori">
                <div class="modal-content" style="border: none;">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title mt-0 text-white" id="myModalLabel">
                            <i class="fas fa-bookmark mr-3"></i>Konfirmasi Hapus Data Kategori
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <input type="hidden" name="id_kategori">
                            <input type="hidden" name="nama_kategori">
                            <h4>Anda yakin ingin menghapus data kategori <b>"<span id="nama_kategori"></span>"</b> ?</h4>
                            <p>Data yang sudah dihapus tidak dapat dikembalikan!</p>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="delete" value="delete" class="btn btn-danger waves-effect waves-light">
                            <i class="far fa-trash-alt mr-2"></i>Hapus Data
                        </button>
                        <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                    </div>
                </div>
            </form>'
		];

		$this->load->view('kategori_produk/view', $data);
	}

}

/* End of file Kategori_produk.php */