<?php
$flag=0;
session_start();
if(isset($_POST['save_data']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    if($email=="devindia@gmail.com" && $password=="devindia098")
    {        
        echo "<script>window.location.href='index.php';</script>";
        $_SESSION['login']=1;
    }else
    {
        echo "<script>alert('Invalid Email or Password');</script>";
        // echo "<script>window.location.href='index.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>DEV INDIA</title>
  </head>
  <body>
      <h1 style="text-align:center;margin-top:50px;margin-bottom:30px;">Admin Login</h1>
<div class="container ">
  <div class="row d-flex justify-content-center">
      <div class="col-6">
      <form method="post" style="border:1px solid black;padding: 30px 30px;border-radius:20px;">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <input type="submit" name="save_data" class="form-control btn btn-primary" id="exampleInputPassword1">
            </div>
        </form>
      </div>
  </div>
</div>
<div class="text-center mt-3">
          <div class="d-flex justify-content-center">
            <span><a href="#">© Copyright 2022-23 Dev India IT Services</a></span>
          </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>
