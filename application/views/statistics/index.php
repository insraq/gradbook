<?php echo nav(5);?>

<?php foreach ($url as $u): ?>

	<p><img src="<?php echo $u; ?>" alt="" /></p>
	<p>
		<a target="_blank" href="http://widget.renren.com/dialog/forward?url=<?php echo urlencode(site_url('statistics')); ?>&title=<?php echo urlencode('香港中文大学2012毕业纪念册风云统计'); ?>&images=<?php echo urlencode($u); ?>">
			<img src="<?php echo base_url('asset/img/renren_share.png'); ?>" alt="" />
		</a>
		<a target="_blank" href="http://service.weibo.com/share/share.php?url=<?php echo urlencode(site_url('widget/lyrics')); ?>&title=<?php echo urlencode('香港中文大学2012毕业纪念册风云统计'); ?>&pic=<?php echo urlencode($u); ?>">
			<img src="<?php echo base_url('asset/img/weibo.gif'); ?>" alt="" />
		</a>
	</p>

<?php endforeach; ?>