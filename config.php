<?php   

	class Config
	{
     public static $host = 'localhost'; 
	 public static $user = 'root';         
	 public static $pass = '';					
	 public static $base = 'nomina';
     public static $home = '';
	 public static $home_lib = '';
	 public static $home_bin = '';
	 public static $url = '';
	 public static $ds = '';
	}

 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	
 Config::$ds = DIRECTORY_SEPARATOR;
 Config::$home = dirname(__FILE__);
 Config::$home_lib = Config::$home.Config::$ds.'lib'.Config::$ds;
 Config::$home_bin = Config::$home.Config::$ds.'bin'.Config::$ds;
 Config::$url = $pageURL;
 
?>