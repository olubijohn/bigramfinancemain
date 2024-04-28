<?php
$host = "localhost:3307";
$username = "root";
$password = "";
$dbname = "vixtacap_db";

$conn = mysqli_connect($host,$username,$password,$dbname);

if (!$conn) {
    die("Connection Prolem:".mysqli_connect_error());
}