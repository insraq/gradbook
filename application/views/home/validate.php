<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>激活地址</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($validate as $v): ?>
		<tr>
			<td><?php echo $v->user->name; ?></td>
			<td><?php echo site_url("user/activate/{$v->user->id}/{$v->code}") ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>