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

<a href="index.php">Main Menue</a>
<br>
<p>You have successfully updated your payment and shipping details, <?php echo $user_data['user_name']; ?> </p>
    
</body>
</html>