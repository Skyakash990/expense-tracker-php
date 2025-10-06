<?php
session_start();
include("./config/db.php");
if (!isset($_SESSION['user_id'])) {
    header('Location:./login.php');
    exit;
}
include("./includes/header.php");

$user_id = $_SESSION['user_id'];
$sql = "SELECT expenses.*, categories.name 
        FROM expenses
        JOIN categories ON expenses.category_id = categories.id
        WHERE expenses.user_id = ?
        ORDER BY expenses.expense_date DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!-- <h1>Welcome to expense tracker</h1> -->
<div class="d-flex justify-content-between mb-3">
    <h2>Your Expenses</h2>
    <a href="create.php" class="btn btn-success">+ Add Expense</a>
</div>
<table class="table table-bordered user-select-none table-striped">
    <thead class="table-dark">
        <tr>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Note</th>
            <th>Payment Mode</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="expenseTable">
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="row-<?= $row['id'] ?>">
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td>&#8377;<?= $row['amount'] ?></td>
                <td><?= date("d-m-Y", strtotime($row['expense_date'])) ?></td>
                <td><?= htmlspecialchars($row['note']) ?></td>
                <td><?= htmlspecialchars( $row['payment_mode']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $row['id'] ?>">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">Delete</button>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- 📝 Edit Expense Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editModalLabel">Edit Expense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post">
                    <input type="hidden" id="editId" name="id">

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" id="editCategory" name="category_id" required>
                            <?php
                            $cats = $con->query("SELECT * FROM categories ORDER BY name ASC");
                            while ($cat = $cats->fetch_assoc()): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" step="0.01" id="editAmount" name="amount" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="text" id="expense_date" name="expense_date" class="form-control expense-date" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea id="editNote" name="note" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Mode</label>
                        <input type="radio" id="pay_mode_cash" name="pay_mode" value="cash" class="" required>
                        <label for="pay_mode_cash">Cash</label>
                        <input type="radio" id="pay_mode_online" name="pay_mode" value="online" class="" required>
                        <label for="pay_mode_online">Online</label>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Update Expense</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>