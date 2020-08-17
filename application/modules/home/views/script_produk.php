<script>
    $(document).ready(function () {
        $('form[name="add_cart"]').submit(function (e) {
            e.preventDefault();
            
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.error == true) {
                        Swal.fire({
                            title: response.title,
                            icon: response.type,
                            html: response.text,
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        load_cart_mini();
                    }
                }
            });
        });
    });
</script>