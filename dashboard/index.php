<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = get_user_data($conn);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IotBay</title>
</head>

<style>
body {
    background-color: white;
}
h1,p {
    color: black;
    text-align: center;
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
  margin-top: 280;

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
  width:300px;
  height:300px;
  
  border: 4px solid #828282;
  text-decoration: none;
  text-transform: uppercase;
  font-family: "Source Sans Pro", sans-serif;
  font-weight: 900;
  letter-spacing: 0.1em;
  padding: 0.3em 0;
  position: relative;
  transition: 0.2s all;
  margin-top: 200px;
  padding-left: 0.75em;
  padding-right: 0.75em;
  top: -2.75em;
  bottom: 4.75em;
  background: white;
}
.c-btn:before {
  content: "";
  position: absolute;
  bottom: 0;
  width: 100%;
  background: white;
  height: 0%;
  transition: 0.2s all;
  left: 0;
  z-index: -10;
}
.c-btn:hover {
  background: #e3e3e3;
  padding-left: 0.75em;
  padding-right: 0.75em;
  color: black;
  border-color: #828282;
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

.logoutLink {margin-top:0px; margin-right:150px; text-align:right;}

</style>

<body>
<?php 
  if ($user_data != null) {
?>
  <div style="color:black;">
  <h4 style="text-align:right; margin-right:70px; margin-top:50px;">You are logged in as <?php echo $user_data['user_name']; ?></h4>
  <div class="logoutLink">
  <a href="logout.php" style="text-decoration: none; color:aliceblue;">Logout</a>
<a href='index.php?id=".$result["id"]."' class="btn" style="text-decoration: none; color:aliceblue; padding-left:88%" >Cancel Registration</a>
<?php
  }
  else {
  ?> 
  <div style="color:black;">
  <div class="logoutLink">
  <br>
  <a href="welcome.php">Back to previous page</a>
  <?php
    }
  ?>

  </div>
  <h1 style="">Welcome!</h1>
  </div>

<div style="display: flex;">
  <?php
    echo "<div style='bottom:20px;'>";        
    echo "<a style=' margin-left:7%; 'class='c-btn' href='productsearch.php'><p> Browse Products </p></a> </div>";
      
    // echo '<a href="payment.php" style="text-decoration: none; text-decoration:underline; color:aliceblue"><p>Update Products</p></a>';

    echo "<a style=' margin-left:7%; 'class='c-btn' href='update_delivery.php'><p> Update Delivery </p></a> </div>";

    if ($user_data != null && $user_data['isEmployee'] == false) {//Is customer and not employee 
      echo "<a style='margin-left:33%; top:-545px;'class='c-btn' href='payment.php'><p> Payment & Shipping details </p></a>";
    }
    else if ($user_data == null) {//Is anonymous user 
      echo "<br><br><br><br><br><br><br>";
    }

?>

</div>



</body>
<footer></footer>
</html>
