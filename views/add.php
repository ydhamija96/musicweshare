<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>

<form action="<?php echo Config::get('controllersPath'); ?>/submitController.php" method="POST" target="theFrame" style="font-size:16px;">
	<span style="font-size:23px;">New music? Awesome!</span><br><br>
	Just paste the embed code here:<br> <textarea style="width:100%; max-width:400px; height:75px;" name="embed"></textarea><br>
	Please make sure the height and width are 300px.<br><br>
	What type is it?
    <?php
        if(count($genres) > 0){
            echo("So far we have these types (but feel free to make a new one):");
        }
    ?>
    <br>
	<div style="margin-left:20px;">
	<?php
		foreach($genres as $genre){
            echo $genre['name'];
            echo "<br />";
        }
	?>
	</div>
	Type that in here: <input type="text" name="type"><br><br>
	Now, you gotta give me the password.<br>
	Just put that right here: <input name="password" type="password"><br><br>
	Shiny! Now, press the submit button, and we're golden.<br>
	<strong>Beware: Once added, music cannot be removed.</strong><br>
	<input type="submit" value="Submit"><br><br>
</form>

<iframe name="theFrame" style="height:0px; width:0px; display:none; margin:0; padding:0; border:0;"></iframe>

<?php include('includes/closing.php') ?>
