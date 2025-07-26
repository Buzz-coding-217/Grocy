<?php require_frontend_packages(['bootstrap-select']); ?>



<?php if($mode == 'edit'): ?>
<?php $__env->startSection('title', $__t('Edit chore')); ?>
<?php else: ?>
<?php $__env->startSection('title', $__t('Create chore')); ?>
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
			Grocy.EditObjectId = <?php echo e($chore->id); ?>;
		</script>
		<?php endif; ?>

		<form id="chore-form"
			class="has-sticky-form-footer"
			novalidate>

			<div class="form-group">
				<label for="name"><?php echo e($__t('Name')); ?></label>
				<input type="text"
					class="form-control"
					required
					id="name"
					name="name"
					value="<?php if($mode == 'edit'): ?><?php echo e($chore->name); ?><?php endif; ?>">
				<div class="invalid-feedback"><?php echo e($__t('A name is required')); ?></div>
			</div>

			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input <?php if($mode=='create'
						): ?>
						checked
						<?php elseif($mode=='edit'
						&&
						$chore->active == 1): ?> checked <?php endif; ?> class="form-check-input custom-control-input" type="checkbox" id="active" name="active" value="1">
					<label class="form-check-label custom-control-label"
						for="active"><?php echo e($__t('Active')); ?></label>
				</div>
			</div>

			<div class="form-group">
				<label for="description"><?php echo e($__t('Description')); ?></label>
				<textarea class="form-control"
					rows="2"
					id="description"
					name="description"><?php if($mode == 'edit'): ?><?php echo e($chore->description); ?><?php endif; ?></textarea>
			</div>

			<div class="form-group">
				<label for="period_type"><?php echo e($__t('Period type')); ?></label>
				<select required
					class="custom-control custom-select input-group-chore-period-type"
					id="period_type"
					name="period_type">
					<?php $__currentLoopData = $periodTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $periodType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php if($mode=='edit'
						&&
						$periodType==$chore->period_type): ?> selected="selected" <?php endif; ?> value="<?php echo e($periodType); ?>"><?php echo e($__t($periodType)); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('A period type is required')); ?></div>
			</div>

			<?php if($mode == 'edit') { $value = $chore->period_days; } else { $value = 0; } ?>
			<?php echo $__env->make('components.numberpicker', array(
			'id' => 'period_days',
			'label' => 'Period days',
			'value' => $value,
			'min' => '0',
			'additionalCssClasses' => 'input-group-chore-period-type',
			'additionalGroupCssClasses' => 'period-type-input period-type-monthly'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<div class="form-group period-type-input period-type-weekly">
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="monday"
						value="monday">
					<label class="form-check-label custom-control-label"
						for="monday"><?php echo e($__t('Monday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="tuesday"
						value="tuesday">
					<label class="form-check-label custom-control-label"
						for="tuesday"><?php echo e($__t('Tuesday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="wednesday"
						value="wednesday">
					<label class="form-check-label custom-control-label"
						for="wednesday"><?php echo e($__t('Wednesday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="thursday"
						value="thursday">
					<label class="form-check-label custom-control-label"
						for="thursday"><?php echo e($__t('Thursday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="friday"
						value="friday">
					<label class="form-check-label custom-control-label"
						for="friday"><?php echo e($__t('Friday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="saturday"
						value="saturday">
					<label class="form-check-label custom-control-label"
						for="saturday"><?php echo e($__t('Saturday')); ?></label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input class="form-check-input custom-control-input input-group-chore-period-type"
						type="checkbox"
						id="sunday"
						value="sunday">
					<label class="form-check-label custom-control-label"
						for="sunday"><?php echo e($__t('Sunday')); ?></label>
				</div>
			</div>

			<input type="hidden"
				id="period_config"
				name="period_config"
				value="<?php if($mode == 'edit'): ?><?php echo e($chore->period_config); ?><?php endif; ?>">

			<?php if($mode == 'edit') { $value = $chore->period_interval; } else { $value = 1; } ?>
			<?php echo $__env->make('components.numberpicker', array(
			'id' => 'period_interval',
			'label' => 'Period interval',
			'value' => $value,
			'min' => '1',
			'additionalCssClasses' => 'input-group-chore-period-type',
			'additionalGroupCssClasses' => 'period-type-input period-type-hourly period-type-daily period-type-weekly period-type-monthly period-type-yearly'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<p id="chore-schedule-info"
				class="form-text text-info mt-n2"></p>

			<?php
			$value = date('Y-m-d H:i:s');
			if ($mode == 'edit')
			{
			$value = date('Y-m-d H:i:s', strtotime($chore->start_date));
			}
			?>
			<?php echo $__env->make('components.datetimepicker', array(
			'id' => 'start',
			'label' => 'Start date',
			'initialValue' => $value,
			'format' => 'YYYY-MM-DD HH:mm:ss',
			'initWithNow' => true,
			'limitEndToNow' => false,
			'limitStartToNow' => false,
			'invalidFeedback' => $__t('A start date is required'),
			'hint' => $__t('The start date cannot be changed when the chore was once tracked')
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php if(GROCY_FEATURE_FLAG_CHORES_ASSIGNMENTS): ?>
			<div class="form-group">
				<label for="assignment_type"><?php echo e($__t('Assignment type')); ?></label>
				<select required
					class="custom-control custom-select input-group-chore-assignment-type"
					id="assignment_type"
					name="assignment_type">
					<?php $__currentLoopData = $assignmentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignmentType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php if($mode=='edit'
						&&
						$assignmentType==$chore->assignment_type): ?> selected="selected" <?php endif; ?> value="<?php echo e($assignmentType); ?>"><?php echo e($__t($assignmentType)); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('An assignment type is required')); ?></div>
			</div>

			<div class="form-group">
				<label for="assignment_config"><?php echo e($__t('Assign to')); ?></label>
				<select required
					multiple
					class="form-control input-group-chore-assignment-type selectpicker"
					id="assignment_config"
					name="assignment_config"
					data-actions-Box="true"
					data-live-search="true">
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php if($mode=='edit'
						&&
						in_array($user->id, explode(',', $chore->assignment_config))): ?> selected="selected" <?php endif; ?> value="<?php echo e($user->id); ?>"><?php echo e($user->display_name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<div class="invalid-feedback"><?php echo e($__t('This assignment type requires that at least one is assigned')); ?></div>
			</div>

			<p id="chore-assignment-type-info"
				class="form-text text-info mt-n2"></p>
			<?php else: ?>
			<input type="hidden"
				id="assignment_type"
				name="assignment_type"
				value="<?php echo e(\Grocy\Services\ChoresService::CHORE_ASSIGNMENT_TYPE_NO_ASSIGNMENT); ?>">
			<input type="hidden"
				id="assignment_config"
				name="assignment_config"
				value="">
			<?php endif; ?>

			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input <?php if($mode=='edit'
						&&
						$chore->track_date_only == 1): ?> checked <?php endif; ?> class="form-check-input custom-control-input" type="checkbox" id="track_date_only" name="track_date_only" value="1">
					<label class="form-check-label custom-control-label"
						for="track_date_only"><?php echo e($__t('Track date only')); ?>

						&nbsp;<i class="fa-solid fa-question-circle text-muted"
							data-toggle="tooltip"
							data-trigger="hover click"
							title="<?php echo e($__t('When enabled only the day of an execution is tracked, not the time')); ?>"></i>
					</label>
				</div>
			</div>

			<div class="form-group">
				<div class="custom-control custom-checkbox">
					<input <?php if($mode=='edit'
						&&
						$chore->rollover == 1): ?> checked <?php endif; ?> class="form-check-input custom-control-input" type="checkbox" id="rollover" name="rollover" value="1">
					<label class="form-check-label custom-control-label"
						for="rollover"><?php echo e($__t('Due date rollover')); ?>

						&nbsp;<i class="fa-solid fa-question-circle text-muted"
							data-toggle="tooltip"
							data-trigger="hover click"
							title="<?php echo e($__t('When enabled the chore can never be overdue, the due date will shift forward each day when due')); ?>"></i>
					</label>
				</div>
			</div>

			<?php if(GROCY_FEATURE_FLAG_STOCK): ?>
			<div class="form-group mt-4 mb-1">
				<div class="custom-control custom-checkbox">
					<input <?php if($mode=='edit'
						&&
						$chore->consume_product_on_execution == 1): ?> checked <?php endif; ?> class="form-check-input custom-control-input" type="checkbox" id="consume_product_on_execution" name="consume_product_on_execution" value="1">
					<label class="form-check-label custom-control-label"
						for="consume_product_on_execution"><?php echo e($__t('Consume product on chore execution')); ?></label>
				</div>
			</div>

			<?php $prefillById = ''; if($mode=='edit' && !empty($chore->product_id)) { $prefillById = $chore->product_id; } ?>
			<?php echo $__env->make('components.productpicker', array(
			'products' => $products,
			'nextInputSelector' => '#product_amount',
			'isRequired' => false,
			'disallowAllProductWorkflows' => true,
			'prefillById' => $prefillById
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php if($mode == 'edit') { $value = $chore->product_amount; } else { $value = ''; } ?>
			<?php echo $__env->make('components.numberpicker', array(
			'id' => 'product_amount',
			'label' => 'Amount',
			'contextInfoId' => 'amount_qu_unit',
			'min' => $DEFAULT_MIN_AMOUNT,
			'decimals' => $userSettings['stock_decimal_places_amounts'],
			'isRequired' => false,
			'value' => $value,
			'additionalCssClasses' => 'locale-number-input locale-number-quantity-amount'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
			<?php endif; ?>

			<?php echo $__env->make('components.userfieldsform', array(
			'userfields' => $userfields,
			'entity' => 'chores'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<div class="sticky-form-footer pt-1">
				<button id="save-chore-button"
					class="btn btn-success"><?php echo e($__t('Save')); ?></button>
			</div>

		</form>
	</div>

	<div class="col-lg-6 col-12 <?php if($mode == 'create'): ?> d-none <?php endif; ?>">
		<div class="row">
			<div class="col clearfix">
				<div class="title-related-links pb-4">
					<h4>
						<span class="ls-n1"><?php echo e($__t('Grocycode')); ?></span>
						<i class="fa-solid fa-question-circle text-muted"
							data-toggle="tooltip"
							data-trigger="hover click"
							title="<?php echo e($__t('Grocycode is a unique referer to this %s in your Grocy instance - print it onto a label and scan it like any other barcode', $__t('Chore'))); ?>"></i>
					</h4>
					<p>
						<?php if($mode == 'edit'): ?>
						<img src="<?php echo e($U('/chore/' . $chore->id . '/grocycode?size=60')); ?>"
							class="float-lg-left"
							loading="lazy">
						<?php endif; ?>
					</p>
					<p>
						<a class="btn btn-outline-primary btn-sm"
							href="<?php echo e($U('/chore/' . $chore->id . '/grocycode?download=true')); ?>"><?php echo e($__t('Download')); ?></a>
						<?php if(GROCY_FEATURE_FLAG_LABEL_PRINTER): ?>
						<a class="btn btn-outline-primary btn-sm chore-grocycode-label-print"
							data-chore-id="<?php echo e($chore->id); ?>"
							href="#">
							<?php echo e($__t('Print on label printer')); ?>

						</a>
						<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/choreform.blade.php ENDPATH**/ ?>