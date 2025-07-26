<?php if (! $__env->hasRenderedOnce('834ca174-51c1-4e03-a65c-6693bc3df18c')): $__env->markAsRenderedOnce('834ca174-51c1-4e03-a65c-6693bc3df18c'); ?>
<?php $__env->startPush('componentScripts'); ?>
<script src="<?php echo e($U('/viewjs/components/batterycard.js', true)); ?>?v=<?php echo e($version); ?>"></script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if(!isset($asModal)) { $asModal = false; } ?>

<?php if($asModal): ?>
<div class="modal fade"
	id="batterycard-modal"
	tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content text-center">
			<div class="modal-body">
				<?php endif; ?>

				<div class="card batterycard">
					<div class="card-header">
						<span class="float-left"><?php echo e($__t('Battery overview')); ?></span>
						<a id="batterycard-battery-edit-button"
							class="btn btn-sm btn-outline-secondary py-0 float-right disabled"
							href="#"
							data-toggle="tooltip"
							title="<?php echo e($__t('Edit battery')); ?>">
							<i class="fa-solid fa-edit"></i>
						</a>
						<a id="batterycard-battery-journal-button"
							class="btn btn-sm btn-outline-secondary py-0 mr-1 float-right disabled show-as-dialog-link"
							href="#"
							data-dialog-type="table">
							<?php echo e($__t('Battery journal')); ?>

						</a>
					</div>
					<div class="card-body">
						<h3><span id="batterycard-battery-name"></span></h3>
						<strong><?php echo e($__t('Used in')); ?>:</strong> <span id="batterycard-battery-used_in"></span><br>
						<strong><?php echo e($__t('Charge cycles count')); ?>:</strong> <span id="batterycard-battery-charge-cycles-count"
							class="locale-number locale-number-generic"></span><br>
						<strong><?php echo e($__t('Last charged')); ?>:</strong> <span id="batterycard-battery-last-charged"></span> <time id="batterycard-battery-last-charged-timeago"
							class="timeago timeago-contextual"></time><br>
					</div>
				</div>

				<?php if($asModal): ?>
			</div>
			<div class="modal-footer">
				<button type="button"
					class="btn btn-secondary"
					data-dismiss="modal"><?php echo e($__t('Close')); ?></button>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php /**PATH /app/www/views/components/batterycard.blade.php ENDPATH**/ ?>