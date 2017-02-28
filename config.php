<?php
class Config{
    private static $config = [
        'assetsPath' => 'http://localhost/TheMusicWeShare/musicweshare/assets/',
        'controllersPath' => 'http://localhost/TheMusicWeShare/musicweshare/controllers/',
        'base' => 'http://localhost/TheMusicWeShare/musicweshare/'
    ];
    private static $mysqlConnection = 0;

    public static function get($query){
        return self::$config[$query];
    }
    public static function databaseConnection(){
        if(self::$mysqlConnection === 0){
        	self::$mysqlConnection=mysqli_connect("localhost","root","","musicweshare");
        	if (mysqli_connect_errno()){
        		echo "Failed to connect to MySQL: " . mysqli_connect_error();
        	}
        }
        return self::$mysqlConnection;
    }
}
?>
