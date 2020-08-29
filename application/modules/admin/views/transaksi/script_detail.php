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
				"targets": 0,
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
				"url": "<?= base_url() ?>admin/transaksi/list_transaksi_produk",
				"type": "POST",
				"data": {
					"id_transaksi": '<?= encrypt_text($get_data->id_transaksi) ?>'
				},
				"dataType": "json",
				"error": function () {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
    }

	function modal_confirm(id) {
		$.ajax({
			url: '<?= base_url() ?>admin/transaksi/get_konfirmasi',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="konfirmasi"] input[name="id_transaksi"]').val(id);
					$('form[name="konfirmasi"] #nama_bank').text(data.nama_bank);
					$('form[name="konfirmasi"] #no_rek').text(data.no_rek);
					$('form[name="konfirmasi"] #atas_nama').text(data.atas_nama);
					$('form[name="konfirmasi"] #foto_bukti').attr('src', '<?= base_url() ?>assets/home/images/upload/'+data.foto_bukti);
					$('#confirmData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}

	function modal_view_confirm(id) {
		$.ajax({
			url: '<?= base_url() ?>admin/transaksi/get_konfirmasi',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="lihat_konfirmasi"] #nama_bank').text(data.nama_bank);
					$('form[name="lihat_konfirmasi"] #no_rek').text(data.no_rek);
					$('form[name="lihat_konfirmasi"] #atas_nama').text(data.atas_nama);
					$('form[name="lihat_konfirmasi"] #foto_bukti').attr('src', '<?= base_url() ?>assets/home/images/upload/'+data.foto_bukti);
					$('#viewConfirmData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>