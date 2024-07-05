<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'dev_india');
if($_SESSION['login']!=1)
{
    header('Location:admin_login.php');
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
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Datatable Dependency start -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />

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
    <div class="col-lg-12">
      <table class="table table-bordered table-hover dt-responsive" id="example">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>WhatsApp Number</th>
            <th>Email</th>
            <th>Date</th>
            <th>Status</th>
            <th></th>
            <th style="display:none;"></th>
          </tr>
        </thead>
        <tbody>
            <?php
            $sql="select * from register";
            $query=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($query))
            {
           ?>
          <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $row['whatsapp_no'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['date'];?></td>
                <td><?php echo $row['register_status'];?></td>
                <td><a class="btn btn-primary" href="view.php?id=<?php echo $row['id'];?>">View</a></td>
                
            <td style="display:none;"></td>
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
<script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdfHtml5'
        ]
    } );
} );
</script>
    <!-- End custom js for this page -->
  </body>
</html>