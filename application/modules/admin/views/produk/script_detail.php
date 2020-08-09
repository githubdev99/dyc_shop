<script>
    $(document).ready(function () {
        $('.image-popup').magnificPopup({
			type:"image", closeOnContentClick:!0, closeBtnInside:!1, fixedContentPos:!0, mainClass:"mfp-no-margins mfp-with-zoom",
			image: {
				verticalFit: !0
			},
			zoom: {
				enabled: !0, duration: 300
			}
		});
    });

	function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>admin/produk/get_produk',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="delete_produk"] #nama_produk').text(data.nama_produk);
					$('form[name="delete_produk"] input[name="id_produk"]').val(data.id_produk);
					$('form[name="delete_produk"] input[name="nama_produk"]').val(data.nama_produk);
					$('form[name="delete_produk"] input[name="foto"]').val(data.foto);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>