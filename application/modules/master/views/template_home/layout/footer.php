    <!-- Main JS -->
    <script src="<?= base_url() ?>assets/home/js/modernizr.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/count.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/gmap.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/imageloader.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/isotope.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/nouislider.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/photoswipe-ui-default.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/photoswipe.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/velocity.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/script.js"></script>
    <script src="<?= base_url() ?>assets/home/js/custom.js"></script>

    <!-- Plugin JS -->
    <script src="<?= base_url() ?>assets/home/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/font-awesome.js" crossorigin="anonymous"></script>
    
    <script>
        // Alert
        $(document).ready(function() {
            <?php if (!empty($this->session->flashdata('success'))): ?>
                <?= $this->session->flashdata('success'); ?>
            <?php elseif (!empty($this->session->flashdata('failed'))): ?>
                <?= $this->session->flashdata('failed'); ?>
            <?php endif ?>

            <?php if ($this->session->userdata('customer')): ?>
                load_cart_mini();
            <?php endif ?>
        });

        <?php if ($this->session->userdata('customer')): ?>
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
            
            function load_cart_mini() {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>home/cart/mini",
                    data: {
                        id_customer: '<?= encrypt_text($setup_app['customer_session']->id_customer) ?>'
                    },
                    dataType: "json",
                    success: function (response) {
                        var data = response.data;

                        if (response.error == false) {
                            $('.cart').html(data.html);
                        } else {
                            <?= $setup_app['ajax_error'] ?>
                        }
                    }
                });
            }

            function delete_cart_mini(id_cart) {
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
                            url: "<?= base_url() ?>home/cart/mini",
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
                                    
                                    load_cart_mini();
                                }
                            }
                        });
                    }
                });
            }
        <?php endif ?>
    </script>

    <?php if (!empty($get_script)): ?>
        <?= $this->load->view($get_script); ?>
    <?php endif ?>
</body>
</html>