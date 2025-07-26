<?php require_frontend_packages(['datatables', 'animatecss']); ?>



<?php $__env->startSection('title', $__t('Batteries overview')); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col">
		<div class="title-related-links">
			<h2 class="title"><?php echo $__env->yieldContent('title'); ?></h2>
			<button class="btn btn-outline-dark d-md-none mt-2 float-right order-1 order-md-3"
				type="button"
				data-toggle="collapse"
				data-target="#related-links">
				<i class="fa-solid fa-ellipsis-v"></i>
			</button>
			<div class="related-links collapse d-md-flex order-2 width-xs-sm-100"
				id="related-links">
				<a class="btn btn-outline-dark responsive-button m-1 mt-md-0 mb-md-0 float-right"
					href="<?php echo e($U('/batteriesjournal')); ?>">
					<?php echo e($__t('Journal')); ?>

				</a>
			</div>
		</div>
		<div class="border-top border-bottom my-2 py-1">
			<div id="info-overdue-batteries"
				data-status-filter="overdue"
				class="error-message status-filter-message responsive-button mr-2"></div>
			<div id="info-due-today-batteries"
				data-status-filter="duetoday"
				class="normal-message status-filter-message responsive-button mr-2"></div>
			<div id="info-due-soon-batteries"
				data-status-filter="duesoon"
				data-next-x-days="<?php echo e($nextXDays); ?>"
				class="warning-message status-filter-message responsive-button <?php if($nextXDays == 0): ?> d-none <?php endif; ?>"></div>
			<div class="float-right mt-1 <?php if($embedded): ?> pr-5 <?php endif; ?>">
				<a class="btn btn-sm btn-outline-info d-md-none"
					data-toggle="collapse"
					href="#table-filter-row"
					role="button">
					<i class="fa-solid fa-filter"></i>
				</a>
				<button id="clear-filter-button"
					class="btn btn-sm btn-outline-info"
					data-toggle="tooltip"
					title="<?php echo e($__t('Clear filter')); ?>">
					<i class="fa-solid fa-filter-circle-xmark"></i>
				</button>
			</div>
		</div>
	</div>
</div>

