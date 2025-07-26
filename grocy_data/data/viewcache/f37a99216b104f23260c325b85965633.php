<?php $__env->startSection('title', $__t('Transfer')); ?>

<?php $__env->startSection('content'); ?>
<script>
	Grocy.QuantityUnits = <?php echo json_encode($quantityUnits); ?>;
	Grocy.QuantityUnitConversionsResolved = <?php echo json_encode($quantityUnitConversionsResolved); ?>;
</script>

<div class="row">
	<div class="col-12 col-md-6 col-xl-4 pb-3">
		<h2 class="title"><?php echo $__env->yieldContent('title'); ?></h2>

		<hr class="my-2">

		<form id="transfer-form"
			novalidate>

			<?php echo $__env->make('components.productpicker', array(
			'products' => $products,
			'barcodes' => $barcodes,
			'nextInputSelector' => '#location_id_from',
			'disallowAddProductWorkflows' => true
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<div class="form-group">
				<label for="location_id_from"><?php echo e($__t('From location')); ?></label>
				<select required
					class="custom-control custom-select location-combobox"
					id="location_id_from"
					name="location_id_from">
					<option></option>
					<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($location->id); ?>"
						data-is-freezer="<?php echo e($location->is_freezer); ?>"><?php echo e($location->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('A location is required')); ?></div>
			</div>

			<?php echo $__env->make('components.productamountpicker', array(
			'value' => 1,
			'additionalHtmlContextHelp' => '<div id="tare-weight-handling-info"
				class="text-info font-italic d-none">' . $__t('Tare weight handling enabled - please weigh the whole container, the amount to be posted will be automatically calculcated') . '</div>'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<div class="form-group">
				<label for="location_id_to"><?php echo e($__t('To location')); ?></label>
				<select required
					class="custom-control custom-select location-combobox"
					id="location_id_to"
					name="location_id_to">
					<option></option>
					<?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($location->id); ?>"
						data-is-freezer="<?php echo e($location->is_freezer); ?>"><?php echo e($location->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('A location is required')); ?></div>
			</div>

			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input class="form-check-input custom-control-input"
						type="checkbox"
						id="use_specific_stock_entry"
						name="use_specific_stock_entry"
						value="1">
					<label class="form-check-label custom-control-label"
						for="use_specific_stock_entry"><?php echo e($__t('Use a specific stock item')); ?>

						&nbsp;<i class="fa-solid fa-question-circle text-muted"
							data-toggle="tooltip"
							data-trigger="hover click"
							title="<?php echo e($__t('The first item in this list would be picked by the default rule consume rule (Opened first, then first due first, then first in first out)')); ?>"></i>
					</label>
				</div>
				<select disabled
					class="custom-control custom-select mt-2"
					id="specific_stock_entry"
					name="specific_stock_entry">
					<option></option>
				</select>
			</div>

			<button id="save-transfer-button"
				class="btn btn-success"><?php echo e($__t('OK')); ?></button>

		</form>
	</div>

	<div class="col-12 col-md-6 col-xl-4 hide-when-embedded">
		<?php echo $__env->make('components.productcard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/transfer.blade.php ENDPATH**/ ?>