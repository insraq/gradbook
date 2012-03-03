<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>书院</th>
			<th>学院</th>
			<th>OCamp大组</th>
			<th>OCamp小组</th>
			<th>香港手机</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($profile as $p): ?>
		<tr>
			<td><?php echo $p->user->name; ?></td>
			<td><?php echo $p->user->college; ?></td>
			<td><?php echo $p->faculty; ?></td>
			<td><?php echo $p->ocamp_big; ?></td>
			<td><?php echo $p->ocamp_small; ?></td>
			<td><?php echo $p->mobile; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>