<div class="row collapse d-md-flex"
	id="table-filter-row">
	<div class="col-12 col-md-6 col-xl-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa-solid fa-search"></i></span>
			</div>
			<input type="text"
				id="search"
				class="form-control"
				placeholder="<?php echo e($__t('Search')); ?>">
		</div>
	</div>
	<div class="col-12 col-md-6 col-xl-3">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa-solid fa-filter"></i>&nbsp;<?php echo e($__t('Status')); ?></span>
			</div>
			<select class="custom-control custom-select"
				id="status-filter">
				<option value="all"><?php echo e($__t('All')); ?></option>
				<option value="overdue"><?php echo e($__t('Overdue')); ?></option>
				<option value="duetoday"><?php echo e($__t('Due today')); ?></option>
				<?php if($nextXDays > 0): ?>
				<option value="duesoon"><?php echo e($__t('Due soon')); ?></option>
				<?php endif; ?>
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="col">
		<table id="batteries-overview-table"
			class="table table-sm table-striped nowrap w-100">
			<thead>
				<tr>
					<th class="border-right"><a class="text-muted change-table-columns-visibility-button"
							data-toggle="tooltip"
							title="<?php echo e($__t('Table options')); ?>"
							data-table-selector="#batteries-overview-table"
							href="#"><i class="fa-solid fa-eye"></i></a>
					</th>
					<th><?php echo e($__t('Battery')); ?></th>
					<th class="allow-grouping"><?php echo e($__t('Used in')); ?></th>
					<th><?php echo e($__t('Last charged')); ?></th>
					<th><?php echo e($__t('Next planned charge cycle')); ?></th>
					<th class="d-none">Hidden status</th>

					<?php echo $__env->make('components.userfields_thead', array(
					'userfields' => $userfields
					), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

				</tr>
			</thead>
			<tbody class="d-none">
				<?php $__currentLoopData = $current; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currentBatteryEntry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="battery-<?php echo e($currentBatteryEntry->battery_id); ?>-row"
					class="<?php if($currentBatteryEntry->due_type == 'overdue'): ?> table-danger <?php elseif($currentBatteryEntry->due_type == 'duetoday'): ?> table-info <?php elseif($currentBatteryEntry->due_type == 'duesoon'): ?> table-warning <?php endif; ?>">
					<td class="fit-content border-right">
						<a class="btn btn-success btn-sm track-charge-cycle-button permission-BATTERIES_TRACK_CHARGE_CYCLE"
							href="#"
							data-toggle="tooltip"
							data-placement="left"
							title="<?php echo e($__t('Track charge cycle')); ?>"
							data-battery-id="<?php echo e($currentBatteryEntry->battery_id); ?>"
							data-battery-name="<?php echo e(FindObjectInArrayByPropertyValue($batteries, 'id', $currentBatteryEntry->battery_id)->name); ?>">
							<i class="fa-solid fa-car-battery"></i>
						</a>
						<div class="dropdown d-inline-block">
							<button class="btn btn-sm btn-light text-secondary"
								type="button"
								data-toggle="dropdown">
								<i class="fa-solid fa-ellipsis-v"></i>
							</button>
							<div class="table-inline-menu dropdown-menu dropdown-menu-right">
								<a class="dropdown-item batterycard-trigger"
									data-battery-id="<?php echo e($currentBatteryEntry->battery_id); ?>"
									type="button"
									href="#">
									<span class="dropdown-item-text"><?php echo e($__t('Battery overview')); ?></span>
								</a>
								<a class="dropdown-item show-as-dialog-link"
									type="button"
									href="<?php echo e($U('/batteriesjournal?embedded&battery=')); ?><?php echo e($currentBatteryEntry->battery_id); ?>"
									data-dialog-type="table">
									<span class="dropdown-item-text"><?php echo e($__t('Battery journal')); ?></span>
								</a>
								<a class="dropdown-item permission-MASTER_DATA_EDIT show-as-dialog-link"
									type="button"
									href="<?php echo e($U('/battery/')); ?><?php echo e($currentBatteryEntry->battery_id); ?>?embedded">
									<span class="dropdown-item-text"><?php echo e($__t('Edit battery')); ?></span>
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item"
									type="button"
									href="<?php echo e($U('/battery/' . $currentBatteryEntry->battery_id . '/grocycode?download=true')); ?>">
									<?php echo str_replace('grocycode', '<span class="ls-n1">Grocycode</span>', $__t('Download %s Grocycode', $__t('Battery'))); ?>

								</a>
								<?php if(GROCY_FEATURE_FLAG_LABEL_PRINTER): ?>
								<a class="dropdown-item battery-grocycode-label-print"
									data-battery-id="<?php echo e($currentBatteryEntry->battery_id); ?>"
									type="button"
									href="#">
									<?php echo str_replace('Grocycode', '<span class="ls-n1">Grocycode</span>', $__t('Print %s Grocycode on label printer', $__t('Battery'))); ?>

								</a>
								<?php endif; ?>
							</div>
						</div>
					</td>
					<td class="batterycard-trigger cursor-link"
						data-battery-id="<?php echo e($currentBatteryEntry->battery_id); ?>">
						<?php echo e(FindObjectInArrayByPropertyValue($batteries, 'id', $currentBatteryEntry->battery_id)->name); ?>

					</td>
					<td class="fit-content">
						<?php echo e(FindObjectInArrayByPropertyValue($batteries, 'id', $currentBatteryEntry->battery_id)->used_in); ?>

					</td>
					<td>
						<span id="battery-<?php echo e($currentBatteryEntry->battery_id); ?>-last-tracked-time"><?php echo e($currentBatteryEntry->last_tracked_time); ?></span>
						<time id="battery-<?php echo e($currentBatteryEntry->battery_id); ?>-last-tracked-time-timeago"
							class="timeago timeago-contextual"
							datetime="<?php echo e($currentBatteryEntry->last_tracked_time); ?>"></time>
					</td>
					<td>
						<?php if(FindObjectInArrayByPropertyValue($batteries, 'id', $currentBatteryEntry->battery_id)->charge_interval_days > 0): ?>
						<span id="battery-<?php echo e($currentBatteryEntry->battery_id); ?>-next-charge-time"><?php echo e($currentBatteryEntry->next_estimated_charge_time); ?></span>
						<time id="battery-<?php echo e($currentBatteryEntry->battery_id); ?>-next-charge-time-timeago"
							class="timeago timeago-contextual"
							datetime="<?php echo e($currentBatteryEntry->next_estimated_charge_time); ?>"></time>
						<?php else: ?>
						...
						<?php endif; ?>
					</td>
					<td class="d-none">
						<?php echo e($currentBatteryEntry->due_type); ?>

						<?php if($currentBatteryEntry->due_type == 'duetoday'): ?>
						duesoon
						<?php endif; ?>
					</td>

					<?php echo $__env->make('components.userfields_tbody',
					array( 'userfields'=> $userfields,
					'userfieldValues' => FindAllObjectsInArrayByPropertyValue($userfieldValues, 'object_id', $currentBatteryEntry->battery_id)
					), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>

<?php echo $__env->make('components.batterycard', [
'asModal' => true
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/batteriesoverview.blade.php ENDPATH**/ ?>