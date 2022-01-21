<?php

// Configure your mysql database connection details:

$mysqlserverhost = "localhost";
$database_name = "hlcynj";
$username_mysql = "root";
$password_mysql = "";

// ------------------------- Do not modify code under this field -------------------------- //


function sanitize($variable){
  $clean_variable = strip_tags($variable);
  $clean_variable = htmlentities($clean_variable, ENT_QUOTES, 'UTF-8');
  return $clean_variable;
}

function connect_to_mysqli($mysqlserverhost, $username_mysql, $password_mysql, $database_name){
  $connect = mysqli_connect($mysqlserverhost, $username_mysql, $password_mysql, $database_name);
  if (!$connect) {
      die("Connection failed mysql: " . mysqli_connect_error());
  }
  return $connect;  
}

if(isset($_POST["processform"])){
  $connection = connect_to_mysqli($mysqlserverhost, $username_mysql, $password_mysql, $database_name);
  $cust_name = mysqli_real_escape_string($connection, sanitize($_POST["cust_name"]));
  $cust_address = mysqli_real_escape_string($connection, sanitize($_POST["cust_address"]));
  $cust_province = mysqli_real_escape_string($connection, sanitize($_POST["cust_province"]));
  $cust_phone = mysqli_real_escape_string($connection, sanitize($_POST["cust_phone"]));  
  $cust_voucher = mysqli_real_escape_string($connection, sanitize($_POST["cust_voucher"]));  
  $sql = "INSERT INTO `orders` (dbcust_name_form, dbcust_address_form, dbcust_province_form, dbcust_phone_form, dbcust_voucher_form) VALUES ('$cust_name', '$cust_address', '$cust_province', '$cust_phone', '$cust_voucher')";
  if (mysqli_query($connection, $sql)) {
      echo "<h2><font color=blue>New record added to database.</font></h2>";
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($connection);
  }
  mysqli_close($connection);
}

?>
<!DOCTYPE html>
<head>
	<title>Checkout - Halcyon</title>
	<link rel="stylesheet" href="css/main.css" />
	<!-- Icon Lib -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="container">
		<div class="topnav">
			<h4>Hello, customer!</h4>
      <div class="topnav-right">
        <a href="index.html"><span>Back</span></a>
      </div>
		</div>

		<br>
		<h2>Checkout Item</h2>
		<br>
  </div>
    <div class="row">

      <div class="column-co mar-content" id="Form">
        <form name="Form" method="post" action="checkout.php">
          <div id="cust_name">
            <label for="cust_name_form">Name</label>
            <br>
            <input id="cust_name_form" type="text" class="form-tb" name="cust_name">
          </div>

          <br>
          <br>
          <div id="cust_address">
            <label for="cust_address_form">Address</label>
            <br>
            <input id="cust_address_form" type="text" class="form-tb" name="cust_address">
          </div>

          <br>
          <br>
          <div id="cust_province">
            <label for="cust_province_form">Province</label>
            <br>
            <input id="cust_province_form" type="text" class="form-tb" name="cust_province">
          </div>

          <br>
          <br>
          <div id="cust_phone">
            <label for="cust_phone_form">Phone Number</label>
            <br>
            <input id="cust_phone_form" type="text" class="form-tb" name="cust_phone">
          </div>

          <br>
          <br>
          <div id="cust_phone">
            <label for="cust_phone_form">Voucher Code</label>
            <br>
            <input id="cust_phone_form" type="text" class="form-tb" name="cust_voucher">
          </div>

          <br>
          <br>
          <!-- a href="succeed.html" action="push_order.php">
            <button class="btn_main">Checkout!</button>
          </a -->

          <input type="submit" name="Submit" id="Submit" value="Checkout!"  class="btn_main">

        </form>
      </div>
      <div class="column-co mesg" id="mesg">
        <p>Domestic shipping will takes time arround 3-5 Work days. Depending on your location.</p>
        <p>International shipping will takes time more than 7 Work days. Depending on your location.</p>
      </div>
    </div>

    <div class="container footer">
      <span>Halcyon Store
      <br>
      Copyright © 2022 NXTZ Network</span>
    </div>
</body>