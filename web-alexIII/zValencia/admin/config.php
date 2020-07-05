<?php
#LOCAL SETUP
/*
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'alex_iii_database');
*/	
	#GO DADDY SETUP
	
	define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'user123');
    define('DB_PASSWORD','@Drianguanla0');
    define('DB_NAME', 'alex_iii_database');
	
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($link === false){
		die("Could not connect to server! ".mysqli_connect_error());
	}
?>