<?php if($mode == 'edit'): ?>
<?php $__env->startSection('title', $__t('Edit task')); ?>
<?php else: ?>
<?php $__env->startSection('title', $__t('Create task')); ?>
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
			Grocy.EditObjectId = <?php echo e($task->id); ?>;
		</script>
		<?php endif; ?>

		<form id="task-form"
			novalidate>

			<div class="form-group">
				<label for="name"><?php echo e($__t('Name')); ?></label>
				<input type="text"
					class="form-control"
					required
					id="name"
					name="name"
					value="<?php if($mode == 'edit'): ?><?php echo e($task->name); ?><?php endif; ?>">
				<div class="invalid-feedback"><?php echo e($__t('A name is required')); ?></div>
			</div>

			<div class="form-group">
				<label for="description"><?php echo e($__t('Description')); ?></label>
				<textarea class="form-control"
					rows="4"
					id="description"
					name="description"><?php if($mode == 'edit'): ?><?php echo e($task->description); ?><?php endif; ?></textarea>
			</div>

			<?php
			$initialDueDate = null;
			if ($mode == 'edit' && !empty($task->due_date))
			{
			$initialDueDate = date('Y-m-d', strtotime($task->due_date));
			}
			?>
			<?php echo $__env->make('components.datetimepicker', array(
			'id' => 'due_date',
			'label' => 'Due',
			'format' => 'YYYY-MM-DD',
			'initWithNow' => false,
			'initialValue' => $initialDueDate,
			'limitEndToNow' => false,
			'limitStartToNow' => false,
			'invalidFeedback' => $__t('A due date is required'),
			'nextInputSelector' => 'category_id',
			'additionalGroupCssClasses' => 'date-only-datetimepicker',
			'isRequired' => false
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<div class="form-group">
				<label for="category_id"><?php echo e($__t('Category')); ?></label>
				<select class="custom-control custom-select"
					id="category_id"
					name="category_id">
					<option></option>
					<?php $__currentLoopData = $taskCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php if($mode=='edit'
						&&
						$taskCategory->id == $task->category_id): ?> selected="selected" <?php endif; ?> value="<?php echo e($taskCategory->id); ?>"><?php echo e($taskCategory->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>

			<?php
			$initUserId = GROCY_USER_ID;
			if ($mode == 'edit')
			{
			$initUserId = $task->assigned_to_user_id;
			}
			?>
			<?php echo $__env->make('components.userpicker', array(
			'label' => 'Assigned to',
			'users' => $users,
			'prefillByUserId' => $initUserId
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php echo $__env->make('components.userfieldsform', array(
			'userfields' => $userfields,
			'entity' => 'tasks'
			), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

			<?php if($mode == 'edit'): ?>
			<button class="btn btn-success save-task-button"><?php echo e($__t('Save')); ?></button>
			<?php else: ?>
			<button class="btn btn-success save-task-button"><?php echo e($__t('Save & close')); ?></button>
			<button class="btn btn-primary save-task-button add-another"><?php echo e($__t('Save & add another task')); ?></button>
			<?php endif; ?>
		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /app/www/views/taskform.blade.php ENDPATH**/ ?>