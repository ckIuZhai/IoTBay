<header class="c-header">
  <h1>Product search</h1>
  <?php
    session_cache_limiter('private_no_expire');
    session_start();
  ?>
  <p></p>
  <?php
    include("connection.php");
    include("functions.php");
  ?>
  <ul class="navbar">
    <li><a href="index.php">Home</a></li>
    <li><a href="listAllProducts.php">All Products</a></li>
    <li><a href="productsearch.php">Search Products</a></li>
	  <li><a href="orders.php">Previous Orders</a></li>
  
    <?php
    $user_data = get_user_data($con);
    if ($user_data == null) {
      echo "<li><a href='login2.php'>Login/Register</a></li>
            <li><a href='order.php'>Your Cart</a></li>";
    }
    else if ($user_data['isEmployee'] == false) {
      echo "<li><a href='order.php'>Your Cart</a></li>";
    }
      
    ?>
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

footer {
  margin-top:460;

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

h4 {
  margin-top: 0;
  margin-left: 200;
  text-align: left;
  width: 400;
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

form {
  margin-left: 200px;

}

.productList {
  display: grid;
}

button {
  width: 30%;
  
}

body {
  background-image: url("https://images.pexels.com/photos/7087668/pexels-photo-7087668.jpeg?auto=compress&cs=tinysrgb&w=1600");
  opacity:1;
  background-position:center;
  background-size: cover;
  background-repeat: no-repeat;
}

  </style>
  
</header>
<section class="c-posts">
<div> 
<form action="productsearch.php" method="POST">
	<input  type="text" name="search_data" id="searchValue" style="margin-left:-100px; width: 140%; height: 100%; display:block;"/>
	<input type="submit" value="Search" style="float:right; width: 80%; height: 100%; margin-top:-36;"/>
</form>
</div>
<div>
</div>
</section>

<a href="index.php" style="color:gray; top:180px; left: 18px; position:absolute;">Back to homepage<br><br></a>





<?php 
  $_SESSION['doQuery'] = false;
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    
    $search_data = $_POST['search_data'];
    
    $query = "select * from product where product_name = '$search_data'";
    $result = mysqli_query($con,$query);

    echo "<h1 style='text-align:left; margin-top:-40; margin-left: 200;'> RESULTS </h1> <br>";

    echo "<h3 style = 'margin-left: 200;'>You searched for: " . $search_data . "</h3>";
    
    if($result)
    {
        if($result && mysqli_num_rows($result)> 0)
        {
          echo "<div class='productList'>";
          while($row = $result->fetch_assoc()) {
            echo "<div> <h4>" . "<img src=" . ($row["imageLink"]) ." width=300 height=300 style='margin-top: 00'> <br> <br> " . 
             " <b style='font-size: 25px;'> " . $row["product_name"] . "</b> <br> <br>" .
             "  <em> Price $ </em>" . $row["price"] . "<br> <em> Quantity in stock: </em>" 
            . $row["quantity"] .  "</h4>" . "<br> </div>";

              if ($row['quantity'] == 0) {
                echo "<h4>OUT OF STOCK</h4>";
              }

            $user_data = get_user_data($con);
            if ($user_data == null || $user_data['isEmployee'] == false) {//If user is not an employee, show produt profile page
              echo "<form action='product.php' method='post'> 
              <input class='c-btn' type='submit' name='productBtn' value='Go to Product Page'/>" ;
              echo "<input type='hidden' name='productID' value='" . $row['id'] . "'/>";          
              echo "</form>";
            }
            else {//If user is an employee, show create product page + link to page to edit product
              echo "<form action='productEdit.php' method='post'> " ;
              echo "<input type='hidden' name='productID' id='productID' value='" . $row['id'] . "'/>
              <input type='hidden' name='product_name' id='product_name' value='" . $row['product_name'] . "'/>
              <input type='hidden' name='product_desc' id='product_desc' value='" . $row['product_desc'] . "'/>
              <input type='hidden' name='price' id='price' value='" . $row['price'] . "'/>
              <input type='hidden' name='quantity' id='quantity' value='" . $row['quantity'] . "'/>
              <input type='hidden' name='imageLink' id='imageLink' value='" . $row['imageLink'] . "'/>
              <input class='c-btn' type='submit' name='productBtn' value='Edit Product'/>";
              echo "</form>";

              

              $_SESSION['product_name'] = $row['product_name'];
              $_SESSION['product_desc'] = $row['product_desc'];
              $_SESSION['quantity'] = $row['quantity'];
              $_SESSION['price'] = $row['price'];
              $_SESSION['imageLink'] = $row['imageLink'];
            }
          }
          echo "</div>";
        } 
        else {
          echo "<h4> No results found. </h4>";
        }
      }
    }
    
    if (isset($_SESSION['is_employee']) && $_SESSION['is_employee'] == true) {
      echo "<br><br><a href=createProduct.php class='c-btn' style='position:absolute; margin-left:200px;'>Create Product</a>";
    }
    
    echo "<br><br><a href=listAllProducts.php class='c-btn' style='position:absolute; margin-left:200px;'>View All Products</a>";

    function product_page() {
      header("location: product.php");
      die;
    } 
?>

 <script>//page only updates after a reload so fore a reload once upon navigating to page

  window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         (typeof window.performance == "undefined" ||
                              window.performance.navigation.type == 2);
  if ( historyTraversal) {
    // Handle page restore.
    window.location.reload();
  }
  });
  if ( document.referrer != 'http://localhost/dashboard/productsearch.php') {
    window.location.reload();
  }
</script>

<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank" >UTSAlumni.com</a></p>
</footer>