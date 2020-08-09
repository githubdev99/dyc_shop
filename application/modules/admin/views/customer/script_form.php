<script>
    function match_password(value) {
        if ($('input[name="password"]').val()) {
            if ($('input[name="password"]').val() != value) {
                $('#text_not_match').show();
                $('button[name="insert"]').attr('disabled');
            } else {
                $('#text_not_match').hide();
                $('button[name="insert"]').removeAttr('disabled');
            }
        }
    }
</script>