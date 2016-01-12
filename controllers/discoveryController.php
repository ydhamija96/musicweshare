<?php
include('../config.php');

date_default_timezone_set("America/New_York");
$con=Config::databaseConnection();
$videos = array();
$arguments = 'sort=top&t=week';
$json = file_get_contents('http://www.reddit.com/r/listentothis/top/.json?' . $arguments);
$obj = json_decode($json);
foreach($obj->data->children as $single){
    if(strpos($single->data->domain,'youtube') !== false){
        $ar = preg_split('/watch\?v=/', $single->data->secure_media->oembed->url);
        $ar = preg_split('/\//', $ar[1]);
        array_push($videos, $ar[0]);
    }
}
foreach($videos as $video){
    $sql = "INSERT INTO discovered (link) SELECT '".$video."' FROM DUAL WHERE NOT EXISTS (SELECT * FROM discovered WHERE link='".$video."')";
    if (mysqli_query($con, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
}
echo "Content Updated.";
?>
