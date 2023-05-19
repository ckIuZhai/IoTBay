<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IotBay</title>
</head>
<style>
body {
    background-color: black;
}
h1,p {
    color: white;
    text-align: center;
}
</style>
<body>

<a href="logout.php">Logout</a>
<h1>Welcome!</h1>
<br>
<p>Hello, <?php echo $user_data['user_name']; ?> </p>
<a href="payment.php"><p> Add payment methods and Shipping details </P></a>
</body>
</html>
