<script>
	$(document).ready(function() {
		load_table();
    });
    
    function load_table() {
        $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
            "pagingType": "full_numbers",
            "destroy": true,
			"order": [],
			"columnDefs": [
			{
				"targets": [ 0, 2 ],
				"orderable": false
			}],
			"drawCallback": function (settings) {
				$('[data-toggle="tooltip"]').tooltip();
			},
			"ajax": {
				"url": "<?= base_url() ?>json/admin/sub-kategori-produk/list",
				"type": "POST",
				"dataType": "json",
				"error": function () {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
    }

	function modal_edit(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/sub-kategori-produk/get',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="edit_sub_kategori"] input[name="id_sub_kategori"]').val(response.data.id_sub_kategori);
					$('form[name="edit_sub_kategori"] input[name="nama_sub_kategori"]').val(response.data.nama_sub_kategori);
					$('#editData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/sub-kategori-produk/get',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="delete_sub_kategori"] #nama_sub_kategori').text(response.data.nama_sub_kategori);
					$('form[name="delete_sub_kategori"] input[name="id_sub_kategori"]').val(response.data.id_sub_kategori);
					$('form[name="delete_sub_kategori"] input[name="nama_sub_kategori"]').val(response.data.nama_sub_kategori);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_edit_kategori(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/kategori-produk/get',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="edit_kategori"] input[name="id_kategori"]').val(response.data.id_kategori);
					$('form[name="edit_kategori"] input[name="nama_kategori"]').val(response.data.nama_kategori);
					$('#editDataKategori').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_delete_kategori(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/kategori-produk/get',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="delete_kategori"] #nama_kategori').text(response.data.nama_kategori);
					$('form[name="delete_kategori"] input[name="id_kategori"]').val(response.data.id_kategori);
					$('form[name="delete_kategori"] input[name="nama_kategori"]').val(response.data.nama_kategori);
					$('#deleteDataKategori').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>