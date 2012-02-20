<?php echo nav(2);?>

<?php if (empty($profile->photo)): ?>
<div class="alert">
	你还没有上传照片，照片将会印在毕业纪念册上，快点点击 <a href="<?php echo site_url('user/profile'); ?>" class="btn">修改资料</a> 上传一张大于1000像素的正方形照片吧！
</div>
<?php endif; ?>

<?php foreach ($group as $k => $v): ?>
	<p>
		<a href="<?php echo site_url('home/filter/ocamp_big/' . urlencode($k)); ?>" class="btn btn-large btn-primary"><?php echo $k; ?></a>
		<?php foreach ($v as $s): ?>
			<a href="<?php echo site_url('home/filter/ocamp_small/' . urlencode($s)); ?>" class="btn btn-large"><?php echo $s; ?></a>
		<?php endforeach; ?>
	</p>

<?php endforeach; ?>