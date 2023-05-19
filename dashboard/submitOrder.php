<header class="c-header">
  <h1>Submit Order</h1>
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
</style>
<body>
<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['confirm'])) {
		echo "confirmation received.";
		submitOrder($con);
		header("Location: orders.php");
	}
}
if (empty($_SESSION['cart'])) {
	echo "Cart is empty, cannot submit an empty order.";
}
//else if (user does not have payment information entered) {
//	header("Location: payment.php");
//}
//else if (user is not logged on) {
//	header("Location: payment.php");
//}
else {
  echo "Your order comes to a total of $$$$. Continue?";
  echo '<form method="POST" action="">';
  echo '<input type="hidden" name="confirm" value="1">';
  echo '<button type="submit">Continue</button></form>';
}
?>
</body>
<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>