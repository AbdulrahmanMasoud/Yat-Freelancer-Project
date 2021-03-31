

  <?php 
session_start();
   include 'init.php'; 
   if(isset($_SESSION['email']) && $_SESSION['type'] == 'freelancer'){
      echo "Welcome Freelancer";
   }else if(isset($_SESSION['email']) && $_SESSION['type'] == 'client'){
      echo "Welcome Client";
   }else{
      header('Location:login.php');
   }

?>

<a href="logout.php">Logout</a>





















<?php include  $tpl . 'footer.php'; ?>