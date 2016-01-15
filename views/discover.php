<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>

<?php for($i = 0; $i < count($music); ++$i): ?>
    <div id="videoHolder">
            <div class='eachVideoBox'>
                <div class="embedded">
                    <?php
                        echo html_entity_decode('&lt;iframe width=&quot;300&quot; height=&quot;300&quot; src=&quot;https://www.youtube.com/embed/'.$music[$i]['link'].'&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;', ENT_QUOTES);
                    ?>
                </div>
                <div class="extra">
                    <a target="_blank" rel="nofollow" href="<?php echo Config::get('base')."D".$music[$i]['id']."/"; ?>">
                        <span class="glyphicon glyphicon-share option" aria-hidden="true"></span>
                    </a>
                    <a target="invisibleFrame" rel="nofollow" href="<?php echo Config::get('base')."gift/D".$music[$i]['id']."/"; ?>">
                        <span class="glyphicon glyphicon-gift option" aria-hidden="true"></span>
                    </a>
                    <iframe name="invisibleFrame" id="invisibleFrame"></iframe>
                </div>
            </div>
    </div>
<?php endfor; ?>

<div class="pageButtons col-xs-9">
    <?php if($numPages > 1): ?>
            <?php for($i = 1; $i <= $numPages; ++$i):
                $link = Config::get('base');
                $link = $link."discover/page/";
                $link = $link.$i."/";
                ?>
                <a href="<?php echo $link; ?>" class="option <?php if($i == $page){echo "active";} ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
    <?php endif; ?>
</div>

<script>
	$.ajax({
		url: "<?php echo Config::get('controllersPath'); ?>discoveryController.php",
		success: function(result){
			console.log("Update Request Output: ");
			console.log(result);
		}
	});
</script>

<?php include('includes/closing.php') ?>
