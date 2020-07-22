<script>
	$(document).ready(function() {
		load_table();
    });
    
    function load_table() {
        $('#table_kategori').DataTable({
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
				$('.image-popup').magnificPopup({
					type:"image", closeOnContentClick:!0, closeBtnInside:!1, fixedContentPos:!0, mainClass:"mfp-no-margins mfp-with-zoom",
					image: {
						verticalFit: !0
					},
					zoom: {
						enabled: !0, duration: 300
					}
				});
			},
			"ajax": {
				"url": "<?= base_url() ?>json/admin/list-kategori-produk",
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
			url: '<?= base_url() ?>json/admin/get-kategori-produk',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="edit_kategori"] input[name="id_kategori"]').val(response.data.id_kategori);
					$('form[name="edit_kategori"] input[name="nama_kategori"]').val(response.data.nama_kategori);
					$('#editData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/get-kategori-produk',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				if (response.error == false) {
					$('form[name="delete_kategori"] #nama_kategori').text(response.data.nama_kategori);
					$('form[name="delete_kategori"] input[name="id_kategori"]').val(response.data.id_kategori);
					$('form[name="delete_kategori"] input[name="nama_kategori"]').val(response.data.nama_kategori);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>