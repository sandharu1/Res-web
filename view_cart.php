<?php
session_start();
include_once("config.php");
$previous_location = $_SESSION['previous_location'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artsy Tartsy - View shopping cart</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
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
<div class="container style-row">
<h1 align="center">Artsy Tartsy - View Cart</h1>
<div class="cart-view-table-back">
<form method="post" action="cart_update.php">
<table width="100%"  cellpadding="6" cellspacing="0" class="table">
    <thead>
    	<tr><th>Quantity</th><th>Name</th><th>Price</th><th>Total</th><th>Remove</th></tr>
    </thead>
  <tbody>
 	<?php
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		$b = 0; //var for zebra stripe table 
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_qty"];
			$product_price = $cart_itm["product_price"];
			$product_code = $cart_itm["product_code"];
			// $product_color = $cart_itm["product_color"];
			$subtotal = ($product_price * $product_qty); //calculate Price x Qty
			
		   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';
			echo '<td><input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
			echo '<td>'.$product_name.'</td>';
			echo '<td>'.$currency.$product_price.'</td>';
			echo '<td>'.$currency.$subtotal.'</td>';
			echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /></td>';
            echo '</tr>';
			$total = ($total + $subtotal); //add subtotal to total var
        }
		
		$grand_total = $total + $shipping_cost; //grand total including shipping cost
		foreach($taxes as $key => $value){ //list and calculate all taxes in array
				$tax_amount     = round($total * ($value / 100));
				$tax_item[$key] = $tax_amount;
				$grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
		}
		
		$list_tax       = '';
		foreach($tax_item as $key => $value){ //List all taxes
			$list_tax .= $key. ' : '. $currency. sprintf("%01.2f", $value).'<br />';
		}
		$shipping_cost = ($shipping_cost)?'Shipping Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	}
    ?>
    <tr>
        <td colspan="5">
            <span style="float:right;text-align: right;">
            <?php echo $shipping_cost. $list_tax; ?>Amount Payable : <?php echo sprintf("%01.2f", $grand_total);?>
            </span>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <a href="<?php echo $previous_location ?>" class="button btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add More Items</a>
            <button type="submit" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i> Update</button>
            <a href="paypal-express-checkout" ><img src="img/paypal-checkout-button.png" width="180" height="42" style="margin-top:8px;"></a>
        </td>
    </tr>
  </tbody>
</table>
<input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!-- <script src="js/holder.min.js"></script> -->


</body>
</html>
