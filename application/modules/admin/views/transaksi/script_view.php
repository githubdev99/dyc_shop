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
				"targets": [0,6],
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
				"url": "<?= base_url() ?>admin/transaksi/list_transaksi",
				"type": "POST",
				"dataType": "json",
				"error": function () {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
    }
</script>