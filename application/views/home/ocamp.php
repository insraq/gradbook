<?php echo nav(2);?>

<?php if (empty($profile->photo)): ?>
<div class="alert">
	你还没有上传照片，照片将会印在毕业纪念册上，快点点击 <a href="<?php echo site_url('user/profile'); ?>" class="btn">修改资料</a> 上传一张大于1000像素的正方形照片吧！
</div>
<?php endif; ?>

<h3>08 Ocamp<h3>
<p>08 OCamp 让我们结识了大学中的第一批朋友，而现在，我们即将毕业，希望这个向OCamp致敬的专题，能让大家回到那些年，回忆起那些事。</p>

<?php foreach ($group as $k => $v): ?>
	<a href="<?php echo site_url('home/filter/ocamp_big/' . urlencode($k)); ?>" class="btn btn-primary ocamp"><?php echo $k; ?></a>
	<?php foreach ($v as $s): ?>
		<a href="<?php echo site_url('home/filter/ocamp_small/' . urlencode($s)); ?>" class="btn ocamp"><?php echo $s; ?></a>
	<?php endforeach; ?>
	<div class="clear"></div>
<?php endforeach; ?>