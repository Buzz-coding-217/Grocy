<?php require_frontend_packages(['bootstrap-combobox']); ?>



<?php $__env->startSection('title', $__t('Battery tracking')); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12 col-md-6 col-xl-4 pb-3">
		<h2 class="title"><?php echo $__env->yieldContent('title'); ?></h2>

		<hr class="my-2">

		<form id="batterytracking-form"
			novalidate>

			<div class="form-group">
				<label class="w-100"
					for="battery_id">
					<?php echo e($__t('Battery')); ?>

					<i id="barcode-lookup-hint"
						class="fa-solid fa-barcode float-right mt-1"></i>
				</label>
				<select class="form-control combobox barcodescanner-input"
					id="battery_id"
					name="battery_id"
					required
					data-target="@batterypicker">
					<option value=""></option>
					<?php $__currentLoopData = $batteries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $battery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($battery->id); ?>"><?php echo e($battery->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('You have to select a battery')); ?></div>
			</div>

			<?php echo $__env->make('components.datetimepicker', array(
			'id' => 'tracked_time',
			'label' => 'Tracked time',
			'format' => 'YYYY-MM-DD HH:mm:ss',
			'initWithNow' => true,
			'limitEndToNow' => true,
			'limitStartToNow' => false,
			'invalidFeedback' => $__t('This can only be before now')
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php echo $__env->make('components.userfieldsform', array(
			'userfields' => $userfields,
			'entity' => 'battery_charge_cycles'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<button id="save-batterytracking-button"
				class="btn btn-success"><?php echo e($__t('OK')); ?></button>

		</form>
	</div>

	<div class="col-12 col-md-6 col-xl-4">
		<?php echo $__env->make('components.batterycard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	</div>
</div>

<?php echo $__env->make('components.camerabarcodescanner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/batterytracking.blade.php ENDPATH**/ ?>