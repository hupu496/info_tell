<?php
session_start();
require_once 'db_config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: quotation_form.php');
    exit;
}

// Retrieve inputs (no added_on, no status)
$company_name = trim($_POST['company_name'] ?? '');
$buyer = trim($_POST['buyer'] ?? '');
$project_name = trim($_POST['project_name'] ?? '');
$due_date = $_POST['due_date'] ?? '';          // keep only due date
$description = trim($_POST['description'] ?? '');


// Process items
$products = $_POST['product'] ?? [];
$quantities = $_POST['quantity'] ?? [];
$rates = $_POST['rate'] ?? [];


$items_array = [];
$calculated_total = 0;
for ($i = 0; $i < count($products); $i++) {
    if (empty(trim($products[$i]))) continue;
  
    $qty = floatval($quantities[$i] ?? 0);
    $rate = floatval($rates[$i] ?? 0);
    $items_array[] = [
        'itemname' => trim($products[$i]),
        'quantity' => $qty,
        'unit_price' => $rate,
        // optionally add 'unit' here if needed
    ];
    $calculated_total += $qty * $rate;
}

if (empty($items_array)) {
    die('At least one item is required. <a href="quotation_form.php">Go back</a>');
}

$items_json = json_encode($items_array);

// Handle totalprice
$totalprice = null;
$totalprice = $calculated_total; 

// Insert into database – removed added_on and status columns
$sql = "INSERT INTO reciept 
(project_name, quotation_for, buyer, due_date, description, items, totalprice)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param(
    "sssssss",
    $project_name,
    $company_name,
    $buyer,
    $due_date,
    $description,
    $items_json,
    $totalprice
);

if ($stmt->execute()) {
    $_SESSION['last_receipt_id'] = $stmt->insert_id;
    header("Location: quotation_list.php");
    exit;
} else {
    die("Database error: " . $stmt->error);
}
?>