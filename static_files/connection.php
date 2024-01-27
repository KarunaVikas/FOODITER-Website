<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');

$con = mysqli_connect('localhost', 'root', 'Jesuschrist@1','customer_information');

// get the post records
$uname = $_POST['uname'];
$ename = $_POST['ename'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$phonenumber = $_POST['phonenumber'];
$psw = $_POST['psw'];
$cpsw = $_POST['cpsw'];

// database insert SQL code
$sql = "INSERT INTO `registration_1` (`Id`, `uname`, `ename`, `gender`, `age`, 'phonenumber', 'psw', 'cpsw') VALUES ('0', `$uname`, `$ename`, `$gender`, `$age`, '$phonenumber', '$psw', '$cpsw')";

// insert in database 
$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Contact Records Inserted";
}
?>