<script>
    $(document).ready(function () {
        load_data();
    });

    function load_data() {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>home/list_pesanan",
            dataType: "json",
            success: function (response) {
                var data = response.data;

                if (response.error == false) {
                    $('#list_pesanan').html(data.html);
                } else {
                    <?= $setup_app['ajax_error'] ?>
                }
            }
        });
    }
</script>