<script>
    $(document).ready(function () {
        $.ajax({
			url: '<?= base_url() ?>home/produk_banner',
			type: 'POST',
			dataType: 'json',
			success: function (response) {
                var data = response.data;

				if (response.error == false) {
					$('#produk_banner').html(data.html);
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
        });
    });
</script>