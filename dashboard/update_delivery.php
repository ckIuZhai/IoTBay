<header class="c-header">
    <div>
        <h1>Update Delivery</h1>
        <a href="index.php" style="color:gray;"><= Back to homepage<br><br></a>
    </div>
   
</header> 
<?php
    include("connection.php"); 
        
?>

<section>
    <div class="container">
        <div class="left">
            <h1>Search Delivery</h1>
            <form action="" method="GET"> 
                <input type="text" name="id" placeholder="search id delivery..." style="width: 400px; height: 50px;">
                <input type="submit" value="search">
            </form>
            <?php
                //search delivery
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
            
                    $sql = "SELECT id, status, createdAt FROM delivery WHERE id = '$id'";
            
                    $result = $conn->query($sql);
            
                    if ($result->num_rows > 0) {
                        // show result
                        while($row = $result->fetch_assoc()) {
                            echo "<h1>Result search: </h1>";
                            echo "ID: " . $row["id"]. "<br>";
                            echo "Status: " . $row["status"]. "<br>";
                            echo "CreatedAt: " . $row["createdAt"]. "<br>";
                            echo "<br>";

                            echo '
                            <h1>Update Delivery</h1>
                            <form action="" method="GET"> 
                                <input type="text" name="id_update" readonly value=' . $row["id"]. ' style="display: none;">
                                
                                <input type="text" name="status_update" placeholder="Change status" style="width: 400px; height: 50px;">
                                
                                <input type="submit" value="update">
                            </form>                
                            ';
                        }
                    } else {
                        echo "<h1>Result search: </h1>";
                        echo "Not found delivery";
                    }
                }

                //update delivery
                if (isset($_GET['id_update']) && isset($_GET['status_update'])) { 
                    $id_update = $_GET['id_update'];
                    $status_update = $_GET['status_update'];
                 
                    $sql = "UPDATE delivery SET status = '$status_update' WHERE id = '$id_update'";
                 
                    if ($conn->query($sql) === TRUE) {
                        echo "Update delivery success";
                    } else {
                        echo "Update fail: " . $conn->error;
                    }
                }
            ?>

        </div>
        <div class="right">
            <h1>
                Create Delivery
            </h1>
            <form action="insert_delivery.php" method="POST">
                <input type="text" name="id" placeholder="id delivery" style="width: 400px; height: 50px;">
                <input type="submit" value="submit">
            </form>
        </div>
    </div>
</section>

<style>
    .container{
        display: flex;
        width: 100%;
    }
    .left, .right{
        width: 50%;
        text-align: center;
    }
</style>
