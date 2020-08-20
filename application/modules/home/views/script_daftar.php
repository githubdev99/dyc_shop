<script>
    $(document).ready(function () {
        $.ajax({
			url: '<?= base_url() ?>home/option_province',
			type: 'POST',
			dataType: 'json',
			success: function (response) {
                var data = response.data;
                
                console.log(data);

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
    });

    function match_password(value) {
        if ($('input[name="password"]').val()) {
            if ($('input[name="password"]').val() != value) {
                $('#text_not_match').show();
                $('button[name="daftar"]').attr('disabled');
            } else {
                $('#text_not_match').hide();
                $('button[name="daftar"]').removeAttr('disabled');
            }
        }
    }

    function number_only(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>