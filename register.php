<?php
include("./config/db.php");
include("./includes/header.php");
if($_SERVER["REQUEST_METHOD"]==='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT);

    $stmt=$con->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param("sss",$name,$email,$password);

    if($stmt->execute()){
        $_SESSION['user_id']=$con->insert_id;
        header("Location:index.php");
        exit;
    }else{
        $error="Registration failed:" . $con->error;
    }
}
?>

<div class="card p-4 shadow">
    <h2 class="mb-3">Register</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
</div>

<?php include("./includes/footer.php"); ?>