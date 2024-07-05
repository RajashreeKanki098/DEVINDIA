<?php
$flag=0;
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'dev_india');

$id=$_GET['id'];
if(isset($_POST['upload_data']))
{
  $image_nm = $_FILES['file']['name'];
  $image_tmp = $_FILES['file']['tmp_name'];
  $image_store = "image/" . $image_nm;
  $sql = "update register set screenshot='$image_nm' where whatsapp_no='$id'";
        if (mysqli_query($conn, $sql)) 
        {
            if (move_uploaded_file($image_tmp, $image_store))
            {
              echo "<script>alert('Uploaded Successfully');</script>";
            }else{
              echo "<script>alert('Something went wrong try again');</script>";
            }
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
      <h2 style="text-align:center;margin-top:50px;margin-bottom:30px;">Scan the QR code</h2>
<div class="container ">
  <div class="row d-flex justify-content-center">
      <div class="col-3">      
        <img src="image/gettyimages-1398152203-612x612.jpg" alt="qr code" width="250" height="250">
        <!-- <form action="" method="post" enctype="multimultipart/form-data" > -->
        <form id="stripe-login" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Upload Screenshot of payment </label>
          <input type="file" name="file" id="file" class="form-control" required>
        </div>
        <div class="form-group">
          <input type="submit" name="upload_data" id="" class="form-control btn btn-lg btn-primary">
        </div>
        <a href='index.php' class="form-control btn btn-lg btn-primary">Get Back</a>
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