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
                <!--<a target="invisibleFrame" rel="nofollow" href="<?php echo Config::get('base')."gift/".$code.$music[$i]['id']."/"; ?>">
                    <span class="glyphicon glyphicon-gift option" aria-hidden="true"></span>
                </a>-->
                <iframe name="invisibleFrame" id="invisibleFrame"></iframe>
            </div>
        </div>
    </div>
<?php endfor; ?>

<!-- Page number buttons -->
<div class="pageButtons col-xs-9">
    <?php 
        $pageLink = Config::get('base');
        if($selectedGenre){
            $pageLink = $pageLink.$selectedGenre."/page/";
        }
        elseif($code == 'D'){
            $pageLink = $pageLink."discover/page/";
        }
        else{
            $pageLink = $pageLink."all/page/";
        }
    ?>
    <?php if($numPages > 1): ?>
        <?php if($page >4): ?>
            <?php
                $link = $pageLink."1/";
            ?>
            <a href="<?php echo $link; ?>" class="option <?php if('1' == $page){echo "active";} ?>">
                <?php echo '1'; ?>
            </a>
        <?php endif; ?> 
        <?php if($page > 5): ?>
            ...
        <?php endif; ?>
        <?php for($i = $page - 3; $i <= $page + 3; ++$i):
            if($i > 0 && $i <= $numPages){
                $link = $pageLink.$i."/";
                ?>
                <a href="<?php echo $link; ?>" class="option <?php if($i == $page){echo "active";} ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        <?php endfor; ?>    
        <?php if($page < $numPages - 4): ?>
            ...
        <?php endif; ?>
        <?php if($page < $numPages - 3): ?>
            <?php
                $link = $pageLink.$numPages."/";
            ?>
            <a href="<?php echo $link; ?>" class="option <?php if($numPages == $page){echo "active";} ?>">
                <?php echo $numPages; ?>
            </a>
        <?php endif; ?>    
    <?php endif; ?>
    <?php if($numPages > 5): ?>
        <br />
        <input type="number" min="0" max="<?php echo $numPages; ?>" id="directPage">
        <button type="button" onClick="goToPage()">Go</button>
    <?php endif; ?>
</div>
<!-- JS to go directly to page on click button -->
<script>
    function goToPage(){
        window.location.href = "<?php echo $pageLink; ?>" + $("#directPage").val() + '/';
    }
</script>

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
