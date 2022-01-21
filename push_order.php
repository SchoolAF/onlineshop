<?php
// database connection code
if(isset($_POST['cust_name']))
{
$con = mysqli_connect('localhost', 'root', '','hlcynj');

// get the post records

$cust_name = $_POST['cust_name'];
$cust_address = $_POST['cust_address'];
$cust_province = $_POST['cust_province'];
$cust_phone = $_POST['cust_phone'];
$cust_voucher = $_POST['cust_voucher'];

// database insert SQL code
$sql = "INSERT INTO `orders` (`Id`, `cust_name`, `cust_address`, `cust_province`, `cust_phone`, `cust_voucher`) VALUES ('0', '$cust_name', '$cust_address', '$cust_province', '$cust_phone', '$cust_voucher')";

// insert in database 
$rs = mysqli_query($con, $sql);
if($rs)
{
	echo "Thanks for ordering";
}
}
else
{
	echo "Uhh-ing the uhh right now";
	
}
?>