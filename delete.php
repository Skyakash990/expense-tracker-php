<?php
session_start();
include("./config/db.php");

if(!isset($_SESSION['user_id'])){
  echo json_encode(["success" => false, "message" => "Unauthorized"]);
  exit;
}

$user_id = $_SESSION['user_id'];
$id = $_POST['id'] ?? null;
if (!$id) {
    echo json_encode(["success" => false, "message" => "ID not provided"]);
    exit;
}
$stmt = $con->prepare("DELETE FROM expenses WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$success = $stmt->execute();

if ($success) {
  echo json_encode(["success" => true]);
} else {
  echo json_encode(["success" => false, "message" => $stmt->error]);
}

?>
