<?php if (isset($warning)): ?>
<div class="alert alert-error">
	<?php echo $warning; ?>
</div>
<?php endif; ?>

<?php echo form_open('user/reset_email', array('class' => 'form-horizontal', 'method' => 'post')); ?>
	<fieldset>
		<legend>重设密码</legend>
		<div class="control-group">
			<label class="control-label" for="user">学生证号</label>
			<div class="controls">
				<input type="text" name="user" class="input-xlarge">
				<p class="help-block">即CU Link ID，请输入完整的八位。</p>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">重设</button>
		<button type="reset" class="btn">取消</button>
	</div>
<?php echo form_close(); ?>