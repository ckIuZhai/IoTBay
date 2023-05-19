<header class="c-header">
  <h1>Your Cart</h1>
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
<?php
session_cache_limiter('private_no_expire');
session_start();

include("connection.php");
include("functions.php");

$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0'; //Need to find some way of not increasing order if the page is refreshed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['clear_cart'])) {
    //update_inventory($con, $_POST['product_id'], (-1));
		clearCart($con);
	}
	else {
		addToCart($con, $_POST['product_id'], $_POST['quantity']);
    update_inventory($con, $_POST['product_id'], (1));
		echo "<p>Added to cart successfully.</p>";
	}
}

echo "<div><p>Items in your cart:<br>";
if (empty($_SESSION['cart'])) {
	echo "Cart is empty";
}
else {
	echo '<table>';
	$total = 0;
	echo "<th></th><th>Product Name</th><th>Quantity</th><th>Price (Each)</th>";
	foreach ($_SESSION['cart'] as $product_id => $quantity) {
		echo '<tr>';
		$query = "SELECT product_name, imageLink, price FROM product WHERE id = '$product_id'";
		$result = mysqli_query($con, $query);
		$content = $result->fetch_assoc();
		echo "<td><img src=" . ($content["imageLink"]) ." width=250 height=250'> </td>";
		echo "<td>" . $content["product_name"] . "</td>";
		echo "<td>" . $quantity . "</td>";
		echo "<td>$" . $content['price'] . "</td>";
		echo '</tr>';
		$total += $content['price'] * $quantity;
	}
	echo "<td></td><td></td><td></td><td>Total: $$total</td>";
	echo '</table>';
}
echo "</p>"


?>

<p>
<a href="listAllProducts.php">Return to products</a>
<a href="submitOrder.php">Submit Order</a>

<form method="POST" action="">
    <input type="hidden" name="clear_cart" value="1">
    <button type="submit">Clear Cart</button>
</form>
</div>
</p></body>
<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>