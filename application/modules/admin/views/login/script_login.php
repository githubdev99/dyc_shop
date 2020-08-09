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
                        Swal.mixin({
                            toast: true,
                            position: "top",
                            showCloseButton: !0,
                            showConfirmButton: false,
                            timer: 4000,
                            onOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer)
                                toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                        }).fire({
                            icon: response.type,
                            title: response.text
                        });
                    } else {
                        Swal.mixin({
                            toast: true,
                            position: "top",
                            showCloseButton: !0,
                            showConfirmButton: false,
                            timer: 2000,
                            onOpen: (toast) => {
                                toast.addEventListener("mouseenter", Swal.stopTimer)
                                toast.addEventListener("mouseleave", Swal.resumeTimer)
                            }
                        }).fire({
                            icon: response.type,
                            title: response.text
                        }).then(function() {
                            window.location = response.callback;
                        });
                    }
                }
            });
        });
    });
</script>