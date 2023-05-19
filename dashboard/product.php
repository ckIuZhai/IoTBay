<header class="c-header">
  <h1>View Product</h1>
  <p></p>
  <ul class="navbar">
    <li><a href="welcome.php">Home</a></li>
    <li><a href="login2.php">Login/Register</a></li>
    <li><a href="listAllProducts.php">All Products</a></li>
    <li><a href="productsearch.php">Search Products</a></li>
    <li><a href="order.php">Your Cart</a></li>
	<li><a href="orders.php">Previous Orders</a></li>
  </ul>
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
    .c-posts {
  display: flex;
  flex-wrap: wrap;
  align-items: top;
  padding: 5%;
}
.c-posts__item {
  flex-grow: 1;
  padding-bottom: 2em;
}
.c-posts__item:first-child {
  flex-grow: 2;
}

@media all and (min-width: 400px) {
  .c-posts__item {
    flex-basis: 50%;
    padding-right: 5%;
  }
  .c-posts__item:first-child {
    flex-basis: 100%;
  }
}
@media all and (min-width: 1000px) {
  .c-posts__item {
    flex-basis: 33%;
  }
  .c-posts__item:first-child {
    flex-basis: 66%;
  }
}
@media all and (min-width: 1400px) {
  .c-posts__item {
    flex-basis: 25%;
  }
  .c-posts__item:first-child {
    flex-basis: 50%;
  }
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
.c-header h1, .c-header h2, .c-header p,
.c-footer h1,
.c-footer h2,
.c-footer p {
  max-width: 40em;
  margin: 0 auto;
}
.c-header h1:not(:last-child), .c-header h2:not(:last-child), .c-header p:not(:last-child),
.c-footer h1:not(:last-child),
.c-footer h2:not(:last-child),
.c-footer p:not(:last-child) {
  margin-bottom: 1em;
}
.c-header h1,
.c-footer h1 {
  text-transform: uppercase;
  font-weight: 900;
}
.c-header a,
.c-footer a {
  color: #000;
}

.c-footer p {
  font-size: 20px;
}

* {
  box-sizing: border-box;
}

body {
  font-family: "Georgia", Times, serif;
  line-height: 1.6em;
  padding: 0;
  margin: 0;
}

h1 {
  font-size: calc(130% + 1vw);
  font-weight: normal;
}

h2 {
  font-size: 1.5em;
  font-weight: normal;
  margin-bottom: 0;
  margin-top: 0;
}

a {
  color: #0F5257;
}

.c-btn {
  color: #000;
  display: inline-block;
  border-bottom: 4px solid #000;
  text-decoration: none;
  text-transform: uppercase;
  font-family: "Source Sans Pro", sans-serif;
  font-weight: 900;
  letter-spacing: 0.1em;
  padding: 0.3em 0;
  position: relative;
  transition: 0.2s all;
}
.c-btn:before {
  content: "";
  position: absolute;
  bottom: 0;
  width: 100%;
  background: #FF521B;
  height: 0%;
  transition: 0.2s all;
  left: 0;
  z-index: -10;
}
.c-btn:hover {
  padding-left: 0.75em;
  padding-right: 0.75em;
  color: black;
  border-color: #FF521B;
}
.c-btn:hover:before {
  height: 100%;
}

.new1{

  margin-left: 100px;
}

.new2{

  margin-left: 300px;
}

.background {
  background-image: url("https://images.pexels.com/photos/7087668/pexels-photo-7087668.jpeg?auto=compress&cs=tinysrgb&w=1600");
  opacity:1;
  background-position:center;
  background-size: cover;
  background-repeat: no-repeat;
}

</style>
</header>
<div class="background">
<section class="c-posts">
<div class="new1">
  <article class="c-posts__item">
  </article>
</div>
  
</section>

<script>//page only updates after a reload so fore a reload once upon navigating to page
  window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              (window.performance.navigation.type === 2));
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
</script>

<?php
  include("connection.php");
  include("functions.php");
  session_cache_limiter('private_no_expire');

  session_start();

  $user_data = get_user_data($con);

  $pID = $_POST['productID'];
  $query = "select * from product where id = '$pID'";
  $result = mysqli_query($con,$query);
  $content = $result->fetch_assoc();

    echo "<div style='text-align:center; margin-top:-8%; margin-bottom: 310;'>";
    echo "<h2>" . $content['product_name'] . "</h2>";
    echo "<h3>" . $content['product_desc'] . "</h3>";
    echo "<h3>" . $content['quantity'] . " available at $" . $content['price'] . " each. </h3>";

    if (($user_data == null || $user_data['isEmployee'] == false) && $content['quantity'] > 0) {
      echo '<p><form method="POST" action="order.php"><input type="hidden" name="product_id" value=' . $pID . '><input type="number" name="quantity" value="1" min="1"><button type="submit">Add to Cart</button></form></p>';
    }
    else if ($content['quantity'] == 0) {
      echo "<h4>Sorry, this product is currently out of stock<h4>";
    }

    echo "</div>";
    echo "<img src=" . ($content["imageLink"]) ." width=300 height=300 style='margin-top:-10%; 
    margin-left:auto; margin-right:auto; display: block; margin-bottom: 100;'> <br>";
  
  
  $_SESSION['doQuery'] = false;
?>
<div style='text-align:center; margin:0px;'>
   
   <a href="index.php">Return to home</a>
   <br>
   <a href="productsearch.php">Continue browsing products</a>
 </div>
 <br>
 </div>
</div>

<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>