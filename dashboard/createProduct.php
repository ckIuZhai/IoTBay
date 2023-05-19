<header class="c-header">
  <h1>Create Product</h1>
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

.input {
  margin-left: 20px;

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
  

  $submitValue = "Create New Product";
  $formHeader = "Enter Product Details:";

  $product_id = random_num(20);
  
  if($_SESSION['doQuery'] == true && $_SERVER['REQUEST_METHOD'] == "POST") {
    $p_name = $_POST['product_name'];
    $p_desc = $_POST['product_desc'];
    $p_quan = $_POST['quantity'];
    $p_price = $_POST['price'];
    $p_link = $_POST["imageLink"]; 
  }   
  
?>

<div class="main-block" style="text-align:center; padding:20px;">
      <div id="box">
        <form method="post" action='productEdited.php'>
        <div class="btn-block">
        <a href="productsearch.php" style="color:gray; top:180px; left: 18px; position:absolute;">Back to product search page<br><br></a>
      </div>
        <div class="new"><h3><?php echo "$formHeader";?></h3><br><br></div>
        <label id="icon" for="name"><i class="input">Product name:  </i></label>
        <input type="text" name="product_name" id="product_name" value="" required/>

        <label id="icon" for="name"><i class="input">Product description:  </i></label>
        <input style="height:100px;" type="text" name="product_desc" id="name" value="" required/>

        <label id="icon" for="name"><i class="input">Product inventory:  </i></label>
        <input type="number" name="quantity" id="name" value="" required/>

        <label id="icon" for="name"><i class="input">Product price:  </i></label>
        <input type="number" name="price" id="name" value="" required/>

        <label id="icon" for="name"><i class="input">Link to product image:  </i></label>
        <input type="text" name="imageLink" id="name" value="" required/>

        <input type='hidden' name='productID' id='productID' value='product_id'/>

        <input type='hidden' name='task' id='task' value="create"/>
        <br><br><br>
      </div class='input'>
        <div class="btn-block">
          <input id="button" type="submit" value="<?php echo "$submitValue"; ?>"><br><br>
        </div>
    </div>
  </form>

  <div style='bottom:168px; right: 30px; position:absolute;'>
  <?php 
    if ($_SESSION['doQuery'] == true  &&  $_SERVER['REQUEST_METHOD'] == "POST") {
      echo "<h4 style='position:absolute; text-align:right; right:40px; '>Product created.</h4>";
    }
    
    if ($_SESSION['doQuery'] == true) {
      echo "<form action='productEdited.php' method='post' style='position:absolute; left:-1800; bottom:-120px;'> 
      <input class='c-btn' type='submit' name='productBtn' value='Go to Product Page'/>" ;
      echo "<input type='hidden' name='productID' value='" . $product_id . "'/>";            
      echo "</form>";
    }
    $_SESSION['doQuery'] = true; 
  ?>
  </div>
  <br><br><br><br><br><br><br><br>
</div>

<footer class="c-footer">
  <p>provided by UTS <a href="https://www.uts.edu.au/alumni-and-supporters/give/impact-of-giving" target="_blank">UTSAlumni.com</a></p>
</footer>