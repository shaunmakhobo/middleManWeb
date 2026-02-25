<footer class="footer">

   <!-- FOOTER TOP -->
   <div class="footer-container">

      <!-- BRAND INFO -->
      <div class="footer-box">
         <h3 class="logo-text">
            Trailer<span>Hub</span>
         </h3>
         <p>
            TrailerHub is a trusted middleman platform connecting
            trailer lenders and customers quickly, safely, and reliably.
         </p>
      </div>

      <!-- QUICK LINKS -->
      <div class="footer-box">
         <h3>Quick Links</h3>
         <a href="home.php">Home</a>
         <a href="trailers.php">Browse Trailers</a>
         <a href="how-it-works.php">How It Works</a>
         <a href="contact.php">Contact</a>
      </div>

      <!-- ACCOUNT LINKS -->
      <div class="footer-box">
         <h3>Account</h3>

         <?php if(isset($_SESSION['user_id'])): ?>
            <a href="my_requests.php">My Requests</a>

            <?php if($_SESSION['user_type'] === 'lender'): ?>
               <a href="lender_dashboard.php">Lender Dashboard</a>
            <?php endif; ?>

            <?php if($_SESSION['user_type'] === 'admin'): ?>
               <a href="admin_dashboard.php">Admin Panel</a>
            <?php endif; ?>

            <a href="logout.php">Logout</a>
         <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
         <?php endif; ?>

      </div>

      <!-- CONTACT INFO -->
      <div class="footer-box">
         <h3>Contact Us</h3>
         <p><i class="fas fa-map-marker-alt"></i> South Africa</p>
         <p><i class="fas fa-envelope"></i> support@trailerhub.co.za</p>
         <p><i class="fas fa-phone"></i> +27 00 000 0000</p>

         <div class="social-links">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
      </div>

   </div>

   <!-- FOOTER BOTTOM -->
   <div class="footer-bottom">
      <p>
         © <?php echo date('Y'); ?> TrailerHub | All Rights Reserved
      </p>
   </div>
<link rel="stylesheet" href="css/footer.css">
</footer>