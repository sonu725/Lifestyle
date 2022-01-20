<?php
    session_start();
    $con=mysqli_connect("localhost","root","","admin");
    if(!$con)
    die("server could not be connected");
    $id=$_REQUEST["id"];
    $sel="select * from product_detail where Product_Id='".$id."'";
    $rq=mysqli_query($con,$sel);

?>
<?php

  // for user detail
  $con=mysqli_connect("localhost","root","","user_detail");
  if(!$con)
  die("server could not be connected");
  if(isset($_SESSION["Email"])){
    $temp=$_SESSION["Email"];
  $user_detail="select *from signup_detail where Email='".$temp."'";
  $res=mysqli_query($con,$user_detail);
  while($value=mysqli_fetch_assoc($res)){
    $uname=$value["Name"];
    $address=$value["Address"];
    $pin=$value["Pincode"];
  }
}
?>
<?php
   $con=mysqli_connect("localhost","root","","user_detail");
   if(!$con)
   die("server could not be connected");
   if(isset($_POST["buy_now"])){
    //  $email=$_POST["email"];
    //  $name=$_POST["name"];
    //  $price=$_POST["price"];
    //  $address=$_POST["add"];
    //  $pin=$_POST["Pin"];
     $contact=$_POST["contact"];
    //  echo $name;
     $in="insert into product_bought_detail values('".$temp."','".$uname."','".$price."','".$address."','".$pin."','".$contact."')";
     $sql=mysqli_query($con,$in);

     if($sql!=0){
       header("location:success.php");
     }else{
       header("location:Product_bill.php");
     }
   }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Product_Bill</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v2.2.1
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<header id="header" class="fixed-top ">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="index.php"><span>Life Style</span></a></h1>
         <!-- Uncomment below if you prefer to use an image logo -->
         <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> -->
       </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
          <li><a href="index.php">Home</a></li>
         <?php
           if(isset($_SESSION["Email"])){
             echo '<li><a href="user_logout.php">Logout</a></li> ';
           }
          ?>
          <li><a href="contact.php">Contact Us</a></li>
      </nav><!-- .nav-menu -->

    </div>
   </header><!--End Header -->
   
   <!-- ======= Header ======= -->
  

  <main id="main">

    <!-- ======= Our Services Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Product Bill</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Bill</li>
          </ol>
        </div>

      </div>
    </section><!-- End Our Services Section -->

    <!-- ======= Service Details Section ======= -->
    <section class="service-details">
      <div class="container">

        <div class="row">
          <div class="col">
            <?php 
            
            while($data=mysqli_fetch_assoc($rq)){
               // $id=$data["Product_Id"];
                $img="admin-Pannel/Product_Image/".$data["Product_Img"];
                $price=$data["Product_Price"];
                $disc=$data["Product_discr"];
                $name=$data["Product_Name"];
           echo'
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card">
              <div class="card-img">
                <img src="'.$img.'" alt="Image">
              </div>
              <div class="card-body mt-3">
              <h5 class="card-title">'.$name.'</h5>
               <p class="card-text">'.$disc.'</p>
                <h5 class="card-title">&#8377;'.$price.'</h5>
              </div>
            </div>
          </div>';
            }
         ?>
         </div>

        <div class="col">
          <article class="entry"  data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="1000">
<div class="entry-content">
<form action="<?php $_PHP_SELF ?>"method="post">
   <div class="form-group">
     <label for="exampleInputEmail1">Email address</label>
     <input type="email" class="form-control" aria-describedby="emailHelp" name="email" placeholder="Enter email" <?php if(isset($_SESSION["Email"]))echo "disabled";?> value="<?php if(isset($_SESSION["Email"]))echo $_SESSION["Email"];?>">
     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Name</label>
     <input type="text" class="form-control" name="name" placeholder="Enter Full Name" value="<?php if(isset($_SESSION["Email"]))echo $uname;?>" required <?php if(isset($_SESSION["Email"]))echo "disabled";?> >
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Price</label>
     <input type="text" class="form-control" name="price" value="<?php if(isset($_SESSION["Email"]))echo $price; ?>"placeholder="Price" required <?php if(isset($_SESSION["Email"]))echo "disabled";?> >
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Address</label>
     <input type="text" class="form-control" name="add" placeholder="Enter Address" value="<?php  if(isset($_SESSION["Email"]))echo $address;?>" required <?php if(isset($_SESSION["Email"]))echo "disabled";?>>
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Pincode</label>
     <input type="text" class="form-control" name="pin" placeholder="Enter Pincode" value="<?php if(isset($_SESSION["Email"])) echo $pin;?>"<?php if(isset($_SESSION["Email"]))echo "disabled";?> required>
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Contact-number</label>
     <input type="text" class="form-control" name="contact" placeholder="Enter Contact Number " required>
   </div>
     <input type="submit" class="btn btn-primary" name="buy_now" value="BUY NOW">
  </form>
</div>

 </article><!-- End form -->
          </div>
        </div>

      </div>
    </section><!-- End Service Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500" class="mt-4">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About Life style</h3>
            <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Life style</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

 </body>
</html>
