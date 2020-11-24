<?php if(count($errors) > 0) : ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php foreach ($errors as  $error) : ?>
				<strong><?php echo $error; ?></strong>
			<?php endforeach ?>
	</div>
<?php endif ?>

<?php if(count($successes) > 0) : ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php foreach ($successes as  $success) : ?>
				<strong><?php echo $success; ?></strong>
			<?php endforeach ?>
	</div>
<?php endif ?>
