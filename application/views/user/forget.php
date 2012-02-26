<?php if (isset($warning)): ?>
<div class="alert alert-error">
	<?php echo $warning; ?>
</div>
<?php endif; ?>

<?php echo form_open('user/reset_submit', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend>重设密码</legend>
		<div class="control-group">
			<label class="control-label" for="user">学生证号</label>
			<div class="controls">
				<input type="text" name="user" value="<?php echo $user->student_id; ?>" class="input-xlarge" disabled>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="user">新的密码</label>
			<div class="controls">
				<input type="password" name="password" class="input-xlarge">
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">重设</button>
		<button type="reset" class="btn">取消</button>
	</div>
<?php echo form_close(); ?>