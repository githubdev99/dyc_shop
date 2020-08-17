<script>
    $(document).ready(function () {
        load_cart();
    });

    function load_cart() {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>home/cart/all",
            data: {
                id_customer: '<?= encrypt_text($setup_app['customer_session']->id_customer) ?>'
            },
            dataType: "json",
            success: function (response) {
                var data = response.data;

                if (response.error == false) {
                    $('#cart_all').html(data.html);
                } else {
                    <?= $setup_app['ajax_error'] ?>
                }
            }
        });
    }

    function delete_cart(id_cart) {
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Ingin menghapus produk ini di keranjang?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#8a8a8a',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>home/cart/all",
                    data: {
                        submit: 'delete',
                        id_cart: id_cart
                    },
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;

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
                            });
                            
                            load_cart();
                            load_cart_mini();
                        }
                    }
                });
            }
        });
    }

    function delete_cart_all() {
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Ingin menghapus semua produk di keranjang?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#8a8a8a',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>home/cart/all",
                    data: {
                        submit: 'delete_all',
                        id_cart: '<?= encrypt_text($setup_app['customer_session']->id_customer) ?>'
                    },
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;

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
                            });
                            
                            load_cart();
                            load_cart_mini();
                        }
                    }
                });
            }
        });
    }

    function set_qty(param, id_cart, stok, qty) {
        if (param == 'plus') {
            if (qty < stok) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>home/cart/all",
                    data: {
                        submit: 'update',
                        id_cart: id_cart,
                        qty: qty + 1
                    },
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;

                        if (response.error == true) {
                            Swal.fire({
                                title: response.title,
                                icon: response.type,
                                html: response.text,
                                showCloseButton: true,
                                showConfirmButton: false
                            });
                        } else {
                            // Do Nothing
                        }
                    }
                });
            }
        } else {
            if (qty > 1) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>home/cart/all",
                    data: {
                        submit: 'update',
                        id_cart: id_cart,
                        qty: qty - 1
                    },
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;

                        if (response.error == true) {
                            Swal.fire({
                                title: response.title,
                                icon: response.type,
                                html: response.text,
                                showCloseButton: true,
                                showConfirmButton: false
                            });
                        } else {
                            // Do Nothing
                        }
                    }
                });
            }
        }

        load_cart();
    }

    function check(id_cart) {
        if ($('#check_'+id_cart).is(':checked')) {
            var status_pilih = 'Y';
        } else {
            var status_pilih = 'T';
        }

        $.ajax({
            type: "post",
            url: "<?= base_url() ?>home/cart/all",
            data: {
                submit: 'update',
                id_cart: id_cart,
                status_pilih: status_pilih
            },
            dataType: "json",
            success: function (response) {
                var data = response.data;

                if (response.error == true) {
                    Swal.fire({
                        title: response.title,
                        icon: response.type,
                        html: response.text,
                        showCloseButton: true,
                        showConfirmButton: false
                    });
                } else {
                    // Do Nothing
                }
            }
        });

        load_cart();
    }

    function checkout(count) {
        if (count == 0) {
            Swal.fire({
                title: 'Warning!',
                icon: 'warning',
                html: 'Pilih produk sebelum ke checkout',
                showCloseButton: true,
                showConfirmButton: false
            });
        } else {
            window.location.href = '<?= base_url() ?>home/checkout';
        }
    }
</script>