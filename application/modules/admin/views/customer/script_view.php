<script>
	$(document).ready(function() {
		load_table();
    });
    
    function load_table() {
        $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
            "pagingType": "full_numbers",
            "destroy": true,
			"order": [],
			"columnDefs": [
			{
				"targets": [ 0, 5 ],
				"orderable": false
			}],
			"drawCallback": function (settings) {
				$('[data-toggle="tooltip"]').tooltip();
			},
			"ajax": {
				"url": "<?= base_url() ?>admin/customer/list_customer",
				"type": "POST",
				"dataType": "json",
				"error": function () {
					<?= $setup_app['ajax_error'] ?>
				}
			}
		});
    }

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