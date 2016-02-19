<?php include('includes/title.php') ?>
<?php include('includes/sidebar.php') ?>

<!-- Videos -->
<?php for($i = 0; $i < count($music); ++$i): ?>
    <div id="videoHolder">
        <div class='eachVideoBox'>
            <div class="embedded" id='embed<?php echo $i; ?>'></div>
            <div class="extra">
                <a target="_blank" rel="nofollow" href="<?php echo Config::get('base').$code.$music[$i]['id']."/"; ?>">
                    <span class="glyphicon glyphicon-share option" aria-hidden="true"></span>
                </a>
                <a target="invisibleFrame" rel="nofollow" href="<?php echo Config::get('base')."gift/".$code.$music[$i]['id']."/"; ?>">
                    <span class="glyphicon glyphicon-gift option" aria-hidden="true"></span>
                </a>
                <iframe name="invisibleFrame" id="invisibleFrame"></iframe>
            </div>
        </div>
    </div>
<?php endfor; ?>

<!-- Page number buttons -->
<div class="pageButtons col-xs-9">
    <?php if($numPages > 1): ?>
        <?php for($i = 1; $i <= $numPages; ++$i):
            $link = Config::get('base');
            if($selectedGenre){
                $link = $link.$selectedGenre."/page/";
            }
            elseif($code == 'D'){
                $link = $link."discover/page/";
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

<!-- JS to load videos only when they scroll into view -->
<script>
    var embeds = [
        <?php
            foreach($music as $i){
                echo "'".trim(html_entity_decode($i['embed'], ENT_QUOTES))."',";
            }
        ?>
    ];
    var perpage = <?php echo $perpage; ?>;
    function isScrolledIntoView(elem){
        var $elem = $(elem);
        var $window = $(window);
        var docViewTop = $window.scrollTop();
        var docViewBottom = docViewTop + $window.height();
        var elemTop = $elem.offset().top;
        var elemBottom = elemTop + $elem.height();
        //return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
    }
    var nextload = 0;
    function load(){
        if(nextload < perpage){
            if(isScrolledIntoView("#embed"+nextload)){
                $("#embed"+nextload).html(embeds[nextload]);
                ++nextload;
                load();
            }
        }
    }
    $(function() {
        load();
        $( document ).scroll(function(){
            load();
        });
    });
</script>

<!-- Ajax to update discovered videos -->
<?php if($code == 'D'): ?>
    <script>
    	$.ajax({
    		url: "<?php echo Config::get('controllersPath'); ?>discoveryController.php",
    		success: function(result){
    			console.log("Update Request Output: ");
    			console.log(result);
    		}
    	});
    </script>
<?php endif; ?>

<?php include('includes/closing.php') ?>
