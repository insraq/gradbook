<p>创建用户一共需要三步，你现在在 <b>第一步：填写基本信息</b>。</p>
<div class="progress progress-success progress-striped">
	<div class="bar" style="width: 30%;"></div>
</div>

<?php echo validation_errors(); ?>
<?php echo form_open('user/validate', array('class' => 'form-horizontal')); ?>
	<fieldset>
		<legend>创建用户</legend>
		<div class="control-group">
			<label class="control-label" for="user">学生证号</label>
			<div class="controls">
				<select name="year" class="span1">
					<option value="08">08</option>
					<option value="07">07</option>
					<option value="06">06</option>
				</select>
				<input type="text" name="user" class="input-xlarge">
				<p class="help-block">即CU Link ID，只需输入<strong>08后面</strong>的位数，需要发送验证电邮到你的<strong>中大邮箱</strong>。</p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">密码</label>
			<div class="controls">
				<input type="password" name="password" class="input-xlarge">
				<p class="help-block">为了保证安全，请尽量选择复杂，且和CWEM不同的密码。</p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="name">姓名</label>
			<div class="controls">
				<input type="text" name="name" class="input-xlarge">
				<p class="help-block">请填写真实姓名，非真实姓名将不会被通过。</p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="email">电邮</label>
			<div class="controls">
				<input type="text" name="email" class="input-xlarge">
				<p class="help-block">请填写常用邮箱，此邮箱会作为联系的主要方式。</p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="college">书院</label>
			<div class="controls">
				<select name="college">
					<option value="崇基书院">崇基书院</option>
					<option value="新亚书院">新亚书院</option>
					<option value="联合书院">联合书院</option>
					<option value="逸夫书院">逸夫书院</option>
				</select>
			</div>
		</div>
	</fieldset>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">下一步</button>
		<button type="reset" class="btn">取消</button>
	</div>
<?php echo form_close(); ?>