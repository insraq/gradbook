<div class="alert <?php echo isset($type) ? $type : ''; ?>">
	<?php echo $message; ?>
</div>

<a href="javascript:history.go(-1);" class="btn btn-primary">后退</a>
<a href="<?php echo site_url(); ?>" class="btn">首页</a>