<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>

<div style="width:350px;">
	<?php if($gifts): ?>
		<a href="<?php echo Config::get('base'); ?>gift/">
			<span class="glyphicon glyphicon-gift option giftbox" aria-hidden="true"></span>
		</a>
	<?php endif; ?>
	<?php echo $message; ?>
	<!--<span class="glyphicon glyphicon-heart heart-icon" aria-hidden="true">
		<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
	</span>-->
</div>

<?php include('includes/closing.php') ?>
