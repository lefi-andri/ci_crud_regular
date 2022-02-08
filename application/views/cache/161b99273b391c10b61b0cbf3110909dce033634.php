

<?php 
	$ci = get_instance();
?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">

	<?php
		echo anchor($ci->session->userdata('urlback'), 'Refresh Data', array('class' => 'btn btn-secondary'));
	?>

	<?php
		echo anchor('organisasi/add', 'Tambah Data', array('class' => 'btn btn-primary'));
	?>

<form action="<?php echo site_url('organisasi/search'); ?>" method="post">
	<div class="input-group mb-3">
	  <input name="keyword" type="text" class="form-control" placeholder="Pencarian .." aria-label="Search" aria-describedby="button-addon2" value="<?php echo e($keyword); ?>">
	  <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
	  </div>
	</div>
</form>

	<?php if($keyword <> ''): ?>
		<?php
			echo anchor('organisasi', 'Reset', ['class' => 'btn btn-secondary']);
		?>
	<?php endif; ?>
	
	<?php if(! empty($tabel_data)): ?>
		<?php
			echo $tabel_data;
		?>
	<?php endif; ?>

	<?php
		echo $pagination;
	?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('include_template/template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\MAMP\htdocs\ci_crud_regular\application\views/organisasi/index.blade.php ENDPATH**/ ?>