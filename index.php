<?php
session_start();
include("./includes/header.php");
?>
 <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1 class="display-4">Track Your Expenses. Control Your Finances.</h1>
      <p class="lead">A smart, simple, and secure way to manage your daily spending.</p>
      <a href="expense.php" class="btn btn-primary btn-lg mt-3">Start Tracking Now</a>
    </div>
  </section>

  <!-- Features Section -->
  
   <?php if (isset($_SESSION['user_id'])): ?>
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Why Choose Our Expense Tracker?</h2>
      <div class="row features">
        <div class="col-md-6">
          <h4>💸 Easy Expense Logging</h4>
          <p>Quickly add and manage expenses by category, amount, and payment mode.</p>
        </div>
        <div class="col-md-6">
          <h4>📊 Real-Time Reports</h4>
          <p>Get visual insights into your spending with simple and smart charts.</p>
        </div>
        <div class="col-md-6">
          <h4>🔐 Private & Secure</h4>
          <p>Your financial data is encrypted and securely stored — your privacy matters.</p>
        </div>
        <div class="col-md-6">
          <h4>📱 Works on Any Device</h4>
          <p>Track your expenses anytime, from mobile, tablet, or desktop.</p>
        </div>
      </div>
    </div>
  </section>
<?php else: ?>
  <!-- CTA Section -->
  <section class="cta" id="get-started">
    <div class="container">
      <h2 class="mb-4">Start Managing Your Money Better</h2>
      <p class="mb-4">Create your free account now and take control of your daily expenses.</p>
      <a href="./register.php" class="btn btn-lg">Create an Account</a>
    </div>
  </section>
<?php endif; ?>
  <!-- Testimonials Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">What Our Users Say</h2>
      <div class="testimonial">
        <p>“This app helped me finally understand where my money goes. It's easy and powerful.”</p>
        <strong>- Priya R.</strong>
      </div>
      <div class="testimonial">
        <p>“I used to hate tracking expenses. This tool changed everything. 10/10!”</p>
        <strong>- Ankit M.</strong>
      </div>
    </div>
  </section>


<?php include("./includes/footer.php")?>