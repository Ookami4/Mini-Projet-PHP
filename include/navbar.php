<nav class="navbar">
  <ul>
   <img src="logo/1Red (1).png">
   <div style="float: right;">
   <li><a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a></li>
   <li>
      <a href="#"><i class="fas fa-chevron-circle-down"></i> Categories</a><br>
      <ul>
        <?php
        $res = mysqli_query($connection, "SELECT * FROM `categories`");
        if(!$res){
          echo("Error description: " . mysqli_error($connection));
        }
        while($ligne = mysqli_fetch_array($res)) {  ?>
        <li style="display: block;float: left;text-align: center;height: 55px;background-color: #ff0000; width: 130px;">
          <a href="categories.php?idcat=<?php echo $ligne['cat_id']; ?>"><?php echo $ligne['cat_name'];?></a>
        </li><br>
       <?php } ?>
      </ul>
   </li>
   <li>
     <?php
       if(isset($_SESSION['logged1']) && $_SESSION['logged1'] == true):
     ?>
     <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
     <?php 
        else:
     ?>
     <a href="admin.php"><i class="fas fa-user-tie"></i> Admin</a> 
     <?php 
       endif;
      ?>
   </li>
   <li>
     <a href="#"><i class="fas fa-user"></i> Buyer</a>
     <br>
     <?php
       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true):
     ?>
     <ul>
       <li><a href="logout.php" style="background-color: #ff0000; width: 130px;"><i class="fas fa-sign-out-alt"></i>Log Out</a></li>
     </ul>
     <?php 
        else:
     ?>
     <ul>
       <li style="background-color: #ff0000; width: 110px;"><a href="login.php" ><i class="fas fa-sign-in-alt"></i>  Sign In</a></li><br>
       <li style="background-color: #ff0000; width: 110px;"><a href="signup.php" ><i class="fas fa-user-plus"></i> Sign up</a></li>
     </ul>
     <?php 
        endif;
      ?>
  </li>
    <?php
      if(isset($_COOKIE["cart"]))
      {
        $total = 0;
        $cookie_data = stripslashes($_COOKIE['cart']);
        $cart_data = json_decode($cookie_data, true);
        $count = count($cart_data);
      }else{
        $count = 0;
      }
    ?>
  <li><a href="cart.php"><i class="fas fa-shopping-cart"></i><?php echo $count;?></a></li>
    </ul>
</nav>