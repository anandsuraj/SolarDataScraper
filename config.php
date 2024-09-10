<?php
$servername = "localhost";
$username   = "abb_root";
$password   = "@*47jiosnuni2nwiusi";
$dbname     = "inverter_db";

// Create a secure connection to the database using MySQLi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection and handle errors securely
if (!$conn) {
    error_log("Connection failed: " . mysqli_connect_error()); 
    die("An error occurred while connecting to the database. Please try again later."); 
}
?>
