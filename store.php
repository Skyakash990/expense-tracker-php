<?php
session_start();
include("./config/db.php");

if(!isset($_SESSION['user_id'])){
    header('Location:./login.php');
    exit;
}

$user_id=$_SESSION['user_id'];
$category_id=$_POST['category_id'];
$amount=$_POST['amount'];
$expense_date = $_POST['expense_date'];
$payment_mode = $_POST['pay_mode'];
$note=$_POST['note'];


$stmt=$con->prepare("INSERT INTO expenses (user_id,category_id,amount,expense_date,note,payment_mode) VALUES (?,?,?,?,?,?)");
$stmt->bind_param("iidsss",$user_id,$category_id,$amount,$expense_date,$note,$payment_mode);
if($stmt->execute()){
    header("Location:expense.php");
    exit;
}
else{
    echo "Error ".$con->error;
}
?>