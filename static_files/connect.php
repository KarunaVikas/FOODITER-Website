<?php
$uname = $_POST['uname'];
$ename = $_POST['ename'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$phonenumber = $_POST['phonenumber'];
$psw = $_POST['psw'];
$cpsw = $_POST['cpsw'];

//database connection code

$conn = new mysqli('localhost','root','Jesuschrist@1','customer_information');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    $stmt = $conn->prepare("insert into registration_1(uname, ename, gender, age, phonenumber, psw, cpsw)values(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiiss",$uname, $ename, $gender, $age, $phonenumber, $psw, $cpsw);
    $stmt->execute();
    echo "Registration has been successfull..";
    $stmt->close();
}
?>