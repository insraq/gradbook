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
	<!-- <a name="xn_share" onclick="shareClick()" type="button_medium" href="javascript:;"></a> -->
	<script type="text/javascript" charset="utf-8">
	// (function(){
	// 	var p = [], w=130, h=24,
	// 	lk = {
	// 	url:'<?php echo site_url('widget/lyrics'); ?>'||location.href, /*喜欢的URL(不含如分页等无关参数)*/
	// 	title:'毕业纪念册：我的歌词帖'||document.title, /*喜欢标题(可选)*/
	// 	description:'<?php echo $lyrics; ?>', /*喜欢简介(可选)*/
	// 	image:'<?php echo base_url('upload/lyrics/' . $user->id . '.png'); ?>' /*喜欢相关图片的路径(可选)*/
	// 	};
	// 	for(var i in lk){
	// 	p.push(i + '=' + encodeURIComponent(lk[i]||''));
	// }
	// document.write('<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://www.connect.renren.com/like/v2?'+p.join('&')+'" style="width:'+w+'px;height:'+h+'px;"></iframe>');
	// })();
	</script>
	把鼠标移动到图片上，点击右下角浮现的“人人转发”，一键转发到人人网。
</p>
<script type="text/javascript" src="http://widget.renren.com/js/forward.js" async="true"></script>

<!-- 
<script type="text/javascript" src="http://widget.renren.com/js/rrshare.js"></script>
<script type="text/javascript">
	function shareClick() {
		var rrShareParam = {
			resourceUrl : '<?php echo site_url('widget/lyrics'); ?>',
			pic : '<?php echo base_url('upload/lyrics/' . $user->id . '.png'); ?>',
			title : '毕业纪念册：我的歌词帖',
			description : '<?php echo $lyrics; ?>'
		};
		rrShareOnclick(rrShareParam);
	}
</script> -->