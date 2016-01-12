<?php
include('../config.php');

$con = Config::databaseConnection();
if( isset($_POST['embed']) && isset($_POST['type']) && isset($_POST['password']) ){
    $thePasswordIsRight = 0;
    $rawPassword = $_POST['password'];
    $query = mysqli_query($con, "SELECT * from salt WHERE id = 0");
    $array = mysqli_fetch_array($query);
    $dbSalt = $array['salt'];
    $passAndSalt = $rawPassword . $dbSalt;
    $badSalt = "this!Is@The#Salt\$That%I^Just&Came*Up(With)Out-OF_My=Ass+65312";
    $hashedPass = crypt($passAndSalt, '$6$rounds=5000$'.$badSalt.'$');
    if ($hashedPass == "\$6\$rounds=5000\$this!Is@The#Salt\$reCMW6MmmTZPLAa8D6IqTseD1hivUBEcqOYy3syLjoLvI61KZVD9dspD32Hj5/FwdnQmftw7CVybEAFsqYBzM."){
        $thePasswordIsRight = 1;
    }
    if( $thePasswordIsRight == 1 ){
        $embed = $_POST['embed'];
        $type = $_POST['type'];
        $embed = trim($embed);
        $type = trim($type);
        $type = strtolower($type);
        $type = str_replace(' ', '_', $type);
        $embed = htmlentities($embed, ENT_QUOTES);
        $type = htmlentities($type, ENT_QUOTES);
        $embed = mysqli_real_escape_string($con, $embed);
        $type = mysqli_real_escape_string($con, $type);
        $checkType = mysqli_query($con, "SELECT * from types WHERE type = '$type'");
        if (mysqli_num_rows($checkType) > 0) {
            $existingType = mysqli_fetch_array($checkType);
            $typeId = $existingType['id'];
        }
        else{
            $insert = mysqli_query($con, "INSERT INTO `types` (`id`, `type`) VALUES (NULL, '$type')");
            $findType = mysqli_query($con, "SELECT * from types WHERE type = '$type'");
            $existingType = mysqli_fetch_array($findType);
            $typeId = $existingType['id'];
        }
        $insert = mysqli_query($con, "INSERT INTO `music` (`id`, `type`, `embed`, `date`) VALUES (NULL, '$typeId', '$embed', NULL)");
        echo("<script>alert('Done! Music added to collection.');window.top.location.href = '".Config::get('base')."$type/'; </script>");
    }
    else{
        echo("<script>alert('Sorry, the password was wrong.');</script>");
    }
}

?>
