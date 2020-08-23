<script>
    $(document).ready(function () {
        $.ajax({
			url: '<?= base_url() ?>home/option_province',
            type: 'POST',
            data: {
				province_id: '<?= (!empty($setup_app['customer_session']->province_id)) ? encrypt_text($setup_app['customer_session']->province_id) : ''; ?>'
			},
			dataType: 'json',
			success: function (response) {
                var data = response.data;

				if (response.error == false) {
					$('select[name="province_id"]').html(data.html);
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
        });
        
        $('select[name="province_id"]').change(function (e) {
			e.preventDefault();

			if ($(this).val() != '' || $(this).val() != null) {
				$.ajax({
					url: '<?= base_url() ?>home/option_city',
					type: 'POST',
					data: {province_id: $(this).val()},
					dataType: 'json',
					success: function (response) {
						var data = response.data;

						if (response.error == false) {
							$('select[name="city_id"]').html(data.html);
							$('select[name="subdistrict_id"]').html('<option hidden>Pilih salah satu</option>');
						} else {
							<?= $setup_app['ajax_error'] ?>
						}
					}
				});
			} else {
				<?= $setup_app['ajax_error'] ?>
			}
		});

		$('select[name="city_id"]').change(function (e) {
			e.preventDefault();

			if ($(this).val() != '' || $(this).val() != null) {
				$.ajax({
					url: '<?= base_url() ?>home/option_subdistrict',
					type: 'POST',
					data: {city_id: $(this).val()},
					dataType: 'json',
					success: function (response) {
						var data = response.data;

						if (response.error == false) {
							$('select[name="subdistrict_id"]').html(data.html);
						} else {
							<?= $setup_app['ajax_error'] ?>
						}
					}
				});
			} else {
				<?= $setup_app['ajax_error'] ?>
			}
        });
        
        <?php if (!empty($setup_app['customer_session']->province_id)): ?>
			$.ajax({
				url: '<?= base_url() ?>home/option_city',
				type: 'POST',
				data: {
					province_id: '<?= encrypt_text($setup_app['customer_session']->province_id) ?>',
					city_id: '<?= encrypt_text($setup_app['customer_session']->city_id) ?>'
				},
				dataType: 'json',
				success: function (response) {
					var data = response.data;

					if (response.error == false) {
						$('select[name="city_id"]').html(data.html);
					} else {
						<?= $setup_app['ajax_error'] ?>
					}
				}
			});

			$.ajax({
				url: '<?= base_url() ?>home/option_subdistrict',
				type: 'POST',
				data: {
					city_id: '<?= encrypt_text($setup_app['customer_session']->city_id) ?>',
					subdistrict_id: '<?= encrypt_text($setup_app['customer_session']->subdistrict_id) ?>'
				},
				dataType: 'json',
				success: function (response) {
					var data = response.data;

					if (response.error == false) {
						$('select[name="subdistrict_id"]').html(data.html);
					} else {
						<?= $setup_app['ajax_error'] ?>
					}
				}
			});
		<?php endif ?>
    });
</script>