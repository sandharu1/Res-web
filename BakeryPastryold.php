<?php 
include 'database.php'; 
// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    var_dump($cookies);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-3600);
        setcookie($name, '', time()-3600, '/');
    }
}

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_COOKIE['KHcl0EuY7AKSMgfvHl7J5E7hPtK'];
setcookie("KHcl0EuY7AKSMgfvHl7J5E7hPtK", "", 0, '/', "paypal.com");
// prints e.g. 'Current PHP version: 4.1.1'
echo 'Current PHP version: ' . phpversion();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <?php include 'database.php'; ?>
        <title>Artsy Tartsy</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Custom styles for this template -->
        <!-- <link href="css/carousel.css" rel="stylesheet"> -->
        <link rel="stylesheet" id="coToolbarStyle" href="chrome-extension://cjabmdjcfcfdmffimndhafhblfmpjdpe/toolbar/styles/placeholder.css" type="text/css">

    </head>


        <!-- NAVBAR
        ================================================== -->
    <body>
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
              <a class="navbar-brand" href="index.html">Artsy Tartsy</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="index.html">Home</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-submenu">
                    <a href="#" tabindex="-1">Outlets </a>

                    <ul class="dropdown-menu">
                    <li><a href="TibirigassyayaOutlets.html">Thimbirigasyaya</a></li>
                    <li><a href="NawalaOutlets.html">Nawala</a></li>
                    <li><a href="BattaramullaOutlets.html">Diyatha Uyana</a></li>
                    <li><a href="ArchadeIndependentSquarOutlet.html">Arcade Ind. Square</a></li>
                    
                    </ul>

                    </li>

                    <li role="separator" class="divider"></li>
                
                    <li><a href="#">Hotel Equipment</a></li>
                    
                  </ul>
                </li>
                <li class="active" class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="HealthProducts.php">Health Products</a></li>
                    <li class="active"><a href="BakeryPastry.php">Bakery & Pastry</a></li>
                    <li><a href="CakesGateau.php">Cakes & Gateau</a></li>
                    <li><a href="ChocolatesDesserts.php">Chocolates & Desserts</a></li>
                    <li><a href="Beverages.php">Beverages</a></li>
                    <li><a href="Cuisine.php">Cuisine</a></li>
                    <li><a href="RealeGelato.php">Reale Gelato</a></li>
                  </ul>
                </li>
                <li><a href="OutdoorCatering.html">Outdoor Catering</a></li>
                <li><a href="Careers.html">Careers</a></li>
                <li><a href="WhatsNew.html">Whats New</a></li>
                <li><a href="ContactUs.html">Contact Us</a></li>
              </ul>

            </div>
          </div>
        </nav>

      </div>
    </div>

<!-- =============End Nav Bar============== -->
        <!-- page body content -->
        <div class="container style-row">
        <h2 class="text-center text-warning"><Strong><u>Bakery & Pastry</u></Strong></h2>
        <br>
            <div class="row ">
        <?php
        $results = $conn->query("SELECT * FROM products WHERE item_type='BakeryPastry'");
        if (is_null($row = $results->fetch_assoc())) {
            echo "<p style='color:red;'>*Products is not available right now. Please try again later.</p>";
        }
        while($row = $results->fetch_assoc())
        {
        ?>
                <div class = "col-sm-6 col-md-3">
                    <div class = "thumbnail">
                        <img src = "img/<?php echo $row['item_image']; ?>" alt = "Generic placeholder thumbnail">
                    </div>

                    <div class = "caption">
                        <h3><?php echo $row['itemName']; ?></h3>
                        <p>Price: <?php echo $row['item_cost']; ?> USD </p>

                        <p>
                        <form method="post" action="https://www.paypal.com/cgi-bin/webscr" target="_blank">
                            <input type="hidden" name="cmd" value="_cart">
                            <input type="hidden" name="add" value="1">
                            <input type="hidden" name="business" value="payments@qoulitest.com">
                            <input type="hidden" name="item_name" value="<?php echo $row['itemName']; ?>">
                            <input type="hidden" name="item_number" value="<?php echo $row['item_id']; ?>">
                            <input type="hidden" name="amount" value="<?php echo $row['item_cost']; ?>">
                            <input type="hidden" name="shipping" value="<?php echo $row['item_shipping']; ?>">
                            <input type="hidden" name="shipping2" value="0.00">
                            <input type="hidden" name="handling" value="0.00 ">
                            <input type="hidden" name="currency_code" value="USD">
                            <input type="hidden" name="return" value="http://www.qoulitest.com/thankyou.htm">
                            <input type="hidden" name="undefined_quantity" value="1">
                            <input type="hidden" name="lc" value="LK">
                            <input type="image" src="http://www.paypalobjects.com/en_US/i/btn/x-click-but22.gif" border="0" name="submit" width="87" height="23" alt="Make payments with PayPal - it's fast, free and secure!">
                        </form>
                        </p>

                    </div>
                </div>
<?php
}
?>
            </div> <!-- end row 1 -->
<hr>
            <!-- =======Items row 2 ======= -->
            <div class="row">
                

            </div> <!-- end row 2 -->
        </div> <!-- end container -->
        <!-- End body content -->

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


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
        <!-- <script src="js/holder.min.js"></script> -->
        
    </body>
</html>