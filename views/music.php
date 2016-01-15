<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>

<?php for($i = 0; $i < count($music); ++$i): ?>
    <div id="videoHolder">
            <div class='eachVideoBox'>
                <div class="embedded">
                    <?php echo html_entity_decode($music[$i]['embed'], ENT_QUOTES); ?>
                </div>
                <div class="extra">
                    <a target="_blank" href="<?php echo Config::get('base').$code.$music[$i]['id']."/"; ?>">
                        <span class="glyphicon glyphicon-share option" aria-hidden="true"></span>
                    </a>
                    <a target="invisibleFrame" href="<?php echo Config::get('base')."gift/".$code.$music[$i]['id']."/"; ?>">
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
            if($selectedGenre){
                $link = $link.$selectedGenre."/page/";
            }
            else{
                $link = $link."all/page/";
            }
            $link = $link.$i."/";
            ?>
            <a href="<?php echo $link; ?>" class="option <?php if($i == $page){echo "active";} ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>

<?php include('includes/closing.php') ?>
