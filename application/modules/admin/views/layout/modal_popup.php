<?php if (!empty($modal_add)): ?>
	<div id="addData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<?= $modal_add ?>
		</div>
	</div>	
<?php endif ?>

<?php if (!empty($modal_edit)): ?>
	<div id="editData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<?= $modal_edit ?>
		</div>
	</div>
<?php endif ?>

<?php if (!empty($modal_delete)): ?>
	<div id="deleteData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<?= $modal_delete ?>
		</div>
	</div>
<?php endif ?>

<?php if (!empty($modal_edit_kategori)): ?>
	<div id="editDataKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<?= $modal_edit_kategori ?>
		</div>
	</div>
<?php endif ?>

<?php if (!empty($modal_delete_kategori)): ?>
	<div id="deleteDataKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<?= $modal_delete_kategori ?>
		</div>
	</div>
<?php endif ?>