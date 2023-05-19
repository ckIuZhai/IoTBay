<?php
    include("connection.php"); 
    
    if ($conn->connect_error) {
        die("connect database fail: " . $conn->connect_error);
    }

    $id = $_POST['id'];

    $sql = "INSERT INTO delivery (id, status) VALUES ('$id', 'Confirm')";

    if ($conn->query($sql) === TRUE) {
        echo "insert delivery success";
    } else {
        echo "insert fail: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
    
?> 
<br>
 <a href="update_delivery.php" style="color:gray;"><= Back to update delivery<br><br></a>

  