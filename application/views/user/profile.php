<div class="row">

	<p>创建用户一共需要三步，你现在在 <b>第三步：完善个人信息</b>。</p>
	<div class="progress progress-success progress-striped">
		<div class="bar" style="width: 90%;"></div>
	</div>

	<div class="alert alert-success">
		恭喜你，你的身份成功验证，请继续完善你的个人资料，这些资料将会<b>印制在毕业纪念册上</b>。
	</div>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open('user/update_profile', array('class' => 'form-horizontal')); ?>
		<fieldset>
			<legend>基本信息</legend>
			<div class="control-group">
				<label class="control-label" for="name">姓名</label>
				<div class="controls">
					<input type="text" name="name" value="<?php echo $user->name; ?>" class="input-xlarge" disabled>
					<p class="help-block">姓名已经填写，无法更改。如果有需要请联系管理员。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="nickname">昵称</label>
				<div class="controls">
					<input type="text" name="nickname" value="<?php echo isset($profile) ? $profile->nickname : ''; ?>" class="input-xlarge">
					<p class="help-block">昵称可以是英文名字或者坊间花名。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="college">书院</label>
				<div class="controls">
					<input type="text" name="college" value="<?php echo $user->college; ?>" class="input-xlarge" disabled>
					<p class="help-block">书院已经填写，无法更改。如果有需要请联系管理员。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="gender">性别</label>
				<div class="controls">
					<select name="gender" class="span2">
						<option value="M" <?php echo (isset($profile) AND $profile->gender == 'M') ? 'selected="selected"' : ''; ?>>男</option>
						<option value="F" <?php echo (isset($profile) AND $profile->gender == 'F') ? 'selected="selected"' : ''; ?>>女</option>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="birthday">生日</label>
				<div class="controls">
					<select name="year" class="span2">
						<?php for ($i = 1980; $i <= 1995; $i++): ?>
						<option value="<?php echo $i; ?>" <?php echo (isset($profile) AND $profile->year == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
					年
					<select name="month" class="span1">
						<?php for ($i = 1; $i <= 12; $i++): ?>
						<option value="<?php echo $i; ?>" <?php echo (isset($profile) AND $profile->month == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
					月
					<select name="day" class="span1">
						<?php for ($i = 1; $i <= 31; $i++): ?>
						<option value="<?php echo $i; ?>" <?php echo (isset($profile) AND $profile->day == $i) ? 'selected="selected"' : ''; ?>><?php echo $i; ?></option>
						<?php endfor; ?>
					</select>
					日
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="province">省份</label>
				<div class="controls">
					<select name="province" class="span2">
						<?php foreach ($province as $p): ?>
						<option value="<?php echo $p; ?>" <?php echo (isset($profile) AND $profile->province == $p) ? 'selected="selected"' : ''; ?>><?php echo $p; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="faculty">学院</label>
				<div class="controls">
					<select name="faculty" class="span2">
						<?php foreach ($faculty as $f): ?>
						<option value="<?php echo $f; ?>" <?php echo (isset($profile) AND $profile->faculty == $f) ? 'selected="selected"' : ''; ?>><?php echo $f; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="department">学系</label>
				<div class="controls">
					<select name="department" class="span4">
						<?php foreach ($department as $d): ?>
						<option value="<?php echo $d; ?>" <?php echo (isset($profile) AND $profile->department == $d) ? 'selected="selected"' : ''; ?>><?php echo $d; ?></option>
						<?php endforeach; ?>
					</select>
					<p class="help-block">就读人数较多的专业比较靠上，而较少的比较靠下，名单包含 <a href="http://www.cuhk.edu.hk/chinese/bachelor-degree/arts.html" target="_blank">这个页面</a> 的所有专业。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="ocamp_big">OCamp 大组</label>
				<div class="controls">
					<select name="ocamp_big" class="span2">
						<?php foreach ($ocamp_big as $o): ?>
						<option value="<?php echo $o; ?>" <?php echo (isset($profile) AND $profile->ocamp_big == $o) ? 'selected="selected"' : ''; ?>><?php echo $o; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="ocamp_small">OCamp 小组</label>
				<div class="controls">
					<select name="ocamp_small" class="span2">
						<?php foreach ($ocamp_small as $o): ?>
						<option value="<?php echo $o; ?>" <?php echo (isset($profile) AND $profile->ocamp_small == $o) ? 'selected="selected"' : ''; ?>><?php echo $o; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="relationship">情感</label>
				<div class="controls">
					<select name="relationship" class="span2">
						<?php foreach ($relationship as $r): ?>
						<option value="<?php echo $r; ?>" <?php echo (isset($profile) AND $profile->relationship == $r) ? 'selected="selected"' : ''; ?>><?php echo $r; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend>联系资料</legend>
			<div class="control-group">
				<label class="control-label" for="email">电邮</label>
				<div class="controls">
					<input type="text" name="email" value="<?php echo $user->email; ?>" class="input-xlarge" disabled>
					<p class="help-block">电邮已经填写，无法更改。如果有需要请联系管理员。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="mobile">香港手机</label>
				<div class="controls">
					<input type="text" name="mobile" value="<?php echo isset($profile) ? $profile->mobile : ''; ?>" class="input-xlarge">
					<p class="help-block">请填写八位数香港手机。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="qq">QQ</label>
				<div class="controls">
					<input type="text" name="qq" value="<?php echo isset($profile) ? $profile->qq : ''; ?>" class="input-xlarge">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="msn">MSN</label>
				<div class="controls">
					<input type="text" name="msn" value="<?php echo isset($profile) ? $profile->msn : ''; ?>" class="input-xlarge">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="aim">毕业去向</label>
				<div class="controls">
					<select name="aim" class="span2">
						<?php foreach ($aim as $a): ?>
						<option value="<?php echo $a; ?>" <?php echo (isset($profile) AND $profile->aim == $a) ? 'selected="selected"' : ''; ?>><?php echo $a; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend>纪念册相关</legend>
			<div class="control-group">
				<label class="control-label" for="moment">印象最深的时刻</label>
				<div class="controls">
					<textarea class="input-xlarge" name="moment" rows="3"><?php echo isset($profile) ? $profile->moment : ''; ?></textarea>
					<p class="help-block">在中大四年，一定有许多让你无法忘怀的时刻，那个令你印象最深的是什么呢？<b>40字左右</b>。</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="comment">对中大说的话</label>
				<div class="controls">
					<input type="text" name="comment1" value="<?php echo isset($profile) ? $profile->comment1 : ''; ?>" class="input-xlarge">？
					<input type="text" name="comment2" value="<?php echo isset($profile) ? $profile->comment2 : ''; ?>" class="input-xlarge">！
					<p class="help-block">毕业了，你有什么话要跟中大说？请按照第一句是问号，第二句是感叹号的格式。比如：「高帅富？屌丝！」「今天考Midterm？哥还没复习！」</p>
				</div>
			</div>
		</fieldset>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">下一步</button>
			<button type="reset" class="btn">取消</button>
		</div>
	<?php echo form_close(); ?>
</div>