

<?php 
	$ci = get_instance();
?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
	<?php
		echo form_open($form_action);
	?>
	<p>
		<label>Nama Organisasi</label>
		<?php
			echo form_input($nama_organisasi);
		?>
	</p>
	<p>
		<label>Alamat</label>
		<?php
			echo form_textarea($alamat);
		?>
	</p>
	<p>
		<?php
			echo anchor($ci->session->userdata('urlback'), 'Kembali', ['class' => 'btn btn-secondary']);
		?>
		<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
	</p>
	<?php
		echo form_close();
	?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_template/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\ci_crud_regular\application\views/organisasi/form_add.blade.php ENDPATH**/ ?>