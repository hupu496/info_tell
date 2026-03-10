<?php
$host = 'localhost';
$user = 'root';          // change to your MySQL user
$password = '';          // change to your MySQL password
$dbname = 'student_id_system';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>