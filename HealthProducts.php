<?php 
session_start();
include 'database.php'; 
include_once("config.php");

//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$_SESSION['previous_location'] = $actual_link;
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
                    <a class="navbar-brand" href="index.html"><img src="img/logo1.png" class="img-responsive navibar-brand"></a>
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
                <li class="active dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="active"><a href="HealthProducts.php">Health Products</a></li>
                    <li><a href="BakeryPastry.php">Bakery & Pastry</a></li>
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
    <h2 class="text-center text-warning"><Strong><u>Health Products</u></Strong></h2>
    <br>
    <br>
    <!-- =======pop out cart======= -->
    <!-- View Cart Box Start -->
    <?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
    echo '<div class="cart-view-table-front" id="view-cart">';
    echo '<h4 class="text-center"><strong>Your Shopping Cart</strong></h4>';
    echo '<form method="post" action="cart_update.php">';
    echo '<table width="100%"  cellpadding="6" cellspacing="0">';
    echo '<tbody>';

    $total =0;
    $b = 0;
    foreach ($_SESSION["cart_products"] as $cart_itm)
    {
        $product_name = $cart_itm["product_name"];
        $product_qty = $cart_itm["product_qty"];
        $product_price = $cart_itm["product_price"];
        $product_code = $cart_itm["product_code"];
        // $product_color = $cart_itm["product_color"];
        $bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
        echo '<tr class="'.$bg_color.'">';
        echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
        echo '<td>'.$product_name.'</td>';
        echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
        echo '</tr>';
        $subtotal = ($product_price * $product_qty);
        $total = ($total + $subtotal);
    }
    echo '<td colspan="4">';
    echo '<a href="view_cart.php" class="button btn btn-info">Checkout</a><a href="functions.php?delcart&url='.$actual_link.'" class="button btn btn-danger">Clear</a><button type="submit" class="button btn btn-success" >Update</button>';
    echo '</td>';
    echo '</tbody>';
    echo '</table>';
    
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
    echo '</form>';
    echo '</div>';

}
?>
<!-- View Cart Box End -->
<!-- ==============end pop out cart========== -->
<div class="row">
    <?php
    $results = $conn->query("SELECT * FROM products WHERE item_type='HealthProducts'");
    if (is_null($row = $results->fetch_assoc())) {
        echo "<p style='color:red;'>*Products is not available right now. Please try again later.</p>";
    }
    while($row = $results->fetch_assoc())
    {
        ?>
        <div class = "col-sm-3 col-md-3 well" style="margin-left:10px; width: 280px;">
                <form method="post" action="cart_update.php">
                    <div class = "thumbnail">
                        <img src = "img/<?php echo $row['item_image']; ?>" alt = "Generic placeholder thumbnail">
                    </div>

                    <div class = "caption">
                        <h3><?php echo $row['itemName']; ?></h3>
                        <p>Price: <?php echo $row['item_cost']; ?> USD </p>
                        <fieldset>

                            <label>
                                <span>Quantity</span>
                                <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
                            </label>

                        </fieldset>
                            <input type="hidden" name="product_code" value="<?php echo $row['item_id']; ?>" />
                            <input type="hidden" name="type" value="add" />
                            <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                           <hr>
                            <div align="center"><button type="submit" class="add_to_cart btn btn-warning" style="width: 120px;"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</button></div>

                    </div>
                    </form>
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