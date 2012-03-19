<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>书院</th>
			<th>学院</th>
			<th>专业</th>
			<th>OCamp大组</th>
			<th>OCamp小组</th>
			<th>香港手机</th>
			<th>头像</th>
			<th>纪念册</th>
			<th>毕业派对</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($profile as $p): ?>
		<tr>
			<td><?php echo $p->user->name; ?></td>
			<td><?php echo $p->user->college; ?></td>
			<td><?php echo $p->faculty; ?></td>
			<td><?php echo $p->department; ?></td>
			<td><?php echo $p->ocamp_big; ?></td>
			<td><?php echo $p->ocamp_small; ?></td>
			<td><?php echo $p->mobile; ?></td>
			<td><?php echo empty($p->photo) ? '<b>否</b>' : '是'; ?></td>
			<td><input type="checkbox" class="order-gradbook" rel="<?php echo $p->id; ?>" <?php echo $p->order_gradbook ? 'checked="checked"' : ''; ?>/></td>
			<td><input type="checkbox" class="order-party" rel="<?php echo $p->id; ?>" <?php echo $p->order_party ? 'checked="checked"' : ''; ?>/></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<script type="text/javascript">
	$('.order-gradbook').change(function() {
		var profile = $(this).attr('rel');
		var myself = $(this);
		$.post('<?php echo site_url('home/order_gradbook');?>/' + profile, {op: myself.is(':checked')}, function(data) {
			if (data && data.status == 200) {
				alert('更新成功。');
			}
			else
			{
				alert('发生错误。');
			}
		}, 'json');
	});

	$('.order-party').change(function() {
		var profile = $(this).attr('rel');
		var myself = $(this);
		$.post('<?php echo site_url('home/order_party');?>/' + profile, {op: myself.is(':checked')}, function(data) {
			if (data && data.status == 200) {
				alert('更新成功。');
			}
			else
			{
				alert('发生错误。');
			}
		}, 'json');
	});
</script>