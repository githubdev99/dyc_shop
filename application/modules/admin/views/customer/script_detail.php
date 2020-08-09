<script>
    function modal_delete(id) {
		$.ajax({
			url: '<?= base_url() ?>admin/customer/get_customer',
			type: 'POST',
			dataType: 'json',
			data: {id: id},
			success: function (response) {
				var data = response.data;

				if (response.error == false) {
					$('form[name="delete_customer"] #username').text(data.username);
					$('form[name="delete_customer"] input[name="id_customer"]').val(data.id_customer);
					$('form[name="delete_customer"] input[name="username"]').val(data.username);
					$('#deleteData').modal('show');
				} else {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
	}
</script>