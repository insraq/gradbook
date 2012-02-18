<div class="row">

	<p>创建用户一共需要三步，你现在在 <b>第一步：填写基本信息</b>。</p>
	<div class="progress progress-success progress-striped">
		<div class="bar" style="width: 30%;"></div>
	</div>

	<?php if (isset($warning)): ?>
	<div class="alert alert-error">
		<?php echo $warning; ?>
	</div>
	<?php endif; ?>

	<?php echo form_open('user/check', array('class' => 'form-horizontal')); ?>
		<fieldset>
			<legend>用户登录</legend>
			<div class="control-group">
				<label class="control-label" for="user">学生证号</label>
				<div class="controls">
					<input type="text" name="user" class="input-xlarge">
					<p class="help-block">即CU Link ID，请输入完整的八位。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="password">密码</label>
				<div class="controls">
					<input type="password" name="password" class="input-xlarge">
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">登录</button>
			<button type="reset" class="btn">取消</button>
		</div>
	<?php echo form_close(); ?>
</div>