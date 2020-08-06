<script>
	var rupiah = document.getElementById("rupiah");
	rupiah.addEventListener("keyup", function (e) {
		rupiah.value = formatRupiah(this.value, "Rp. ");
	});

	function formatRupiah(angka, prefix) {
		var number_string = angka
				.replace(/[^,\d]/g, "")
				.toString(),
			split = number_string.split(","),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0]
				.substr(sisa)
				.match(/\d{3}/gi);

		if (ribuan) {
			separator = sisa
				? "."
				: "";
			rupiah += separator + ribuan.join(".");
		}

		rupiah = split[1] != undefined
			? rupiah + "," + split[1]
			: rupiah;
		return prefix == undefined
			? rupiah
			: rupiah
				? "Rp. " + rupiah
				: "";
	}

    function read_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.image-popup').attr('href', e.target.result);
				$('#preview_foto').attr('src', e.target.result);
				$('#remove_preview').show();
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

    $(document).ready(function () {
        <?php if (empty($get_data->id_kategori)): ?>
			$('#subKategori').hide();
		<?php endif ?>

        <?php if (empty($get_data->foto)): ?>
			$('#remove_preview').hide();
		<?php endif ?>

		$('input[name="foto"]').change(function() {
			document.getElementById('nama_foto').innerHTML = this.value.split('\\').pop().split('/').pop();
			read_image(this);
			if (this.value == '') {
				$('#preview_foto').attr('src', '<?= base_url() ?>assets/images/img-thumbnail.svg');
				$('#remove_preview').hide();
			}
		});

		$('#remove_preview').click(function() {
			document.getElementById('foto').value = '';
			document.getElementById('nama_foto').innerHTML = '';
			<?php if (!empty($get_data->foto)): ?>
				document.getElementById('foto_old').value = '';
			<?php endif ?>
			$('.image-popup').attr('href', '<?= base_url() ?>assets/images/img-thumbnail.svg');
			$('#preview_foto').attr('src', '<?= base_url() ?>assets/images/img-thumbnail.svg');
			$('#remove_preview').hide();
		});

        $('.image-popup').magnificPopup({
			type:"image", closeOnContentClick:!0, closeBtnInside:!1, fixedContentPos:!0, mainClass:"mfp-no-margins mfp-with-zoom",
			image: {
				verticalFit: !0
			},
			zoom: {
				enabled: !0, duration: 300
			}
		});

		$('.select2').each(function () {
			$(this).select2({
				placeholder: "Pilih salah satu"
			});
		});

		$.ajax({
			url: '<?= base_url() ?>json/admin/produk/option-kategori',
			type: 'POST',
			data: {
				id_kategori: '<?= (!empty($get_data->id_kategori)) ? encrypt_text($get_data->id_kategori) : ''; ?>'
			},
			dataType: 'json',
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('select[name="id_kategori"]').html(data.html);
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});

		<?php if (!empty($get_data->id_kategori)): ?>
			$.ajax({
				url: '<?= base_url() ?>json/admin/produk/option-sub-kategori',
				type: 'POST',
				data: {
					id_kategori: '<?= encrypt_text($get_data->id_kategori) ?>',
					id_sub_kategori: '<?= encrypt_text($get_data->id_sub_kategori) ?>'
				},
				dataType: 'json',
				success: function (response) {
					var data = response.data;

					if (response.error == false) {
						$('select[name="id_sub_kategori"]').html(data.html);
					} else {
						<?= $setup_app['ajax_error'] ?>
					}
				}
			});
		<?php endif ?>

		$('select[name="id_kategori"]').change(function (e) {
			e.preventDefault();

			if ($(this).val() != '' || $(this).val() != null) {
				$.ajax({
					url: '<?= base_url() ?>json/admin/produk/option-sub-kategori',
					type: 'POST',
					data: {id_kategori: $(this).val()},
					dataType: 'json',
					success: function (response) {
						var data = response.data;

						if (response.error == false) {
							$('#subKategori').show();
							$('select[name="id_sub_kategori"]').html(data.html);
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
</script>