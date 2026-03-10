<?php
header("Content-Type: application/json");

// Disable error display (production safe)
ini_set('display_errors', 0);
error_reporting(0);

/* ===============================
   BASIC VALIDATION
================================ */

if (
    empty($_POST['roll']) ||
    empty($_POST['name']) ||
    empty($_POST['class']) ||
    empty($_POST['section'])
) {
    echo json_encode([
        "status" => "error",
        "message" => "Required fields missing"
    ]);
    exit;
}
// Auto-generate Student ID
$studentId = "STU" . time();


/* ===============================
   CLEAN INPUT DATA
================================ */

$student = [
    "id" => $studentId,                  // ✅ AUTO ID
    "roll" => trim($_POST["roll"]),
    "name" => trim($_POST["name"]),
    "class" => trim($_POST["class"]),
    "section" => trim($_POST["section"]),
    "father" => trim($_POST["father"] ?? ""),
    "dob" => trim($_POST["dob"] ?? ""),
    "bloodgroup" => trim($_POST["bloodgroup"] ?? ""),
    "phone" => trim($_POST["phone"] ?? ""),
    "photo" => ""
];

/* ===============================
   PHOTO HANDLING (BASE64)
================================ */

if (!empty($_POST["photo"])) {

    $photoData = $_POST["photo"];

    // Remove base64 header
    if (strpos($photoData, "base64,") !== false) {
        $photoData = explode("base64,", $photoData)[1];
    }

    $photoData = base64_decode($photoData);

    if ($photoData !== false) {

        if (!is_dir("uploads/photos")) {
            mkdir("uploads/photos", 0755, true);
        }

        $photoName = "uploads/photos/" . uniqid("stu_") . ".png";
        file_put_contents($photoName, $photoData);

        $student["photo"] = $photoName;
    }
}

/* ===============================
   SAVE TO JSON FILE
================================ */

$file = "students.json";
$students = [];

// Read existing data
if (file_exists($file)) {
    $existingData = json_decode(file_get_contents($file), true);
    if (is_array($existingData)) {
        $students = $existingData;
    }
}

// Prevent duplicate student ID
foreach ($students as $s) {
    if ($s["id"] === $student["id"]) {
        echo json_encode([
            "status" => "error",
            "message" => "Student ID already exists"
        ]);
        exit;
    }
}

// Append new student
$students[] = $student;

// Save back as ARRAY
file_put_contents(
    $file,
    json_encode($students, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
);

/* ===============================
   SUCCESS RESPONSE
================================ */

echo json_encode([
    "status" => "success"
]);
?>
exit;
