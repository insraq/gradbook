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
			<?php 
				if (!empty($profile->month) AND !empty($profile->day))
				{
					$astro = get_astro($profile->month, $profile->day);
					echo $astro['name'];				
				}
			?>			
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
			<div class="alert">
				你只能填写一次留言，但是你可以随时更改你的留言。
			</div>
			<p>
				<label>用一个词形容<?php echo ($profile->gender == 'M') ? '他' : '她'; ?></label>
				<input type="text" name="word" class="span9" <?php echo empty($my) ? 'placeholder="正太？萝莉？御姐？怪蜀黍？闷骚？"' : 'value="' . htmlspecialchars($my->word) . '"'; ?> />
			</p>
			<p>
				<label>对<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>说的话 <span class="bubble"><i class="icon-pencil"></i> 公开</span></label>
				<textarea class="span9" rows="3" name="public"><?php echo empty($my) ? '' : htmlspecialchars($my->public) ; ?></textarea>
			</p>
			<p>
				<label>对<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>说的话 <span class="bubble"><i class="icon-lock"></i> 私密</span></label>
				<textarea class="span9" rows="3" name="private"><?php echo empty($my) ? '' : htmlspecialchars($my->private) ; ?></textarea>
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
		<ul class="comment">
			<?php foreach ($comment as $c): ?>
			<li>
				<a href="<?php echo site_url('home/view/' . $c->from_user); ?>"><img src="<?php echo R::findOne('profile', 'user_id = ?', array($c->from_user))->photo ? base_url('upload/thumb_' . (R::findOne('profile', 'user_id = ?', array($c->from_user))->photo)) : base_url('asset/img/avatar.png'); ?>" alt="" class="photo-small photo-right" /></a>
				<div class="meta">
					<a href="<?php echo site_url('home/view/' . $c->from_user); ?>" class="bubble">来自：<?php echo R::load('user', $c->from_user)->name; ?></a>
					<span class="bubble">一个词形容<?php echo ($profile->gender == 'M') ? '他' : '她'; ?>：<?php echo $c->word; ?></span>
					<?php if ($c->love == 'public'): ?>
						<span class="bubble"><i class="icon-volume-up"></i> 表白</span>
					<?php endif; ?>
					<span class="bubble">最后更新：<?php echo date('Y-m-d H:i', $c->last_update); ?></span>
				</div>
				<p class="public">
					<?php echo htmlspecialchars($c->public); ?>
				</p>
				<?php if ($user->id == $c->from_user OR $user->id == $c->to_user): ?>
				<p class="private">
					<i class="icon-lock"></i>
					<?php echo htmlspecialchars($c->private); ?>
				</p>
				<?php endif; ?>
				<div class="clear"></div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	$('#status-help-button').click(function(e) {
		e.preventDefault();
		$('#status-help').slideToggle();
	})
</script>