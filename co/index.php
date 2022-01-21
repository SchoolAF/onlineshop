<?php
/*
MIT License
Copyright (c) 2019 Fernando 
https://github.com/fernandod1/
*/

// Configure your mysql database connection details:

$mysqlserverhost = "localhost";
$database_name = "store";
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
	$firstfield = mysqli_real_escape_string($connection, sanitize($_POST["firstfield"]));
	$secondfield = mysqli_real_escape_string($connection, sanitize($_POST["secondfield"]));
	$thirdfield = mysqli_real_escape_string($connection, sanitize($_POST["thirdfield"]));
	$fourthfield = mysqli_real_escape_string($connection, sanitize($_POST["fourthfield"]));	 
	$sql = "INSERT INTO table_form (dbfield1, dbfield2, dbfield3, dbfield4) VALUES ('$firstfield', '$secondfield', '$thirdfield', '$fourthfield')";
	if (mysqli_query($connection, $sql)) {
		  echo "<h2><font color=blue>New record added to database.</font></h2>";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	}
	mysqli_close($connection);
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout - Halcyon</title>
<link rel="stylesheet" href="../css/main.css" />
<!-- Icon Lib -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["firstfield"].value;
    var b = document.forms["Form"]["secondfield"].value;
    var c = document.forms["Form"]["thirdfield"].value;
    var d = document.forms["Form"]["fourthfield"].value;
    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="column-co mar-content" id="Form">
        <form class="order_form" action="index.php" method="post" name="Form" onsubmit="return validateForm()">
          <input type="hidden" name="processform" value="1">
          <div id="cust_name">
            <label for="cust_name_form">Name</label>
            <br>
            <input id="field1" type="text" name="firstfield" class="form-tb">
          </div>

          <div id="cust_name">
            <label for="cust_name_form">Name</label>
            <br>
            <input id="field2" type="text" name="secondfield" class="form-tb">
          </div>

          <div id="cust_name">
            <label for="cust_name_form">Name</label>
            <br>
            <input id="field3" type="text" name="thirdfield" class="form-tb">
          </div>

          <div id="cust_name">
            <label for="cust_name_form">Name</label>
            <br>
            <input id="field4" type="text" name="fourthfield" class="form-tb">
          </div>    

          <input class="btn_main" type="submit" value="Checkout!">
        </form>
      </div>

      <div class="column-co mesg" id="mesg">
        <p>Domestic shipping will takes time arround 3-5 Work days. Depending on your location.</p>
        <p>International shipping will takes time more than 7 Work days. Depending on your location.</p>
      </div>
    </div>
  </div>

  <div class="container footer">
    <span>Halcyon Store
    <br>
    Copyright © 2022 NXTZ Network</span>
  </div>
  
</div>

</body>
</html>