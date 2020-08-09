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
    
    <script>
        // Alert
        $(document).ready(function() {
            <?php if (!empty($this->session->flashdata('success'))): ?>
                <?= $this->session->flashdata('success'); ?>
            <?php elseif (!empty($this->session->flashdata('failed'))): ?>
                <?= $this->session->flashdata('failed'); ?>
            <?php endif ?>
        });
    </script>

    <?php if (!empty($get_script)): ?>
        <?= $this->load->view($get_script); ?>
    <?php endif ?>
</body>
</html>