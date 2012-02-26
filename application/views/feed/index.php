<?php echo nav();?>

<h2>路边社</h2>
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