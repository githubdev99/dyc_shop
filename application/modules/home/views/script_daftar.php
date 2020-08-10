<script>
    function match_password(value) {
        if ($('input[name="password"]').val()) {
            if ($('input[name="password"]').val() != value) {
                $('#text_not_match').show();
                $('button[name="daftar"]').attr('disabled');
            } else {
                $('#text_not_match').hide();
                $('button[name="daftar"]').removeAttr('disabled');
            }
        }
    }

    function number_only(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>