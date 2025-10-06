<?php
session_start();
include("./config/db.php");

if(!isset($_SESSION['user_id'])){
  echo json_encode(["success" => false, "message" => "Unauthorized"]);
  exit;
}

$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$category_id = $_POST['category_id'];
$amount = $_POST['amount'];
$expense_date = $_POST['expense_date'];
$note = $_POST['note'];
$payment_mode = $_POST['pay_mode'];

$stmt = $con->prepare("UPDATE expenses SET category_id=?, amount=?, expense_date=?, note=?, payment_mode=? WHERE id=? AND user_id=?");
$stmt->bind_param("idsssii", $category_id, $amount, $expense_date, $note, $payment_mode, $id, $user_id);
$executed = $stmt->execute();

if ($executed) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => $stmt->error]);
}

