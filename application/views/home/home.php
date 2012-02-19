<?php echo nav(0);?>

<p>现在一共有 <b><?php echo count($users); ?></b> 位老鬼登记了，大家快点告诉还没登记的朋友吧！</p>
<div class="progress progress-success progress-striped">
	<div class="bar" style="width: <?php echo round(count($users) / 256); ?>%;"></div>
</div>

<ul class="thumbnails">
	<?php foreach ($users as $u): ?>
	<li class="span3">
		<div href="#" class="thumbnail">
			<img src="<?php echo empty($u->photo) ? base_url('asset/img/avatar.png') : base_url('upload/thumb_' . $u->photo); ?>" alt="$u->user->name" />
			<div class="caption">
				<h3><?php echo $u->user->name; ?> <?php echo $u->nickname ? "({$u->nickname})" : ''; ?></h3>
				<p>
					<span class="bubble"><?php echo $u->faculty; ?></span>
				</p>
				<p>
					<span class="bubble"><?php echo $u->department; ?></span>
				</p>
				<p>
					<span class="bubble"><?php echo $u->province; ?></span>
					<span class="bubble"><?php echo $u->ocamp_big; ?>：<?php echo $u->ocamp_small; ?></span>
				</p>
				<p>
					<span class="bubble"><?php $astro = get_astro($u->month, $u->day); echo $astro['name']; ?><?php echo $gender[$u->gender]; ?></span>
					<span class="bubble"><?php echo $u->relationship == '恋爱中' ? '<i class="icon-heart"></i>' : ''; ?> <?php echo $u->relationship; ?></span>
					<span class="bubble"><?php echo $u->aim; ?></span>
				</p>
			</div>
		</div>
	</li>
	<?php endforeach; ?>	
</ul>
