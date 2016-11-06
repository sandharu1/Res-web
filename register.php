<?php
ob_start();
session_start();
if( isset($_SESSION['user'])!="" ){
  header("Location: addForms.php");
}
include_once 'database.php';
$error = false;

if ( isset($_POST['btn-signup']) ) {

  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
 } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
 } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
 }

  //basic email validation
 if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
 } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
  }
}
  // password validation
if (empty($pass)){
 $error = true;
 $passError = "Please enter password.";
} else if(strlen($pass) < 6) {
 $error = true;
 $passError = "Password must have atleast 6 characters.";
}

  // password encrypt using SHA256();
$password = hash('sha256', $pass);

  // if there's no error, continue to signup
if( !$error ) {

 $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
 $res = mysqli_query($conn, $query);

 if ($res) {
  $errTyp = "success";
  $errMSG = "Successfully registered, you may login now";
  unset($name);
  unset($email);
  unset($pass);
  $name = null;
  $nameError = null;
  $email = null;
  $emailError = null;
  $passError = null;
} else {
  $errTyp = "danger";
  $errMSG = "Something went wrong, try again later..."; 
} 

}

}else{
  $name = null;
  $nameError = null;
  $email = null;
  $emailError = null;
  $passError = null;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Artsy Tartsy - Login & Registration System</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
  <link rel="stylesheet" href="css/custom.css" type="text/css" />
</head>
<!-- NAVBAR
         ================================================== -->
         <body background="img/adminBack2.jpg">
          <div class="navbar-wrapper">
            <div class="container">
              <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="img/logo1.png" class="img-responsive navibar-brand"></a>
                  </div>
                  <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                      <li><marquee behavior="alternate" height="20" width="300" style="color: white;"><strong>Admin Area</strong></strong></marquee></li>
                              <!-- <li><p style="color: white;"><strong>&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;Welcome - <?php echo $userRow['userName']; ?> &nbsp;&nbsp;&nbsp;&nbsp;|</strong></p></li> -->
                      <li><a href="index.html">Home</a></li>
                              <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>

                    </ul>

                  </div>
                </div>
              </nav>

            </div>
          </div>
          <!-- =============End Nav Bar============== -->

  <div class="container" style="margin-top: 80px;">

   <div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

     <div class="col-md-12 well">

       <div class="form-group">
       <h2 class="text-center">Artsy Tartsy: Admin Sign Up.</h2>
       </div>

       <div class="form-group">
         <hr />
       </div>

       <?php
       if ( isset($errMSG) ) {

        ?>
        <div class="form-group">
         <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
          <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
        </div>
      </div>
      <?php
    }
    ?>

    <div class="form-group">
     <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
      <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
    </div>
    <span class="text-danger"><?php echo $nameError; ?></span>
  </div>

  <div class="form-group">
   <div class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
  </div>
  <span class="text-danger"><?php echo $emailError; ?></span>
</div>

<div class="form-group">
 <div class="input-group">
  <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
  <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
</div>
<span class="text-danger"><?php echo $passError; ?></span>
</div>

<div class="form-group">
 <hr />
</div>

<div class="form-group">
 <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
</div>

<div class="form-group">
 <hr />
</div>

<div class="form-group">
 <a href="indexAdmin.php">Sign in Here...</a>
</div>

</div>

</form>
</div> 

</div>
<!-- footer -->
          <footer class="navbar-fixed-bottom">
            <div class="footer-bottom footer">
              <div class="container">
                <p class="pull-left"> Copyright © 2016. Samudhi, Zara, Tharani & Anshika. All right reserved. </p>
                <div class="pull-right">
                  <ul class="nav nav-pills payments">
                    <li><i class="fa fa-cc-visa"></i></li>
                    <li><i class="fa fa-cc-mastercard"></i></li>
                    <li><i class="fa fa-cc-amex"></i></li>
                    <li><i class="fa fa-cc-paypal"></i></li>
                  </ul> 
                </div>
              </div>
            </div>
            <!--/.footer-bottom-->
          </footer>
          <!-- .../footer -->
</body>
</html>
<?php ob_end_flush(); ?>