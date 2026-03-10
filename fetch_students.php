<?php
header("Content-Type: application/json");
ini_set('display_errors', 0);
error_reporting(0);

$file = "students.json";

if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$data = file_get_contents($file);
$students = json_decode($data, true);

// If JSON is invalid or not array
if (!is_array($students)) {
    echo json_encode([]);
    exit;
}

echo json_encode($students);
exit;
