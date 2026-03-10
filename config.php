<?php
$host = "localhost";
$user = "root";      // default for XAMPP
$pass = "";          // default empty
$db   = "student_id_system";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>
