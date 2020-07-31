<?php
    // User's server, username, and password are set here.
   define('T_DB_SERVER', "localhost");
   define('T_DB_USERNAME', "myxanders");
   define('T_DB_PASSWORD', "Dustl@ndF@iryt@le5");
   define('T_DB_DATABASE', 'trivia');
   
   $conn = mysqli_connect(T_DB_SERVER,T_DB_USERNAME,T_DB_PASSWORD,T_DB_DATABASE);
   
   if($conn === false){
    //die("ERROR: Could not connect. " . mysqli_connect_error
	header("location:import.php");
}
?>