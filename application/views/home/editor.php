<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>印象最深的时刻</th>
			<th>？！</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($profile as $p): ?>
		<tr>
			<td><?php echo $p->user->name; ?></td>
			<td><?php echo $p->moment; ?></td>
			<td><?php echo $p->comment1; ?>？<?php echo $p->comment2; ?>！</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>一句话证明</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($sentence as $s): ?>
		<tr>
			<td><?php echo $s->user->name; ?></td>
			<td><?php echo $s->text; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>后悔</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($regret as $r): ?>
		<tr>
			<td><?php echo $r->user->name; ?></td>
			<td><?php echo $r->text; ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>姓名</th>
			<th>后悔</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($user as $u): ?>
		<tr>
			<td><?php echo $u->name; ?></td>
			<td><?php echo anchor("upload/" . R::findOne('profile', 'user_id = ?', array($u->id))->photo, '下载图片'); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>