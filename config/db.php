<?php
$con=new mysqli("localhost","root","","expense_tracker");

if($con->connect_error){
    die("Connection Failed:" . $con->connect_error);
}
?>