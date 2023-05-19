<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']== "POST")
{
    //something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //read from the database
        $query = "select * from users where user_name = '$user_name' limit 1";

        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result)> 0)
            {
                $user_data = mysqli_fetch_assoc($result);
               if($user_data['password']=== $password && $user_data['isEmployee'] == false)
               {
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['is_employee'] = $user_data['isEmployee'];
                header("location: index.php");
                die;
               }
            }
        }

        echo "<h3 style='text-align:center;'>Invalid Username or Password!</h3>";

    }else
    {
        echo "<h3 style='text-align:center;'>Invalid information!</h3>";
    }
}
else {echo " <br><br>";}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<style type="text/css">

html, body {
      display: flex;
      justify-content: center;
      height: 100%;
      }
      body, div, h1, form, input, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #666;
      }
      h1 {
      padding: 10px 0;
      font-size: 32px;
      font-weight: 300;
      text-align: center;
      }
      p {
      font-size: 12px;
      }
      hr {
      color: #a9a9a9;
      opacity: 0.3;
      }
      .main-block {
      max-width: 340px; 
      min-height: 460px; 
      padding: 10px 0;
      margin: 200;
      border-radius: 5px; 
      border: solid 1px #ccc;
      box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
      background: #ebebeb; 
      position:absolute;
      }
      form {
      margin: 0 30px;
      }
      input[type=radio] {
      display: none;
      }
      label#icon {
      margin: 0;
      border-radius: 5px 0 0 5px;
      margin-bottom: -11px;
      height: 15px;
      }
      label.radio {
      position: relative;
      display: inline-block;
      padding-top: 4px;
      margin-right: 20px;
      text-indent: 30px;
      overflow: visible;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 4px;
      top: 8px;
      left: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      input[type=text], input[type=password], input[type=email] {
      width: calc(100% - 57px);
      height: 36px;
      margin: 13px 0 0 -5px;
      padding-left: 10px; 
      border-radius: 0 5px 5px 0;
      border: solid 1px #cbc9c9; 
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #fff; 
      }
      input[type=password] {
      margin-bottom: 15px;
      }
      #icon {
      display: inline-block;
      padding: 9.3px 15px;
      box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
      background: #1c87c9;
      color: #fff;
      text-align: center;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 100%;
      padding: 10px 0;
      margin: 10px auto;
      border-radius: 5px; 
      border: none;
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #26a9e0;
      }
      .section2 {
      margin-left: 100px;
      margin-top: -20px;
      margin-bottom: 20px;
      }

</style>

<body>
    <div class="main-block">
      <div id="box">
        <form method="post">
        <div class="btn-block">
        <a href="welcome.php" style="color:gray;">Back to Home<br><br></a>
    </div>
        <div class="new">Customer Login</div>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="text" name="user_name" id="text" placeholder="Name" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="email" name="name" id="name" placeholder="Email" required/>
        <label id="icon" for="name"><i class="fas fa-user"></i></label>
        <input type="password" name="password" id="text" placeholder="Password" required/>
        <hr>
        <div class="btn-block">
          <input id="button" type="submit" value="Login"><br><br>
        <p>Create an account? </p><a href="signup2.php">Signup</a><br><br>
        </div>
    </div>
  </form>
  </div>
  </body>

    
</body>
</html>