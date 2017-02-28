<div id="sidebar" class="col-xs-3">
    <!-- <a href="<?php echo Config::get('base').'message/'; ?>"><div class="option <?php if($mode == 1){echo "active";} ?>">Message</div></a> -->
    <br>
    <a href="<?php echo Config::get('base'); ?>"><div class="option <?php if($mode == 3){echo "active";} ?>">Discover Music</div></a>
    <br>
    <a href="<?php echo Config::get('base'); ?>add/"><div class="option <?php if($mode == 2){echo "active";} ?>">Save Music</div></a>
    <br><br>
    <ul class="typeList">
        <?php
            $allTypes = mysqli_query($con, "SELECT * FROM types");
            $types = 0;
            foreach($genres as $genre){
                $activeString = "";
                if($mode == 4 && $selectedGenre === $genre['url']){
                    $activeString = "active";
                }
                echo('<a href="'.Config::get('base').$genre['url'].'/"><li class="option '.$activeString.'">'.$genre['name'].'</li></a>');
            }
            if($showAll){
                $activeString = "";
                if($mode == 4 && !$selectedGenre){
                    $activeString = "active";
                }
                echo('<br><a href="'.Config::get('base').'all/"><li class="option '.$activeString.'">All Music</li></a>');
            }
        ?>
    </ul>
</div>
<div id="content" class="col-xs-9">
