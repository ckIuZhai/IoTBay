
<?php

require_once('db.php');
$query = "select * from users";
$result = mysqli_query($con,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
</head>
<style>
body{
    background-color: black;
}

p{
    color: aliceblue;
    text-align: center;
}

.align {
    color: aliceblue;
    text-align: center;
}


</style>
<body>
<a href="index.php" style="text-decoration: none; color:aliceblue;">Home</a>
    <div class="align">
    <?php 
    
    while($row = mysqli_fetch_assoc($result))
    {
        ?>
        <td><p>User ID;</p><?php echo $row['user_id'];?></td>
        <td><p>User Name;</p><?php echo $row['user_name'];?></td>
        <td><p>Password;</p><?php echo $row['password'];?></td>
        <td><p>Date;</p><?php echo $row['date'];?></td>
        <?php
    }

    ?>
    </div>  
    <div>
       <a href="details.php" style="padding-left:58%;"> <button style="cursor: pointer;">edit details</button></a>
    </div>
</body>
</html>