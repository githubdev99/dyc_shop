<script>
    $(document).ready(function () {
        load_cart();
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
</script>