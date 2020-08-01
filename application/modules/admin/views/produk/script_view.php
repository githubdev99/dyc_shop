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
				"targets": [ 0, 1, 6 ],
				"orderable": false
			},
			{
				"targets": 4,
				"createdCell":  function (td, cellData, rowData, row, col) {
					$(td).attr('width', '15%');
				}
			},
			{
				"targets": 6,
				"createdCell":  function (td, cellData, rowData, row, col) {
					$(td).attr('width', '20%');
				}
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
				"url": "<?= base_url() ?>json/admin/produk/list",
				"type": "POST",
				"dataType": "json",
				"error": function () {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
    }

	function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>json/admin/produk/get',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="delete_produk"] #nama_produk').text(data.nama_produk);
					$('form[name="delete_produk"] input[name="id_produk"]').val(data.id_produk);
					$('form[name="delete_produk"] input[name="nama_produk"]').val(data.nama_produk);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>