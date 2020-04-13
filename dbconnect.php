<?php
// This file should normally be put in a folder with certain security access right
// remember to change the username and password below
$conn = mysqli_connect("localhost", "root", "peos");
if(!$conn) {
    die ("Error connecting to MySQL: " . mysqli_error($conn));
}

// cdcol database may not exists, so we create it first
$query = "CREATE Database if not exists coursework2";
$db_create_success = mysqli_query($conn, $query);

if(!$db_create_success) {
    die ("Error creating database: ".mysqli_error($conn));
}

$db_select_success =  mysqli_select_db($conn, "coursework2");

if(!$db_select_success) {
    die ("Error selecting database: ".mysqli_error($conn));
} else {
	echo "MySQL database: coursework2 selected. <br/>";
}
?>