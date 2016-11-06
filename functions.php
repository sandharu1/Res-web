<?php
include 'database.php';

// ====== add product - function ======
if(isset($_POST["addProduct"])){
	$itemName = $_POST["itemName"];
	$item_id = $_POST["item_id"];
	$item_cost = $_POST["item_cost"];
	$item_shiping_cost = $_POST["item_shiping_cost"];
	$item_type = $_POST["item_type"];
	$item_image = basename($_FILES["item_image"]["name"]);
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["item_image"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// ===save file===
	if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["item_image"]["name"]). " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}


    // ====save data====
	$sql = "INSERT INTO products (itemName, item_id, item_cost, item_shipping, item_type, item_image)
	VALUES ('$itemName','$item_id','$item_cost', '$item_shiping_cost', '$item_type', '$item_image' )";
		// var_dump($sql);
	if ($conn->query($sql) === TRUE) {
			// var_dump($conn);
		echo "New record created successfully";

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	header("Location: addForms.php"); /* Redirect browser */
	exit();
}

// ========= Delete product - function ========
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	var_dump($action);
	if ($action==='delrec') {

		$productID = $_GET["id"];
		var_dump($productID);

			// sql to delete a record
		$sql = "DELETE FROM products WHERE id=$productID";

		if (mysqli_query($conn, $sql)) {
			?>
			<script type="text/javascript">
				alert("Record deleted successfully");
				window.location.href = "addForms.php";/* Redirect browser */
			</script>
			<?php

		} else {
			?>
			<script type="text/javascript">
				alert("Error deleting record");
				window.location.href = "addForms.php";/* Redirect browser */
			</script>
			<?php
			
		}


	}
	// ========= Feedback Delete - funtion ===========

	if ($action==='delfeed') {

		$feedbackID = $_GET["id"];


			// sql to delete a record
		$sql = "DELETE FROM feedback WHERE id=$feedbackID";

		if (mysqli_query($conn, $sql)) {
			?>
			<script type="text/javascript">
				alert("Feedback deleted successfully");
				window.location.href = "addForms.php";/* Redirect browser */
			</script>
			<?php

		} else {
			?>
			<script type="text/javascript">
				alert("Error deleting Feedback");
				window.location.href = "addForms.php";/* Redirect browser */
			</script>
			<?php
			
		}


	}
	
}

// ======== Feedback save - function ===========
if(isset($_POST["feedback"])){

	$feed_name = $_POST["feed_name"];
	$feed_email = $_POST["feed_email"];
	$feed_phone = $_POST["feed_phone"];
	$feed_subject = $_POST["feed_subject"];
	$feed_msg = $_POST["feed_msg"];
	
    // ====save data====
	$sql = "INSERT INTO feedback (feed_name, feed_email, feed_phone, feed_subject, feed_msg)
	VALUES ('$feed_name','$feed_email','$feed_phone', '$feed_subject', '$feed_msg' )";
		// var_dump($sql);
	if ($conn->query($sql) === TRUE) {
		?>
		<script type="text/javascript">
			alert("Feedback submitted successfully");
			window.location.href = "ContactUs.html";/* Redirect browser */
		</script>
		<?php

	} else {
		?>
		<script type="text/javascript">
			alert("New recorded feedback Error");
			window.location.href = "ContactUs.html";/* Redirect browser */
		</script>
		<?php
	}

}

// unset cookies
if (isset($_GET["delcart"])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    var_dump($cookies);
    var_dump($_GET["url"]);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-3600);
        setcookie($name, '', time()-3600, '/');
    }
    $redirect_url = $_GET["url"];
    header("Location: $redirect_url"); /* Redirect browser */
	exit();
}


?>