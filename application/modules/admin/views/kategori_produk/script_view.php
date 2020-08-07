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
				"url": "<?= base_url() ?>admin/kategori_produk/list_kategori_produk",
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
			url: '<?= base_url() ?>admin/kategori_produk/get_kategori_produk',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;
				
				if (response.error == false) {
					$('form[name="edit_kategori"] input[name="id_kategori"]').val(data.id_kategori);
					$('form[name="edit_kategori"] input[name="nama_kategori"]').val(data.nama_kategori);
					$('#editData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>admin/kategori_produk/get_kategori_produk',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="delete_kategori"] #nama_kategori').text(data.nama_kategori);
					$('form[name="delete_kategori"] input[name="id_kategori"]').val(data.id_kategori);
					$('form[name="delete_kategori"] input[name="nama_kategori"]').val(data.nama_kategori);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>