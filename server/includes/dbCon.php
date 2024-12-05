<?php
$host = "localhost:3306";
$dbname = "amiellapid06_tiago";
$user = "amiellapid06_tiago";
$pass = "kCe4*a201";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset('utf8mb4');

if ($conn->connect_errno) {
    die("Connection Error: " . $conn->connect_errno);
}