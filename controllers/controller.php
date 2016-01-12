<?php
include('../config.php');

$mode = $_GET['loc'];
$con = Config::databaseConnection();
$allTypes = mysqli_query($con, "SELECT * FROM types");
$showAll = false;
$selectedGenre = false;
if(isset($_GET['type'])){
    $selectedGenre = true;
}
$genres = [];
while($row = mysqli_fetch_array($allTypes)){
    $showAll = true;
    $temp['url'] = $row['type'];
    if($selectedGenre && $_GET['type'] == $temp['url']){
        $selectedGenre = $temp['url'];
    }
    $temp['name'] = ucwords(html_entity_decode(str_replace('_', ' ', $row['type']), ENT_QUOTES));
    $genres[] = $temp;
}
$perpage = 12;

if($selectedGenre === true){
    header("HTTP/1.0 404 Not Found");
    include('../views/404.php');
    exit;
}
elseif($mode == 1){ //message
    include('../views/message.php');
    exit;
}
elseif($mode == 2){ //add
    include('../views/add.php');
    exit;
}
elseif($mode == 3){ //discover
    $count = 0;
    if(isset($_GET['page'])){
        $page = intval($_GET['page']);
    }
    else{
        $page = 1;
    }
    if($page < 1){
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    $offset = ($page - 1)*$perpage;
    $musicRaw = mysqli_query($con, "SELECT * from discovered ORDER BY date DESC, id DESC LIMIT $perpage OFFSET $offset");
    $music = [];
    while($row = mysqli_fetch_array($musicRaw)){
        $music[] = $row;
    }
    $counter = mysqli_query($con, "SELECT COUNT(*) AS id FROM discovered");
    $num = mysqli_fetch_array($counter);
    $count = $num["id"];
    $numPages = intval(ceil($count/$perpage));
    if($page > $numPages){
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    include('../views/discover.php');
    exit;
}
elseif($mode == 4){ //music
    $seed = 0;
    $count = 0;
    if(isset($_GET['page'])){
        $page = intval($_GET['page']);
    }
    else{
        $page = 1;
    }
    if($page < 1){
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    if(isset($_COOKIE['randomSeed'])){
        $seed = intval($_COOKIE['randomSeed']);
    }
    else{
        $seed = rand(1,100000);
        setcookie('randomSeed', $seed);
    }
    $offset = ($page - 1)*$perpage;
    if($selectedGenre != false){
        $checkType = mysqli_query($con, "SELECT * from types WHERE type = '$selectedGenre'");
        $existingType = mysqli_fetch_array($checkType);
        $typeId = $existingType['id'];
        $musicRaw = mysqli_query($con, "SELECT * from music WHERE type = '$typeId' ORDER BY RAND($seed) LIMIT $perpage OFFSET $offset");
        $counter = mysqli_query($con, "SELECT COUNT(*) AS id FROM music WHERE type = '$typeId'");
        $num = mysqli_fetch_array($counter);
        $count = $num["id"];
    }
    else{
        $musicRaw = mysqli_query($con, "SELECT * from music ORDER BY RAND($seed) LIMIT $perpage OFFSET $offset");
        $counter = mysqli_query($con, "SELECT COUNT(*) AS id FROM music");
        $num = mysqli_fetch_array($counter);
        $count = $num["id"];
    }
    $music = [];
    while($row = mysqli_fetch_array($musicRaw)){
        $music[] = $row;
    }
    $numPages = intval(ceil($count/$perpage));
    if($page > $numPages){
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    include('../views/music.php');
    exit;
}
elseif($mode == 5){ //single ID
    $id = -1;
    if(isset($_GET['id'])){
        $id = (string)$_GET['id'];
    }
    if(strlen($id) < 2){
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    $code = $id[0];
    $id = substr($id, 1);
    if($code == 'D'){
        $table = "discovered";
		$res = mysqli_query($con, "SELECT * from $table WHERE id = '$id'");
		$resa = mysqli_fetch_array($res);
        $embed = $resa['link'];
        $embed = '&lt;iframe width=&quot;300&quot; height=&quot;300&quot; src=&quot;https://www.youtube.com/embed/'.$embed.'&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;';
    }
    elseif($code == 'M'){
        $table = "music";
		$res = mysqli_query($con, "SELECT * from $table WHERE id = '$id'");
		$resa = mysqli_fetch_array($res);
        $embed = $resa['embed'];
    }
    else{
        header("HTTP/1.0 404 Not Found");
        include('../views/404.php');
        exit;
    }
    include('../views/single.php');
    exit;
}
else{
    header("HTTP/1.0 404 Not Found");
    include('../views/404.php');
    exit;
}
?>
