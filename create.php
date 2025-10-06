<?php
session_start();
include("./config/db.php");
include("./includes/header.php");

if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
    exit;
}

$catResult = $con->query("SELECT * FROM categories ORDER BY name ASC");
?>

<h2>Add New Expense</h2>
<form action="store.php" method="post">
    <div class="mb-3">
        <h4 for="" class="mb-2">Category</h4>
        <select required name="category_id" id="" class="form-control">
            <option value="">Select Category</option>
            <?php while($cat = $catResult->fetch_assoc()):?>
                <option value="<?= $cat['id']?>"><?=htmlspecialchars($cat['name'])?></option>
            <?php endwhile;?>
        </select>
    </div>
     <div class="mb-3">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="expense_date">Date</label>
        <input type="date" id="expense_date" name="expense_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="pay_mode">Payment Mode</label><br>
        <input type="radio" id="pay_mode_cash" name="pay_mode" value="cash" class="" required>
        <label for="pay_mode_cash">Cash</label>
        <input type="radio" id="pay_mode_online" name="pay_mode" value="online" class="" required>
        <label for="pay_mode_online">Online</label>
    </div>

    <div class="mb-3">
        <label>Note</label>
        <textarea name="note" rows="2" class="form-control"></textarea>
    </div>

    <button type="submit" name="" class="btn btn-success">Add Expense</button>
</form>

<?php include("./includes/footer.php");?>