<?php
include "config.php";

$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM students WHERE id=$id");

echo json_encode(["status" => "deleted"]);
?>
