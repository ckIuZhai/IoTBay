<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $quary = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$quary);
        if($result && mysqli_num_rows($result)> 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }

    //redirect to login
    header("location: login.php");
    die;
}

function get_user_data($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $quary = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$quary);
        if($result && mysqli_num_rows($result)> 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
}

function addToCart($con, $productId, $amount) {
	if (isset($_SESSION['cart'][$productId])) {
		$_SESSION['cart'][$productId] += $amount;
	}
	else {
		$_SESSION['cart'][$productId] = $amount;
	}
	if (isset($_SESSION['user_id'])) {
		$id = $_SESSION['user_id'];
		$statement = $con->prepare("INSERT INTO carts (user_id, product_id, quantity) VALUES (?, ?, ?)");
		$statement->bind_param("sss", $id, $productId, $amount);
		$statement->execute();
		$statement->close();
	}
	
}

function clearCart($con) {
	unset($_SESSION['cart']);
	if (isset($_SESSION['user_id'])) {
		$id = $_SESSION['user_id'];
		$statement = $con->prepare("DELETE FROM carts WHERE user_id = ?");
		$statement->bind_param("s", $id);
		$statement->execute();
		$statement->close();
	}
}

function submitOrder($con) {
	if (isset($_SESSION['user_id'])) {
		$id = $_SESSION['user_id'];
	}
	else {
		$id = 0;
	}
	$order_id = random_num(20);
	$query = "SELECT DISTINCT order_id FROM orders WHERE order_id = '$order_id'";
	$result = mysqli_query($con, $query);
	while (mysqli_num_rows($result) > 0) {
		$order_id = random_num(20);
		$query = "SELECT DISTINCT order_id FROM orders WHERE order_id = '$order_id'";
		$result = mysqli_query($con, $query);
	}
	foreach ($_SESSION['cart'] as $product_id => $quantity) {
		$statement = $con->prepare("INSERT INTO orders (order_id, user_id, product_id, quantity) VALUES (?, ?, ?, ?)");
		$statement->bind_param("ssss", $order_id, $id, $product_id, $quantity);
		$statement->execute();
		$statement->close();
	}
	unset($_SESSION['cart']);
}

function update_inventory($con, $pID, $quantity) {
	$query = "SELECT DISTINCT quantity FROM product WHERE id = '$pID' limit 1;";
	$result = mysqli_query($con, $query);
	$value = mysqli_fetch_assoc($result);
	$newQuantity = $value['quantity'] - $quantity;

	$statement = $con->prepare("UPDATE PRODUCT SET quantity='$newQuantity' where id = $pID;");
	$statement->execute();
	$statement->close();
}

function random_num($length)
{
    $text = "";
    if($length > 5)
    {
        $length = 5;
    }

    $len = rand(4,$length);
    for($i=0; $i < $len; $i++)
    {
        $text .= rand(0,9);

    }

    return $text;

}