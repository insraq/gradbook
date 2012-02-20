<?php echo nav(0);?>

<p>现在一共有 <b><?php echo count($users); ?></b> 位老鬼登记了，完成了 <b><?php echo round(100 * count($users) / 256); ?>%</b>，大家快点告诉还没登记的朋友吧！</p>
<div class="progress progress-success progress-striped">
	<div class="bar" style="width: <?php echo round(100 * count($users) / 256); ?>%;"></div>
</div>

<?php if (empty($profile->photo)): ?>
<div class="alert">
	你还没有上传照片，照片将会印在毕业纪念册上，快点点击 <a href="<?php echo site_url('user/profile'); ?>" class="btn">修改资料</a> 上传一张大于1000像素的正方形照片吧！
</div>
<?php endif; ?>

<ul class="thumbnails">
	<?php foreach ($users as $u): ?>
	<li class="span3">
		<div href="#" class="thumbnail">
			<img src="<?php echo empty($u->photo) ? base_url('asset/img/avatar.png') : base_url('upload/thumb_' . $u->photo); ?>" alt="$u->user->name" />
			<div class="caption">
				<h3><?php echo $u->user->name; ?> <?php echo $u->nickname ? "({$u->nickname})" : ''; ?></h3>
				<p>
					<a href="<?php echo site_url('home/filter/faculty/' . urlencode($u->faculty)); ?>" class="bubble"><?php echo $u->faculty; ?></a>
					<a href="<?php echo site_url('home/filter/college/' . urlencode($u->college)); ?>" class="bubble"><?php echo $u->college; ?></a>
				</p>
				<p>
					<a href="<?php echo site_url('home/filter/department/' . urlencode($u->department)); ?>" class="bubble"><?php echo $u->department; ?></a>
				</p>
				<p>
					<a href="<?php echo site_url('home/filter/province/' . urlencode($u->province)); ?>" class="bubble"><?php echo $u->province; ?></a>
					<a href="<?php echo site_url('home/filter/ocamp_big/' . urlencode($u->ocamp_big)); ?>" class="bubble"><?php echo $u->ocamp_big; ?></a>
					<a href="<?php echo site_url('home/filter/ocamp_small/' . urlencode($u->ocamp_small)); ?>" class="bubble"><?php echo $u->ocamp_small; ?></a>
				</p>
				<p>
					<span class="bubble"><?php $astro = get_astro($u->month, $u->day); echo $astro['name']; ?><?php echo $gender[$u->gender]; ?></span>
					<a href="<?php echo site_url('home/filter/relationship/' . urlencode($u->relationship)); ?>" class="bubble <?php echo $u->relationship == '恋爱中' ? 'bubble-love' : ''; ?>"><?php echo $u->relationship == '恋爱中' ? '<i class="icon-heart icon-white"></i>' : ''; ?> <?php echo $u->relationship; ?></a>
					<a href="<?php echo site_url('home/filter/aim/' . urlencode($u->aim)); ?>" class="bubble"><?php echo $u->aim; ?></a>
				</p>
			</div>
		</div>
	</li>
	<?php endforeach; ?>	
</ul>
