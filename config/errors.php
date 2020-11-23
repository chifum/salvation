<?php if(count($errors) > 0) : ?>
	<div class='alert alert-danger'>
			<?php foreach ($errors as  $error) : ?>
				<strong><?php echo $error; ?></strong>
			<?php endforeach ?>
	</div>
<?php endif ?>

<?php if(count($successes) > 0) : ?>
	<div class='alert alert-success'>
			<?php foreach ($successes as  $success) : ?>
				<strong><?php echo $success; ?></strong>
			<?php endforeach ?>
	</div>
<?php endif ?>