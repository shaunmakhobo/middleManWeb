<?php
include 'DbConn.php';
session_start();

// Logged in user (null if guest)
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Handle trailer request
if(isset($_POST['request_trailer'])){

   if(!$user_id){
      $message[] = 'Please login or register to request a trailer.';
   } else {

      $trailer_id  = (int)$_POST['trailer_id'];
      $rental_days = (int)$_POST['rental_days'];

      // Check for existing pending request
      $check = mysqli_query($conn, "
         SELECT id FROM trailer_requests
         WHERE user_id = $user_id
         AND trailer_id = $trailer_id
         AND request_status = 'pending'
      ");

      if(mysqli_num_rows($check) > 0){
         $message[] = 'You already requested this trailer.';
      } else {
         mysqli_query($conn, "
            INSERT INTO trailer_requests (user_id, trailer_id, rental_days)
            VALUES ($user_id, $trailer_id, $rental_days)
         ");
         $message[] = 'Trailer request sent successfully!';
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TrailerHub | Find & Rent Trailers</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/Home.css">
</head>
<body>

<?php include 'header.php'; ?>

<!-- ================= HERO SECTION ================= -->
<section class="home">
   <div class="content">
      <h3>Find the Right Trailer, When You Need It</h3>
      <p>We connect trailer owners with people who need reliable transport solutions.</p>

      <?php if(!$user_id): ?>
         <a href="register.php" class="btn">Get Started</a>
      <?php else: ?>
         <a href="trailers.php" class="btn">Browse Trailers</a>
      <?php endif; ?>
   </div>
</section>

<!-- ================= TRAILERS SECTION ================= -->
<section class="trailers">

   <h1 class="title">Available Trailers</h1>

   <div class="box-container">

   <?php
      $select_trailers = mysqli_query($conn, "
         SELECT * FROM trailers
         WHERE availability = 'available'
         ORDER BY created_at DESC
         LIMIT 6
      ");

      if(mysqli_num_rows($select_trailers) > 0){
         while($trailer = mysqli_fetch_assoc($select_trailers)){
   ?>

   <form action="" method="post" class="box">

      <span class="badge">Available</span>

      <img class="image" src="uploaded_img/<?php echo $trailer['image']; ?>" alt="Trailer">

      <div class="name"><?php echo $trailer['trailer_name']; ?></div>

      <div class="details">
         <span><?php echo $trailer['trailer_type']; ?></span>
         <span><?php echo $trailer['location']; ?></span>
      </div>

      <div class="price">
         R<?php echo $trailer['price_per_day']; ?>
         <span>/ day</span>
      </div>

      <input
         type="number"
         name="rental_days"
         min="1"
         value="1"
         class="qty"
         required
      >

      <input
         type="hidden"
         name="trailer_id"
         value="<?php echo $trailer['id']; ?>"
      >

      <?php if($user_id): ?>
         <input
            type="submit"
            name="request_trailer"
            value="Request Trailer"
            class="btn"
         >
      <?php else: ?>
         <a href="login.php" class="btn" style="background:#ccc;">
            Login to Request
         </a>
      <?php endif; ?>

   </form>

   <?php
         }
      } else {
         echo '<p class="empty">No trailers available right now.</p>';
      }
   ?>

   </div>

   <div class="load-more" style="margin-top:2rem; text-align:center;">
      <a href="trailers.php" class="option-btn">View All Trailers</a>
   </div>

</section>

<!-- ================= HOW IT WORKS ================= -->
<section class="home-contact">
   <div class="content">
      <h3>How TrailerHub Works</h3>
      <p>
         Browse trailers → Send a request → Get approval from the owner →
         Collect and transport safely.
      </p>
      <a href="how-it-works.php" class="white-btn">Learn More</a>
   </div>
</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>