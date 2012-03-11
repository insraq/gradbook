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
		<div class="control-group">
			<div class="controls">
				<p>
					还没注册？立即
					<a href="<?php echo site_url('user/create'); ?>" class="btn">创建用户</a>。忘记密码？可以
					<a href="<?php echo site_url('user/forget'); ?>" class="btn">立即重设</a>。
				</p>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">登录</button>
		<button type="reset" class="btn">取消</button>
	</div>
<?php echo form_close(); ?>