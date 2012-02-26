<?php echo nav(4);?>
<h2>我的歌词帖</h2>
<p>
	<img src="<?php echo base_url('upload/lyrics/' . $user->id . '.png'); ?>" alt="" />
</p>
<p>
	<a target="_blank" href="http://widget.renren.com/dialog/forward?url=<?php echo urlencode(site_url('widget/lyrics')); ?>&title=<?php echo urlencode('毕业纪念册之我的歌词帖'); ?>&images=<?php echo urlencode(base_url("upload/lyrics/{$user->id}.png")); ?>">
		<img src="<?php echo base_url('asset/img/renren_share.png'); ?>" alt="" />
	</a>
<!-- 	<a target="_blank" href="http://widget.renren.com/dialog/share?resourceUrl=<?php echo urlencode(site_url('widget/lyrics')); ?>&pic=<?php echo urlencode(base_url("{$user->id}.png")); ?>&title=<?php echo urlencode('我的歌词帖'); ?>&description=<?php echo urlencode($lyrics); ?>&images=<?php echo urlencode(base_url("{$user->id}.png")); ?>&charset=UTF-8">
		<img src="<?php echo base_url('asset/img/renren_share.png'); ?>" alt="" />
	</a> -->
	<a target="_blank" href="http://service.weibo.com/share/share.php?url=<?php echo urlencode(site_url('widget/lyrics')); ?>&title=<?php echo urlencode('毕业纪念册之我的歌词帖：' . $lyrics); ?>&pic=<?php echo urlencode(base_url("upload/lyrics/{$user->id}.png")); ?>">
		<img src="<?php echo base_url('asset/img/weibo.gif'); ?>" alt="" />
	</a>
</p>