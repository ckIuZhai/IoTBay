<?php
session_start();

include("connection.php");
include("functions.php");

if(isset($_GET['id'])) {
    $id=$_GET['id'];
    $delet = mysqli_query($connection,"DELETE FROM `users` WHERE `id` ='$id'");
}


$user_data = check_login($con);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
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

<a href="logout.php" style="text-decoration: none; color:aliceblue;">Logout</a>
<a href="viewdetails.php" class="btn" style="text-decoration: none; color:aliceblue; padding-left:90%"></a>
<h1>Welcome!</h1>
<br>
<p>Hello, <?php echo $user_data['user_name']; ?> </p>
<a href="viewdetails.php" style="text-decoration: none; text-decoration:underline; color:aliceblue"><p>View Products</p></a>
<a href="payment.php" style="text-decoration: none; text-decoration:underline; color:aliceblue"><p>Update Products</P></a>
</body>
</html>
