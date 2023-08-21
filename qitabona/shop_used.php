<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   
</div>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products_used`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <input type="submit" value="Rebenifit" name="rebenifit" class="btn">
      <a href="shop_used.php?show=<?php echo $fetch_products['id']; ?>" class="option-btn">show more</a>
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="show-more-products">

   <?php
      if(isset($_GET['show'])){
         $show_id = $_GET['show'];
         $show_query = mysqli_query($conn, "SELECT * FROM `products_used` WHERE id = '$show_id'") or die('query failed');
         if(mysqli_num_rows($show_query) > 0){
            while($fetch_show = mysqli_fetch_assoc($show_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <img class="image" src="uploaded_img/<?php echo $fetch_show['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_show['name']; ?></div>
      <div class="description"><?php echo $fetch_show['description']; ?></div>
      <input type="reset" value="cancel" id="close-show" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".show-more-products").style.display = "none";</script>';
      }
   ?>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>