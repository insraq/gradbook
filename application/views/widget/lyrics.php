<?php echo nav();?>

<?php if (empty($profile->photo)): ?>
<div class="alert">
	你还没有上传照片，照片将会印在毕业纪念册上，快点点击 <a href="<?php echo site_url('user/profile'); ?>" class="btn">修改资料</a> 上传一张大于1000像素的正方形照片吧！
</div>
<?php endif; ?>

<h2>你的歌词帖</h2>
<p>
	<img src="<?php echo base_url('upload/lyrics/' . $user->id . '.png'); ?>" alt="" />
</p>
<p>
	<a name="xn_share" onclick="shareClick()" type="button_medium" href="javascript:;"></a>
</p>
<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
<script type="text/javascript">
	function shareClick() {
		var rrShareParam = {
			resourceUrl : 'http://grad.cuhk.me/widget/lyrics',
			pic : 'http://grad.cuhk.me/upload/lyrics/<?php echo $user->id; ?>.png',
			title : '毕业纪念册：我的歌词帖',
			description : '<?php echo $lyrics; ?>'
		};
		rrShareOnclick(rrShareParam);
	}
</script>