<?php
session_start();
include("./config/db.php");

if(!isset($_SESSION['user_id'])){
  echo json_encode(["success" => false]);
  exit;
}

$id = $_POST['id'];
$user_id = $_SESSION['user_id'];

$stmt = $con->prepare("SELECT id, category_id, amount, expense_date, note, payment_mode FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  echo json_encode(["success" => true, "data" => $row]);
} else {
  echo json_encode(["success" => false]);
}
