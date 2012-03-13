<?php echo nav(6);?>
<h2>大学遗憾的事情</h2>
<form action="<?php echo site_url('widget/one_sentence');?>" method="post" class="well">
	<p>
		<input type="text" name="sentence" class="span11" placeholder="大学遗憾的事情">
	</p>
	<button type="submit" class="btn btn-primary">提交</button>
</form>