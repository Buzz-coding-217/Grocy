<?php require_frontend_packages(['bootstrap-combobox']); ?>



<?php $__env->startSection('title', $__t('Chore tracking')); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-12 col-md-6 col-xl-4 pb-3">
		<h2 class="title"><?php echo $__env->yieldContent('title'); ?></h2>

		<hr class="my-2">

		<form id="choretracking-form"
			novalidate>

			<div class="form-group">
				<label class="w-100"
					for="chore_id">
					<?php echo e($__t('Chore')); ?>

					<i id="barcode-lookup-hint"
						class="fa-solid fa-barcode float-right mt-1"></i>
				</label>
				<select class="form-control combobox barcodescanner-input"
					id="chore_id"
					name="chore_id"
					required
					data-target="@chorepicker">
					<option value=""></option>
					<?php $__currentLoopData = $chores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($chore->id); ?>"><?php echo e($chore->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('You have to select a chore')); ?></div>
			</div>

			<?php echo $__env->make('components.datetimepicker', array(
			'id' => 'tracked_time',
			'label' => 'Tracked time',
			'format' => 'YYYY-MM-DD HH:mm:ss',
			'initWithNow' => true,
			'limitEndToNow' => false,
			'limitStartToNow' => false,
			'invalidFeedback' => $__t('A date is required')
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php if(GROCY_FEATURE_FLAG_CHORES_ASSIGNMENTS): ?>
			<?php echo $__env->make('components.userpicker', array(
			'label' => 'Done by',
			'users' => $users,
			'nextInputSelector' => '#user_id',
			'prefillByUserId' => GROCY_USER_ID
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<?php else: ?>
			<input type="hidden"
				id="user_id"
				name="user_id"
				value="<?php echo e(GROCY_USER_ID); ?>">
			<?php endif; ?>

			<?php echo $__env->make('components.userfieldsform', array(
			'userfields' => $userfields,
			'entity' => 'chores_log'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<button class="btn btn-success save-choretracking-button"><?php echo e($__t('OK')); ?></button>

			<button class="btn btn-secondary save-choretracking-button skip"><?php echo e($__t('Skip')); ?></button>

		</form>
	</div>

	<div class="col-12 col-md-6 col-xl-4">
		<?php echo $__env->make('components.chorecard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	</div>
</div>

<?php echo $__env->make('components.camerabarcodescanner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/choretracking.blade.php ENDPATH**/ ?>