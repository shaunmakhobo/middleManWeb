<?php
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <!-- TOP BAR -->
   <div class="header-1">
      <div class="flex">

         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>

         <?php if(isset($_SESSION['user_id'])): ?>
            <p>
               Welcome, 
               <strong><?php echo $_SESSION['user_name']; ?></strong> |
               <a href="logout.php">Logout</a>
            </p>
         <?php else: ?>
            <p>
               <a href="login.php">Login</a> |
               <a href="register.php">Register</a> |
               <a href="guest_home.php">Continue as Guest</a>
            </p>
         <?php endif; ?>

      </div>
   </div>

   <!-- MAIN HEADER -->
   <div class="header-2">
      <div class="flex">

         <!-- LOGO -->
         <div class="logo">
            <img src="images/trailerhub-logo.png" alt="Trailer Hub" style="height:90px;">
         </div>

         <a href="home.php" class="logo-text">
            Trailer<span>Hub</span>
         </a>

         <!-- NAVIGATION -->
         <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="trailers.php">Trailers</a>
            <a href="how-it-works.php">How It Works</a>
            <a href="contact.php">Contact</a>

            <?php if(isset($_SESSION['user_id'])): ?>

               <?php if($_SESSION['user_type'] === 'lender'): ?>
                  <a href="lender_dashboard.php">Lender Dashboard</a>
               <?php endif; ?>

               <?php if($_SESSION['user_type'] === 'customer'): ?>
                  <a href="my_requests.php">My Requests</a>
               <?php endif; ?>

               <?php if($_SESSION['user_type'] === 'admin'): ?>
                  <a href="admin_dashboard.php">Admin</a>
               <?php endif; ?>

            <?php endif; ?>
         </nav>

         <!-- ICONS -->
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_trailers.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>

            <?php
               if(isset($_SESSION['user_id'])){
                  $user_id = $_SESSION['user_id'];
                  $request_query = mysqli_query(
                     $conn,
                     "SELECT * FROM trailer_requests WHERE user_id = '$user_id'"
                  ) or die('query failed');

                  $request_count = mysqli_num_rows($request_query);
               } else {
                  $request_count = 0;
               }
            ?>

            <a href="<?php echo isset($_SESSION['user_id']) ? 'my_requests.php' : 'login.php'; ?>">
               <i class="fas fa-clipboard-list"></i>
               <span>(<?php echo $request_count; ?>)</span>
            </a>
         </div>

         <!-- USER DROPDOWN -->
         <?php if(isset($_SESSION['user_id'])): ?>
         <div class="user-box">
            <p>Name : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <p>Role : <span><?php echo ucfirst($_SESSION['user_type']); ?></span></p>
            <a href="logout.php" class="delete-btn">Logout</a>
         </div>
         <?php endif; ?>

      </div>
   </div>
<!-- Custom CSS -->
   <link rel="stylesheet" href="css/header.css">
</header>