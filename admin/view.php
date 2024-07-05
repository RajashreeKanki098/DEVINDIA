<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'dev_india');
if($_SESSION['login']=="")
{
    header('Location:admin_login.php');
}
if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $id = $_POST['id']; 
    $sql = "UPDATE register SET register_status='$status' WHERE id='$id'";
    if(mysqli_query($conn, $sql))
    {        
        // echo "<script>window.location.href='view.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <title>DEV INDIA</title>
  </head>
  <style>


  </style>
  <body>
  <nav class="navbar bg-body-tertiary  bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../image/icon1.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      <span style="color:white;">DEV INDIA</span>
    </a>
    <a href='logout.php' class="btn btn-primary">Logout</a>
  </div>
</nav>
<div class="container" style="margin-top:20px;">
  <div class="row">
    <div class="col-lg-6">
      <table class="table table-bordered table-hover dt-responsive" id="example">
        <tbody>
            <?php
            $id=$_GET['id'];
            $sql="select * from register where id='$id'";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($query))
            {
           ?>
            <tr>
                <th>ID</th><td><?php echo $row['id'];?></td>
            </tr>
            <tr>
                <th>Name</th><td><?php echo $row['name'];?></td>
            </tr>
            <tr>
                <th>Father Name</th><td><?php echo $row['father_name'];?></td>
            </tr>
            <tr>
                <th>Gender</th><td><?php echo $row['gender'];?></td>
            </tr>
            <tr>
                <th>DOB</th><td><?php echo $row['dob'];?></td>
            </tr>
            <tr>
                <th>Marital Status</th><td><?php echo $row['status'];?></td>
            </tr>
            <tr>
                <th>Address</th><td><?php echo $row['address'];?></td>
            </tr>
            <tr>
                <th>State</th><td><?php echo $row['state'];?></td>
            </tr>
            <tr>
                <th>City</th><td><?php echo $row['city'];?></td>
            </tr>
            <tr>
                <th>Pincode</th><td><?php echo $row['pincode'];?></td>
            </tr>
            <tr>
                <th>Mobile Number</th><td><?php echo $row['mobile_no'];?></td>
            </tr>
            <tr>
                <th>WhatsApp Number</th><td><?php echo $row['whatsapp_no'];?></td>
            </tr>
            <tr>
                <th>Email</th><td><?php echo $row['email'];?></td>
            </tr>
            <tr>
                <th>Adhaar Front Photo</th><td><img src='../image/<?php echo $row['adhaar_front'];?>' width="100" height="100"> <a href="../image/<?php echo $row['adhaar_front'];?>" download>Click Here to Download</a></td>
            </tr>
            <tr>
                <th>Adhaar Back Photo</th><td><img src='../image/<?php echo $row['adhaar_back'];?>' width="100" height="100"> <a href="../image/<?php echo $row['adhaar_back'];?>" download>Click Here to Download</a></td>
            </tr>
            <tr>
                <th>Pancard Photo</th><td><img src='../image/<?php echo $row['pancard'];?>' width="100" height="100"> <a href="../image/<?php echo $row['pancard'];?>" download>Click Here to Download</a></td>
            </tr>
            <tr>
                <th>Date</th><td><?php echo $row['date'];?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <select name="status" onchange="this.form.submit()" class="form-control">
                        <option value="Registered Member" <?php if ($row['register_status'] == 'Registered Member') echo 'selected'; ?>>Registered Member</option>
                        <option value="Pending Member" <?php if ($row['register_status'] == 'Pending Member') echo 'selected'; ?>>Pending Member</option>
                        <option value="Approved Member" <?php if ($row['register_status'] == 'Approved Member') echo 'selected'; ?>>Approved Member</option>
                    </select>
                </form>
                </td>
            </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
