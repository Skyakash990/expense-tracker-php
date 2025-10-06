<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Expense Tracker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <style>
    .hero {
      background-color: #f8f9fa;
      padding: 80px 20px;
      text-align: center;
    }

    .features .col-md-6 {
      margin-bottom: 30px;
    }

    .cta {
      background-color: #0d6efd;
      color: white;
      padding: 60px 20px;
      text-align: center;
    }

    .cta a.btn {
      background-color: #ffc107;
      border: none;
    }

    .testimonial {
      background-color: #e9ecef;
      padding: 30px;
      margin-bottom: 20px;
      border-left: 5px solid #0d6efd;
    }

    footer {
      padding: 20px 0;
      background: #343a40;
      color: white;
      text-align: center;
    }

    footer a {
      color: #ffc107;
      margin: 0 10px;
      text-decoration: none;
    }

    .space {
      padding-top: 30px;
    }

    .pad {
      margin-top: 163px;
    }

    body {
      overflow: auto;
      scrollbar-width: none;
      /* Firefox */
      -ms-overflow-style: none;
      /* Internet Explorer 10+ */
    }

    body::-webkit-scrollbar {
      display: none;
      /* Chrome, Safari, Opera */
    }
  </style>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-secondary mb-4">
    <div class="container">
      <a class="navbar-brand" href="./index.php">Expense Tracker</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="nav-item"><a class="nav-link" href="./expense.php">Expenses</a></li>
            <li class="nav-item"><a class="nav-link" href="./logout.php">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="./login.php">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="./register.php">Register</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container space mt-5 mb-5">