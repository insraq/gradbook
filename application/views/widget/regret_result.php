<?php echo nav(7;?>
<h2>大学遗憾的事情</h2>
<p>
	<img src="<?php echo base_url("upload/one_sentence/{$file}.png"); ?>" alt="" />
</p>
<p>
	<a target="_blank" href="http://widget.renren.com/dialog/forward?url=<?php echo urlencode(site_url('widget/one')); ?>&title=<?php echo urlencode('毕业纪念册之大学遗憾的事情'); ?>&images=<?php echo urlencode(base_url("upload/one_sentence/{$file}.png")); ?>">
		<img src="<?php echo base_url('asset/img/renren_share.png'); ?>" alt="" />
	</a>
	<a target="_blank" href="http://service.weibo.com/share/share.php?url=<?php echo urlencode(site_url('widget/one')); ?>&title=<?php echo urlencode('毕业纪念册之#大学遗憾的事情#：' . $one_sentence); ?>&pic=<?php echo urlencode(base_url("upload/one_sentence/{$file}.png")); ?>">
		<img src="<?php echo base_url('asset/img/weibo.gif'); ?>" alt="" />
	</a>
</p>