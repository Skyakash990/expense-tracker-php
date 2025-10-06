</div> <!-- container -->
<footer class="contaier pad">
  <p>&copy; 2025 Expense Tracker. All rights reserved.</p>
  <nav>
    <a href="/about">About</a> |
    <a href="/privacy">Privacy Policy</a> |
    <a href="/contact">Contact</a>
  </nav>
</footer>

<!-- <script src="./jquery-3.6.1.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- <input type="text" id="expense_date" name="expense_date" class="form-control" required> -->
<script>
  $(document).ready(function() {
    console.log("jQuery is working!");
    // DELETE
    $(document).on('click', '.delete-btn', function() {
      if (!confirm('Are you sure you want to delete this expense?')) return;
      let id = $(this).data('id');


      $.ajax({
        url: 'delete.php',
        type: 'POST',
        data: {
          id
        },
        success: function(response) {
          try {
            let res = JSON.parse(response);
            if (res.success) {
              $('#row-' + id).fadeOut(400, function() {
                $(this).remove();
              });
            } else {
              alert('Delete failed: ' + res.message);
            }
          } catch (e) {
            alert('Invalid server response');
          }
        }
      });
    });
    // Edit data in modal

    $('.edit-btn').on('click', function() {
      const id = $(this).data('id');


      $.ajax({
        url: 'get_expense.php',
        type: 'POST',
        dataType: 'json',
        data: {
          id
        },
        success: function(res) {
          if (res.success) {
            $('#editId').val(res.data.id);
            $('#editAmount').val(res.data.amount);
            $('#expense_date').val(res.data.expense_date);
            $('#editNote').val(res.data.note);
            $('input[name="pay_mode"][value="' + res.data.payment_mode + '"]').prop('checked', true);
            $('#editCategory').val(res.data.category_id);

            // 👇 THIS opens the modal
            $('#editModal').modal('show');
          } else {
            alert('Could not fetch expense details.');
          }
        }
      });
    });

    //Update Expense
    $('#editForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "update.php",
        data: $(this).serialize(),
        dataType: "json",
        success: function(res) {
          // console.log('Response:', res);

          let payMode = $('input[name="pay_mode"]:checked').val().toLowerCase();
          // Format date to dd-mm-yyyy
          function formatDateDMY(dateStr) {
            const date = new Date(dateStr);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
          }

          // Inside your AJAX success function:
          const formattedDate = formatDateDMY($('#expense_date').val());
          
          if (res.success) {
            const id = $('#editId').val();
            const row = $('#row-' + id);
            row.find('td:eq(0)').text($('#editCategory option:selected').text());
            row.find('td:eq(1)').html('₹' + $('#editAmount').val());
            row.find('td:eq(2)').text(formattedDate);
            // row.find('td:eq(2)').text($('#expense_date').val());
            row.find('td:eq(3)').text($('#editNote').val());
            row.find('td:eq(4)').text(payMode);

            $('#editModal').modal('hide');
            // $('.modal-backdrop').remove();

          } else {
            alert('Update Failed' + res.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error:', status, error);
          alert('An error occurred while updating. Please try again.');
        }
      });
    });


    // Flatpickr
    flatpickr("#expense_date", {
      allowInput: false,
      dateFormat: "Y-m-d",
      defaultDate: null,
      maxDate: "today",
    });

  });
</script>
</body>

</html>