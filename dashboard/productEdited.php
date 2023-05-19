<header class="c-header">
  <h1>View Product</h1>
  <p></p>
  <style>
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
<?php
  include("connection.php");
  include("functions.php");
  
  session_cache_limiter('private_no_expire');

  session_start();
  $pID = $_POST['productID'];
  
  if ($_SERVER['REQUEST_METHOD'] == "POST") {    
    $name = $_POST['product_name'];
    $desc = $_POST['product_desc'];
    $quan = $_POST['quantity'];
    $prod_price = $_POST['price'];
    $link = $_POST["imageLink"]; 

    $submitValue = "Save Changes";
    $formHeader = "Product Edit";

    $value = $_POST['task'];

    if (!is_numeric($quan)) {//Data validation
      $quan = 0;
    }
    if (!is_numeric($prod_price)) {
      $prod_price = 0;
    }

    if ($value == 'edit') {
      $query = "update product set product_name='$name', product_desc='$desc', price='$prod_price', quantity='$quan', imageLink='$link' where id = $pID;";
      mysqli_query($con,$query);
    }
    else {
      $product_id = random_num(20);

      $query = "insert into product (id,product_name,product_desc,price,quantity,imageLink) values ('$product_id','$name','$desc','$prod_price', '$quan','$link')";
      mysqli_query($con,$query);

      echo "<h4 style='text-align:center; bottom:650px;'>Your new product's profile: " . $name .  "</h4>";
      
    }
  }
?>
<?php
    $query = "select * from product where id = '$pID'";
    $result = mysqli_query($con,$query);
    $content = $result->fetch_assoc();

    $user_data = get_user_data($con);
    
    echo "<div style='text-align:center; margin-top:-1%; margin-bottom: 310;'>";
    echo "<h2>" . $name . "</h2>";
    echo "<h3>" . $desc . "</h3>";
    echo "<h3>" . $quan . " available at $" . $prod_price . " each. </h3>";

    echo "</div>";
    echo "<img src=" . ($link) ." width=300 height=300 style='margin-top:-10%; 
    margin-left:auto; margin-right:auto; display: block; margin-bottom: 100;'> <br>";

    $_SESSION['doQuery'] = false;
  
    if ($value == 'edit') {
      echo "<h4 style='text-align:center; bottom:50px;'>Product successfully edited.</h4>";
    }
?>

  

<div style='text-align:center; margin:0px;'>
   
  <a href="index.php">Return to home</a>
  <br>
  <a href="productsearch.php">Continue editing products</a>
</div>
<br>
</div>

<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>