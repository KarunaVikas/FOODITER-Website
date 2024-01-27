<?php
require_once "config.php";

$uname = $psw = $cpsw = "";
$uname_err = $psw_err = $cpsw_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["uname"]))){
        $uname_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE uname = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_uname);

            // Set the value of param username
            $param_uname = trim($_POST['uname']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $uname_err = "This username is already taken"; 
                }
                else{
                    $urname = trim($_POST['uname']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['psw']))){
    $psw_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['psw'])) < 5){
    $psw_err = "Password cannot be less than 5 characters";
}
else{
    $psw = trim($_POST['psw']);
}

// Check for confirm password field
if(trim($_POST['psw']) !=  trim($_POST['cpsw'])){
    $psw_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($uname_err) && empty($psw_err) && empty($cpsw_err))
{
    $sql = "INSERT INTO users (uname, psw) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_uname, $param_psw);

        // Set these parameters
        $param_uname = $uname;
        $param_psw = password_hash($psw, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: Home.html");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>






























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cedarville+Cursive&display=swap" rel="stylesheet">
</head>
<style>
    body{
        background-image: url("https://images.unsplash.com/photo-1550966871-3ed3cdb5ed0c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTJ8fHJlc3RhdXJhbnR8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<body>
    <center>
        <forms action="signup.php" method="post">
            <label for="uname"><b>Name</b></label>
            <input type="text" placeholder="Enter your Name" name="uname" required>
            <br><br>
            <label for="ename"><b>Email</b></label>
            <input type="text" placeholder="Enter your Email" name="ename" required><sup style="color: red;">*</sup>
            <br><br>
            <label for="gender"><b>Select your Gender</b></label><br>
            <input type="radio" id="M" name="fav_language" value="M">
            <label for="gender">M</label><br>
            <input type="radio" id="F" name="fav_language" value="F">
            <label for="gender">F</label><br>
            <label for="age"><b>Enter your Age</b></label>
            <input type="number" placeholder="Enter your Age" min="16" max="70"  name="age"><br><br>
            <label for="phonenumber"><b>Enter Phone Number</b></label>
            <input type="tel" placeholder="Enter your Number" minlength="1" maxlength="9" name="phonenumber"><br><br>
            <label for="psw"><b>Create Password</b></label>
            <input type="password" placeholder="Create your Password" name="psw" required>
            <br><br>
            <label for="cpsw"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm your Password" name="cpsw" required>
            <br><br>
            <button type="submit" class="btn btn-primary">sign-up</button>
        </forms>
    </center>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
        crossorigin="anonymous"></script>
</body>
</html>
