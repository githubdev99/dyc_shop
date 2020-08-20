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

    function check_kurir(kurir) {
        var arr_biaya = $(kurir).data('biaya').split(':');
        $('#biaya_pengiriman').text(arr_biaya[1]);
    }
</script>