<?php echo nav();?>

<div class="row">
	<div class="span3 sidebar">
		<h2><?php echo $profile->user->name; ?> <?php echo $profile->nickname ? "({$profile->nickname})" : ''; ?></h2>
		<img src="<?php echo empty($profile->photo) ? base_url('asset/img/avatar.png') : base_url('upload/thumb_' . $profile->photo); ?>" alt="$profile->user->name" class="photo" />
		<p>
			<b>书院:</b>
			<?php echo $profile->college; ?>
		</p>
		<p>
			<b>学院:</b>
			<?php echo $profile->faculty; ?>
		</p>
		<p>
			<b>专业:</b>
			<?php echo $profile->department; ?>
		</p>
		<p>
			<b>省份:</b>
			<?php echo $profile->province; ?>
		</p>
		<p>
			<b>OCamp大组:</b>
			<?php echo $profile->ocamp_big; ?>
		</p>
		<p>
			<b>OCamp小组:</b>
			<?php echo $profile->ocamp_small; ?>
		</p>
		<p>
			<b>星座:</b>
			<?php $astro = get_astro($profile->month, $profile->day); echo $astro['name']; ?><?php echo $gender[$profile->gender]; ?>
		</p>
		<p>
			<b>情感:</b>
			<?php echo $profile->relationship == '恋爱中' ? '<i class="icon-heart"></i>' : ''; ?> <?php echo $profile->relationship; ?>
		</p>
		<p>
			<b>毕业去向:</b>
			<?php echo $profile->aim; ?>
		</p>
		<p>
			<b>最难忘时刻:</b>
			<?php echo $profile->moment ?: '还没有写呢。'; ?>
		</p>
		<p>
			<b>对中大说的话:</b>
			<?php echo $profile->comment1 ?: '神马'; ?>？<?php echo $profile->comment2 ?: '还木有写'; ?>！
		</p>
		<p>
			<b>香港手机:</b>
			<?php echo $profile->mobile; ?>
		</p>
		<p>
			<b>电邮:</b>
			<?php echo $profile->user->email; ?>
		</p>
		<p>
			<b>QQ:</b>
			<?php echo $profile->qq; ?>
		</p>		<p>
			<b>MSN:</b>
			<?php echo $profile->msn; ?>
		</p>
	</div>
	<div class="span9">
		<h2>涂鸦墙</h2>
	</div>
</div>