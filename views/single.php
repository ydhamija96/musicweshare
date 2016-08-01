<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>


<div id="videoHolder">
        <div class='eachVideoBox'>
            <div class="embedded">
                <?php
                    echo html_entity_decode($embed, ENT_QUOTES);
                ?>
            </div>
            <div class="extra">
                <!-- <a target="invisibleFrame" rel="nofollow" href="<?php echo Config::get('base')."gift/".$idString."/"; ?>">
                    <span class="glyphicon glyphicon-gift option" aria-hidden="true"></span>
                </a> -->
                <iframe name="invisibleFrame" id="invisibleFrame"></iframe>
            </div>
        </div>
</div>



<?php include('includes/closing.php') ?>
