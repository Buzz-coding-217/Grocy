<?php if($mode == 'edit'): ?>
<?php $__env->startSection('title', $__t('Edit battery')); ?>
<?php else: ?>
<?php $__env->startSection('title', $__t('Create battery')); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col">
		<h2 class="title"><?php echo $__env->yieldContent('title'); ?></h2>
	</div>
</div>

<hr class="my-2">

<div class="row">
	<div class="col-lg-6 col-12">

		<script>
			Grocy.EditMode = '<?php echo e($mode); ?>';
		</script>

		<?php if($mode == 'edit'): ?>
		<script>
			Grocy.EditObjectId = <?php echo e($battery->id); ?>

		</script>
		<?php endif; ?>

		<form id="battery-form"
			novalidate>

			<div class="form-group">
				<label for="name"><?php echo e($__t('Name')); ?></label>
				<input type="text"
					class="form-control"
					required
					id="name"
					name="name"
					value="<?php if($mode == 'edit'): ?><?php echo e($battery->name); ?><?php endif; ?>">
				<div class="invalid-feedback"><?php echo e($__t('A name is required')); ?></div>
			</div>

			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input <?php if($mode=='create'
						): ?>
						checked
						<?php elseif($mode=='edit'
						&&
						$battery->active == 1): ?> checked <?php endif; ?> class="form-check-input custom-control-input" type="checkbox" id="active" name="active" value="1">
					<label class="form-check-label custom-control-label"
						for="active"><?php echo e($__t('Active')); ?></label>
				</div>
			</div>

			<div class="form-group">
				<label for="description"><?php echo e($__t('Description')); ?></label>
				<input type="text"
					class="form-control"
					id="description"
					name="description"
					value="<?php if($mode == 'edit'): ?><?php echo e($battery->description); ?><?php endif; ?>">
			</div>

			<div class="form-group">
				<label for="name"><?php echo e($__t('Used in')); ?></label>
				<input type="text"
					class="form-control"
					id="used_in"
					name="used_in"
					value="<?php if($mode == 'edit'): ?><?php echo e($battery->used_in); ?><?php endif; ?>">
			</div>

			<?php if($mode == 'edit') { $value = $battery->charge_interval_days; } else { $value = 0; } ?>
			<?php echo $__env->make('components.numberpicker', array(
			'id' => 'charge_interval_days',
			'label' => 'Charge cycle interval (days)',
			'value' => $value,
			'min' => '0',
			'hint' => $__t('0 means suggestions for the next charge cycle are disabled')
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php echo $__env->make('components.userfieldsform', array(
			'userfields' => $userfields,
			'entity' => 'batteries'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<button id="save-battery-button"
				class="btn btn-success"><?php echo e($__t('Save')); ?></button>

		</form>
	</div>
</div>

<?php if($mode == 'edit'): ?>
<div class="row mt-2 border-top">
	<div class="col clearfix mt-2">
		<div class="title-related-links">
			<h4>
				<span class="ls-n1"><?php echo e($__t('Grocycode')); ?></span>
				<i class="fa-solid fa-question-circle text-muted"
					data-toggle="tooltip"
					data-trigger="hover click"
					title="<?php echo e($__t('Grocycode is a unique referer to this %s in your Grocy instance - print it onto a label and scan it like any other barcode', $__t('Battery'))); ?>"></i>
			</h4>
			<p>
				<?php if($mode == 'edit'): ?>
				<img src="<?php echo e($U('/battery/' . $battery->id . '/grocycode?size=60')); ?>"
					class="float-lg-left"
					loading="lazy">
				<?php endif; ?>
			</p>
			<p>
				<a class="btn btn-outline-primary btn-sm"
					href="<?php echo e($U('/battery/' . $battery->id . '/grocycode?download=true')); ?>"><?php echo e($__t('Download')); ?></a>
				<?php if(GROCY_FEATURE_FLAG_LABEL_PRINTER): ?>
				<a class="btn btn-outline-primary btn-sm battery-grocycode-label-print"
					data-battery-id="<?php echo e($battery->id); ?>"
					href="#">
					<?php echo e($__t('Print on label printer')); ?>

				</a>
				<?php endif; ?>
			</p>
		</div>
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/batteryform.blade.php ENDPATH**/ ?>