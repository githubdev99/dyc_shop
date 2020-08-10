<script>
    $(document).ready(function () {
        $('form[name="login"]').submit(function (e) {
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
                        Swal.fire({
                            title: response.title,
                            icon: response.type,
                            html: response.text,
                            timer: 2000,
                            showCloseButton: true,
                            showConfirmButton: false
                        }).then(function() {
                            window.location = response.callback;
                        });

                        $('button[name="login"]').addClass('disabled');
                    }
                }
            });
        });
    });
</script>