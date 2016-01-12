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
            </div>
        </div>
</div>



<?php include('includes/closing.php') ?>
