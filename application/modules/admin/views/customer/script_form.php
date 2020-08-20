<script>
    $(document).ready(function () {
        $.ajax({
			url: '<?= base_url() ?>admin/customer/option_province',
			type: 'POST',
			data: {
				province_id: '<?= (!empty($get_data->province_id)) ? encrypt_text($get_data->province_id) : ''; ?>'
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
		
		<?php if (!empty($get_data->province_id)): ?>
			$.ajax({
				url: '<?= base_url() ?>admin/customer/option_city',
				type: 'POST',
				data: {
					province_id: '<?= encrypt_text($get_data->province_id) ?>',
					city_id: '<?= encrypt_text($get_data->city_id) ?>'
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
				url: '<?= base_url() ?>admin/customer/option_subdistrict',
				type: 'POST',
				data: {
					city_id: '<?= encrypt_text($get_data->city_id) ?>',
					subdistrict_id: '<?= encrypt_text($get_data->subdistrict_id) ?>'
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

		$('select[name="province_id"]').change(function (e) {
			e.preventDefault();

			if ($(this).val() != '' || $(this).val() != null) {
				$.ajax({
					url: '<?= base_url() ?>admin/customer/option_city',
					type: 'POST',
					data: {province_id: $(this).val()},
					dataType: 'json',
					success: function (response) {
						var data = response.data;

						if (response.error == false) {
							$('select[name="city_id"]').html(data.html);
							$('select[name="subdistrict_id"]').html('');
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
					url: '<?= base_url() ?>admin/customer/option_subdistrict',
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
        
        $('.select2').each(function () {
			$(this).select2({
				placeholder: "Pilih salah satu"
			});
		});
    });

    function match_password(value) {
        if ($('input[name="password"]').val()) {
            if ($('input[name="password"]').val() != value) {
                $('#text_not_match').show();
                $('button[name="insert"]').attr('disabled');
            } else {
                $('#text_not_match').hide();
                $('button[name="insert"]').removeAttr('disabled');
            }
        }
    }
</script>