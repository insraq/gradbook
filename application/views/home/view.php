<?php echo nav();?>

<div class="row">
	<div class="span3 sidebar">
		<h2><?php echo $profile->user->name; ?> <?php echo $profile->nickname ? '(' . htmlspecialchars($profile->nickname) . ')' : ''; ?></h2>
		<img src="<?php echo empty($profile->photo) ? base_url('asset/img/avatar.png') : base_url('upload/thumb_' . $profile->photo); ?>" alt="$profile->user->name" class="photo" />
		<p>
			<b>书院:</b>
			<?php echo $profile->college; ?>
		</p>
		<p>
			<b>学院:</b>
			<?php echo $profile->faculty; ?>
		</p>
		<p>
			<b>专业:</b>
			<?php echo $profile->department; ?>
		</p>
		<p>
			<b>省份:</b>
			<?php echo $profile->province; ?>
		</p>
		<p>
			<b>OCamp大组:</b>
			<?php echo $profile->ocamp_big; ?>
		</p>
		<p>
			<b>OCamp小组:</b>
			<?php echo $profile->ocamp_small; ?>
		</p>
		<p>
			<b>星座:</b>
			<?php $astro = get_astro($profile->month, $profile->day); echo $astro['name']; ?><?php echo $gender[$profile->gender]; ?>
		</p>
		<p>
			<b>情感:</b>
			<?php echo $profile->relationship == '恋爱中' ? '<i class="icon-heart"></i>' : ''; ?> <?php echo $profile->relationship; ?>
		</p>
		<p>
			<b>毕业去向:</b>
			<?php echo htmlspecialchars($profile->aim); ?>
		</p>
		<p>
			<b>最难忘时刻:</b>
			<?php echo $profile->moment ? htmlspecialchars($profile->moment) : '还没有写呢。'; ?>
		</p>
		<p>
			<b>对中大说的话:</b>
			<?php echo $profile->comment1 ? htmlspecialchars($profile->comment1) : '神马'; ?>？<?php echo $profile->comment2 ? htmlspecialchars($profile->comment2) : '还木有写'; ?>！
		</p>
		<p>
			<b>香港手机:</b>
			<?php echo htmlspecialchars($profile->mobile); ?>
		</p>
		<p>
			<b>电邮:</b>
			<?php echo htmlspecialchars($profile->user->email); ?>
		</p>
		<p>
			<b>QQ:</b>
			<?php echo htmlspecialchars($profile->qq); ?>
		</p>		
		<p>
			<b>MSN:</b>
			<?php echo htmlspecialchars($profile->msn); ?>
		</p>
	</div>
	<div class="span9">
		<h2>涂鸦墙</h2>
		<?php if ($user->id != $profile->user->id): ?>
		<?php echo form_open('comment/update/' . $profile->user->id); ?>
			<p>
				<label>用一个词形容<?php echo ($profile->gender == 'M') ? '他' : '她'; ?></label>
				<input type="text" name="word" class="span9" <?php echo empty($my) ? 'placeholder="正太？萝莉？御姐？怪蜀黍？闷骚？"' : 'value="' . htmlspecialchars($my->word) . '"'; ?> />
			</p>
			<p>
				<label>对<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>说的话 <span class="bubble"><i class="icon-pencil"></i> 公开</span></label>
				<textarea class="span9" rows="3" name="public">
					<?php echo empty($my) ? '' : 'value="' . htmlspecialchars($my->public) . '"'; ?>
				</textarea>
			</p>
			<p>
				<label>对<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>说的话 <span class="bubble"><i class="icon-lock"></i> 私密</span></label>
				<textarea class="span9" rows="3" name="private">
					<?php echo empty($my) ? '' : 'value="' . htmlspecialchars($my->private) . '"'; ?>
				</textarea>
			</p>
			<p>
				<input type="radio" name="love" value="no" <?php echo (empty($my) OR $my->love == 'no') ? 'checked' : ''; ?> /> <i class="icon-user"></i> 同学
				<input type="radio" name="love" value="already" <?php echo (!empty($my) AND $my->love == 'already') ? 'checked' : ''; ?> /> <i class="icon-heart"></i> 情侣
				<input type="radio" name="love" value="public" <?php echo (!empty($my) AND $my->love == 'public') ? 'checked' : ''; ?> /> <i class="icon-volume-up"></i> 表白
				<input type="radio" name="love" value="private" <?php echo (!empty($my) AND $my->love == 'private') ? 'checked' : ''; ?> /> <i class="icon-random"></i> 暗恋
				<a href="#" class="bubble left20" id="status-help-button">这是神马？</a>
			</p>
			<p>
				<input type="checkbox" name="accept" value="auto"  <?php echo (!empty($my) AND $my->accept == 1) ? 'checked' : ''; ?>/> 如果<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>对我表白或者暗恋我，自动接受。
			</p>
			<div id="status-help" style="display:none;">
				<p>
					<span class="bubble"><i class="icon-user"></i> 同学</span>
					我和<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>是绝对最纯洁基友或闺蜜关系，绝对经得起时间考验。
				</p>
				<p>
					<span class="bubble"><i class="icon-heart"></i> 情侣</span>
					我和<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>是情侣，只有<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>也认为你是情侣，这条消息才会公开。
				</p>
				<p>
					<span class="bubble"><i class="icon-volume-up"></i> 表白</span>
					对<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>公开表白，这条消息将会公开。你无限次公开表白，性别不限。
				</p>
				<p>
					<span class="bubble"><i class="icon-random"></i> 暗恋</span>
					系统会将这条消息保密，如果<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>也暗恋你，系统将私下通知你们。你最多可以暗恋五个人，性别不限。
				</p>
			</div>
			<button type="submit" class="btn btn-primary">提交</button>
			<button type="reset" class="btn">取消</button>
		<?php echo form_close(); ?>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	$('#status-help-button').click(function(e) {
		e.preventDefault();
		$('#status-help').slideToggle();
	})
</script>