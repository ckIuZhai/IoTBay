<header class="c-header">
  <h1>Your Orders</h1>
  <p></p>
  <ul class="navbar">
    <li><a href="welcome.php">Home</a></li>
    <li><a href="login2.php">Login/Register</a></li>
    <li><a href="listAllProducts.php">All Products</a></li>
    <li><a href="productsearch.php">Search Products</a></li>
    <li><a href="order.php">Your Cart</a></li>
	<li><a href="orders.php">Previous Orders</a></li>
  </ul>
</header>
<style>
ul.navbar {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
}
ul.navbar li {
  display:inline;
}
ul.navbar li a {
  display: block;
  padding: 8px 16px;
  text-decoration: none;
  color: #FAEBD7;
}
body {
  background-image: url("https://images.pexels.com/photos/7087668/pexels-photo-7087668.jpeg?auto=compress&cs=tinysrgb&w=1600");
  opacity: 1;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
}
.c-header,
.c-footer {
  background: lightskyblue;
  text-align: center;
  padding: 2em;
  font-family: "Source Sans Pro", sans-serif;
  font-size: 1.4em;
  font-weight: 300;
  line-height: 1.6em;
}
footer {
  margin-top:460;
}
table, th, td {
  font-size: 1.4em;
  border: 1px solid black;
  width: 40%;
}
div {
  padding-left: 50px;
}
</style>
<body>
<div>
<?php
session_start();

include("connection.php");
include("functions.php");

if (!isset($_SESSION['user_id'])) {
  echo "Anonymous users do not have their orders saved on our system. Next time, please register first.";
}
else {
	$uid = $_SESSION['user_id'];
	$query = "SELECT DISTINCT order_id FROM orders WHERE user_id = '$uid'";
	$result = mysqli_query($con, $query);
	if (mysqli_num_rows($result) < 1) {
		echo "You don't have any previous orders.";
	}
	else {
	while ($row1 = mysqli_fetch_assoc($result)) {
		$order_id = $row1['order_id'];
		
		echo "Order number: " . $order_id;
		$query = "SELECT product_id, quantity FROM orders WHERE order_id = '$order_id' AND user_id = '$uid'";
		$result1 = mysqli_query($con, $query);
		$total = 0;
		echo '<table>';
		echo "<th></th><th>Product Name</th><th>Quantity</th><th>Price (Each)</th>";
		while ($row = mysqli_fetch_assoc($result1)) {
			$product_id = $row['product_id'];
			$quantity = $row['quantity'];
			
			echo '<tr>';
			$query = "SELECT product_name, imageLink, price FROM product WHERE id = '$product_id'";
			$result2 = mysqli_query($con, $query);
			$content = $result2->fetch_assoc();
			echo "<td><img src=" . ($content["imageLink"]) ." width=250 height=250'> </td>";
			echo "<td>" . $content["product_name"] . "</td>";
			echo "<td>" . $quantity . "</td>";
			echo "<td>$" . $content['price'] . "</td>";
			echo '</tr>';
			$total += $content['price'] * $quantity;
		}
		echo "<td></td><td></td><td></td><td>Total: $$total</td>";
		echo '</table>';
		echo "<hr>";
	}
	}
}
?>
</div></body>
<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>