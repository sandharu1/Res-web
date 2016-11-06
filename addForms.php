<?php
ob_start();
session_start();
include 'database.php';

 // if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
 header("Location: indexAdmin.php");
 exit;
}
 // select loggedin users detail
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

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
         							<li><marquee behavior="alternate" height="20" width="300" style="color: white;"><strong><i class="fa fa-lock" aria-hidden="true"></i>Admin Area</strong></strong></marquee></li>
                      <li><p style="color: white;"><strong>&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;Welcome - <?php echo $userRow['userName']; ?> &nbsp;&nbsp;&nbsp;&nbsp;|</strong></p></li>
                      <li><a href="index.html">Home</a></li>
                      <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>

                    </ul>

                  </div>
                </div>
              </nav>

            </div>
          </div>
          <!-- =============End Nav Bar============== -->
          <!-- =======new style test====== -->
          <div id="myGroup" style="margin-top: 80px; margin-left: 100px; margin-right: 100px; margin-bottom:100px;">
          <button class="btn-lg btn-success dropdown" data-toggle="collapse" data-target="#keys" data-parent="#myGroup"><i class="icon-chevron-right"></i> Insert New Product</button>
            <button class="btn-lg btn-primary dropdown" data-toggle="collapse" data-target="#attrs" data-parent="#myGroup"><i class="icon-chevron-right"></i> View Product List</button>
            <button class="btn-lg btn-info  dropdown" data-toggle="collapse" data-target="#edit" data-parent="#myGroup"><i class="icon-chevron-right"></i> View Feedback List</button>

            <div class="accordion-group">
              <div class="collapse indent" id="keys">
                <!-- ========= Insert new Product ========= -->
                <div class="container" style="margin-top: 70px; margin-bottom: 50px;">
                 <div class="col-sm-2 col-md-2"></div>
                 <div class="col-sm-7 col-md-7 well ">
                  <h2 class="text-center"><strong><u>Add Product</u></strong></h2>
                  <form action="functions.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Item Name: </label>
                      <input type="text" class="form-control" id="exampleInputName" name="itemName" placeholder="Item Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Item ID: </label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="item_id" placeholder="Item ID">
                    </div>
                    <div class="form-inline">
                      <div class="form-group">
                        <label for="exampleInputItemCost">Item Cost: </label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="item_cost" placeholder="Item Cost USD" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Item Shipping Cost: </label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="item_shiping_cost" placeholder="Item Shipping Cost USD" required>
                      </div>
                    </div>
                    <label for="item_type">Product Type: </label>
                    <select class="form-control" id="item_type" name="item_type">
                     <option value="BakeryPastry">Bakery & Pastry</option>
                     <option value="Beverages">Beverages</option>
                     <option value="ChocolatesDesserts">Chocolates & Desserts</option>
                     <option value="HealthProducts">Health Products</option>
                     <option value="Cuisine">Cuisine</option>
                     <option value="CakesGateau">Cakes & Gateau</option>
                     <option value="RealeGelato">Reale Gelato</option>
                   </select>
                   <div class="form-group">
                     <label for="exampleInputFile">Item Image</label>
                     <input type="file" id="exampleInputImage" name="item_image" required>
                     <p class="help-block">Please upload 300*200 px .jpg images.</p>
                   </div>
                   <button type="submit" value="addProduct" name="addProduct" class="btn btn-primary">Submit</button>
                 </form>
               </div> <!-- end coloumn -->
               <div class="col-sm-2 col-md-2"></div>
             </div> <!-- end add product container -->
           </div>

           <div class="collapse indent" id="attrs">
            <!-- ====== product table view===== -->
            <div class="row">
             <div class="col-sm-2 col-md-2"></div>
             <div class="col-md-8 col-sm-8 well" style="margin-bottom: 50px">

               <h2 class="text-center">Product Table</h2>
               <hr>
               <!-- <table class="table table-responsive table-striped" id="example"> -->
               <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                 <thead>
                   <tr>
                    <th>#</th>
                    <th>Product Name</th> 
                    <th>Product ID</th>
                    <th>Cost (USD)</th> 
                    <th>Shipping Cost (USD)</th>
                    <th>Product Type</th> 
                    <th>Recode created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                .     <?php
                $query = "SELECT * FROM products ORDER BY id asc";
                $tabledata = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($tabledata)){

                  ?>
                  
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['itemName']; ?></td>
                      <td><?php echo $row['item_id']; ?></td>
                      <td><?php echo $row['item_cost']; ?></td>
                      <td><?php echo $row['item_shipping']; ?></td>
                      <td><?php echo $row['item_type']; ?></td>
                      <td><?php echo $row['created_at']; ?></td>
                      <td><a class="btn btn-danger" href="functions.php?action=delrec&id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                  
                  <?php
                }
                ?>
                </tbody>
              </table>

            </div>
            <div class="col-sm-2 col-md-2"></div>
          </div> <!-- end row -->
        </div>

        <div class="collapse" id="edit">
          <div class="row">

           <!-- ====== Feedback table view===== -->
           <div class="col-sm-1 col-md-1"></div>
           <div class="col-md-9 col-sm-9 well" style="margin-bottom: 50px;">

             <h2 class="text-center">Customer Feedback Table</h2>
             <hr>
             <table id="example2" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
               <thead>
                 <tr>
                  <th>#</th>
                  <th>Customer Name</th> 
                  <th>Email</th>
                  <th>Phone</th> 
                  <th>Feedback Subject</th>
                  <th>Message</th> 
                  <th>Recode created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              .     <?php
              $query = "SELECT * FROM feedback ORDER BY id desc";
              $tabledata = mysqli_query($conn, $query);
              while($row = mysqli_fetch_array($tabledata)){

                ?>
                
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['feed_name']; ?></td>
                    <td><?php echo $row['feed_email']; ?></td>
                    <td><?php echo $row['feed_phone']; ?></td>
                    <td><?php echo $row['feed_subject']; ?></td>
                    <td><?php echo $row['feed_msg']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><a class="btn btn-danger" href="functions.php?action=delfeed&id=<?php echo $row['id']; ?>">Delete</a></td>
                  </tr>
                
                <?php
              }
              ?>
              </tbody>
            </table>

          </div>
          <div class="col-sm-2 col-md-2"></div>
        </div> <!-- end row -->
      </div>
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    } );
  </script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example2').DataTable();
    } );
  </script>


</body>
</html>