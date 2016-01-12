<?php
class Config{
    private static $config = [
        'assetsPath' => 'http://localhost/TheMusicWeShare/assets/',
        'controllersPath' => 'http://localhost/TheMusicWeShare/controllers/',
        'base' => 'http://localhost/TheMusicWeShare/'
    ];
    private static $mysqlConnection = 0;

    public static function get($query){
        return self::$config[$query];
    }
    public static function databaseConnection(){
        if(self::$mysqlConnection === 0){
        	self::$mysqlConnection=mysqli_connect("localhost","root","","themusicweshare");
        	if (mysqli_connect_errno()){
        		echo "Failed to connect to MySQL: " . mysqli_connect_error();
        	}
        }
        return self::$mysqlConnection;
    }
}
?>
