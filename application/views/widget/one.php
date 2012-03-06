<?php echo nav(4);?>
<h2>一句话证明你读过中大</h2>
<form action="<?php echo site_url('widget/one_sentence');?>" method="post" class="well">
	<p>
		<input type="text" name="sentence" class="span11" placeholder="一句话证明你读过中大">
	</p>
	<button type="submit" class="btn btn-primary">提交</button>
</form>