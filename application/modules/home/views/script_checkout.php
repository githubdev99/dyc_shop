<script>
    $(document).ready(function () {
        load_cart();

        $.ajax({
            type: "post",
            url: "<?= base_url() ?>home/checkout/pengiriman",
            data: {
                destination: '<?= encrypt_text($setup_app['customer_session']->city_id) ?>'
            },
            beforeSend: function() {
                $('#loading').show();
            },
            dataType: "json",
            success: function (response) {
                var data = response.data;

                if (response.error == false) {
                    $('#loading').fadeOut('400');
                    $('#pengiriman').html(data.html);

                    $('.check_pengiriman').each(function () {
                        if ($(this).is(':checked')) {
                            var arr_biaya = $(this).data('biaya').split(':');
                            var total_transaksi = parseInt($('input[name="harga_transaksi"]').val()) + parseInt(arr_biaya[0]);
                            
                            $('#harga_ongkir').text(arr_biaya[1]);
                            $('#total_transaksi').text(formatRupiah(total_transaksi.toString(), 'Rp. '));

                            $('input[name="total_transaksi"]').val(total_transaksi);
                        }
                    });
                } else {
                    <?= $setup_app['ajax_error'] ?>
                }
            }
        });

        <?php if ($setup_app['count_pilih'] == 0): ?>
            Swal.fire({
                title: 'Warning!',
                icon: 'warning',
                html: 'Pilih produk sebelum ke checkout',
                showCloseButton: true,
                showConfirmButton: false
            }).then(function() {
                window.location = '<?= base_url() ?>home/cart';
            });
        <?php endif ?>
    });

    function load_cart() {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>home/checkout/order",
            data: {
                id_customer: '<?= encrypt_text($setup_app['customer_session']->id_customer) ?>'
            },
            dataType: "json",
            success: function (response) {
                var data = response.data;

                if (response.error == false) {
                    $('#order').html(data.html);
                } else {
                    <?= $setup_app['ajax_error'] ?>
                }
            }
        });
    }

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

    function check_kurir(kurir) {
        var arr_biaya = $(kurir).data('biaya').split(':');
        var total_transaksi = parseInt($('input[name="harga_transaksi"]').val()) + parseInt(arr_biaya[0]);

        $('#harga_ongkir').text(arr_biaya[1]);
        $('#total_transaksi').text(formatRupiah(total_transaksi.toString(), 'Rp. '));

        $('input[name="total_transaksi"]').val(total_transaksi);
    }
</script>