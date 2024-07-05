<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'dev_india');

if (isset($_POST['save_data'])) {
    $name = $_POST['name'];
    $father_name = $_POST['father_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $status = $_POST['status'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $whatsApp_no = $_POST['whatsApp_no'];
    $email = $_POST['email'];

    $adhaar_front_nm = $_FILES['adhaar_front']['name'];
    $adhaar_front_tmp = $_FILES['adhaar_front']['tmp_name'];
    $adhaar_front_store = "image/" . $adhaar_front_nm;

    $adhaar_back_nm = $_FILES['adhaar_back']['name'];
    $adhaar_back_tmp = $_FILES['adhaar_back']['tmp_name'];
    $adhaar_back_store = "image/" . $adhaar_back_nm;

    $pancard_nm = $_FILES['pancard']['name'];
    $pancard_tmp = $_FILES['pancard']['tmp_name'];
    $pancard_store = "image/" . $pancard_nm;

    // Validate mobile and WhatsApp number
    if (!preg_match('/^\d{10}$/', $mobile) || !preg_match('/^\d{10}$/', $whatsApp_no)) {
        echo "<script>alert('Mobile and WhatsApp numbers must be exactly 10 digits');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        $sql = "INSERT INTO register(`name`, `father_name`, `gender`, `dob`, `status`, `address`, `state`, `city`, `pincode`, `mobile_no`, `whatsapp_no`, `email`, `adhaar_front`, `adhaar_back`, `pancard`, `register_status`) 
                VALUES ('$name', '$father_name', '$gender', '$dob', '$status', '$address', '$state', '$city', '$pincode', '$mobile', '$whatsApp_no', '$email', '$adhaar_front_nm', '$adhaar_back_nm', '$pancard_nm', 'PendingMember')";
        
        if (mysqli_query($conn, $sql)) {
            if (move_uploaded_file($adhaar_front_tmp, $adhaar_front_store) &&
                move_uploaded_file($adhaar_back_tmp, $adhaar_back_store) &&
                move_uploaded_file($pancard_tmp, $pancard_store)) {
                
                echo "<script>alert('Successfully Added');</script>";

                $username = 'officedevindia';
                $password = '59515448';
                $receiver_number = '91' . $whatsApp_no;
                $msgtext = "Hello". $name.",
                Your Registeration process has successfully completed
                Your Regiter Id: AB9021";
                $token = 'uCh3Ey5i3cd7AAR4nHm2';
                
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.devindia.in/api/send/text/message/v1',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => http_build_query(array(
                        'username' => $username,
                        'password' => $password,
                        'receiver_number' => $receiver_number,
                        'msgtext' => $msgtext,
                        'token' => $token,
                    )),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                $_SESSION['user_id']=$whatsApp_no;
                $id=$_SESSION['user_id'];
                header("Location:message.php?id=$id");
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DEV INDIA</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="container-fluid login-root">
    <a href="admin/admin_login.php"><img src="image/user.png" width="30" height="30" alt="" class="user-icon"></a>
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-10">
        <div class="text-center mb-4">
          <h1 style="color:white;"><img src="image/icon1.png" alt="" width="50" height="30">DEV INDIA</h1>
        </div>
        <div class="card">
          <div class="card-body">
            <form id="stripe-login" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="father-name">Father Name</label>
                    <input type="text" name="father_name" id="father_name" class="form-control" placeholder="Enter Father Name" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                      
                      <option value="female">Female</option>
                      <option value="male">Male</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="dob">DOB</label>
                    <input type="date" name="dob" id="dob" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="status">Marital Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Divorced">Divorced</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter Street No/ Address"></textarea>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="state">State</label>
                    <select name="state" id="state" class="form-control">
                      <option value="AP">Andhra Pradesh</option>
                      <option value="AR">Arunachal Pradesh</option>
                      <option value="AS">Assam</option>
                      <option value="BR">Bihar</option>
                      <option value="CG">Chhattisgarh</option>
                      <option value="GA">Goa</option>
                      <option value="GJ">Gujarat</option>
                      <option value="HR">Haryana</option>
                      <option value="HP">Himachal Pradesh</option>
                      <option value="JK">Jammu and Kashmir</option>
                      <option value="JH">Jharkhand</option>
                      <option value="KA">Karnataka</option>
                      <option value="KL">Kerala</option>
                      <option value="MP">Madhya Pradesh</option>
                      <option value="MH">Maharashtra</option>
                      <option value="MN">Manipur</option>
                      <option value="ML">Meghalaya</option>
                      <option value="MZ">Mizoram</option>
                      <option value="NL">Nagaland</option>
                      <option value="OD">Odisha</option>
                      <option value="PB">Punjab</option>
                      <option value="RJ">Rajasthan</option>
                      <option value="SK">Sikkim</option>
                      <option value="TN">Tamil Nadu</option>
                      <option value="TS">Telangana</option>
                      <option value="TR">Tripura</option>
                      <option value="UK">Uttarakhand</option>
                      <option value="UP">Uttar Pradesh</option>
                      <option value="WB">West Bengal</option>
                      <option value="AN">Andaman and Nicobar Islands</option>
                      <option value="CH">Chandigarh</option>
                      <option value="DH">Dadra and Nagar Haveli and Daman and Diu</option>
                      <option value="DL">Delhi</option>
                      <option value="LD">Lakshadweep</option>
                      <option value="PY">Puducherry</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="number" inputmode="numeric" name="pincode" id="pincode" class="form-control" placeholder="Enter Pincode" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" placeholder="Enter Mobile Number" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="WhatsApp_no">WhatsApp Number</label>
                    <input type="text" name="whatsApp_no" id="WhatsApp_no" maxlength="10" class="form-control" placeholder="Enter WhatsApp Number" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row align-items-center">
                    <div class="col-12">
                        <img id="image-preview1" src="" width="100">
                      <input type="file" id="upload-button1" name="adhaar_front" accept="image/*" onchange="previewImage1(event)"  required>
                      <label class="label1" for="upload-button1"><i class="fa-solid fa-upload"></i>&nbsp; Upload Adhaar Front Photo</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row align-items-center">
                    <div class="col-12">
                        <img id="image-preview2" src="" width="100">
                      <input type="file" id="upload-button2" name="adhaar_back" accept="image/*" onchange="previewImage2(event)" required>
                      <label class="label1" for="upload-button2"><i class="fa-solid fa-upload"></i>&nbsp; Upload Adhaar Back Photo</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="row align-items-center">
                    <div class="col-12">
                        <img id="image-preview3" src="" width="100">
                      <input type="file" id="upload-button3" name="pancard" accept="image/*" onchange="previewImage3(event)" required>
                      <label class="label1" for="upload-button3"><i class="fa-solid fa-upload"></i>&nbsp; Upload Pancard Photo</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Accept Terms and Condition</label>
              </div>

              <input type="submit" name="save_data" class="btn btn-primary" >
            </form>
          </div>
        </div>
        <div class="text-center mt-3">
          <div class="d-flex justify-content-center">
            <span><a href="#">© Copyright 2022-23 Dev India IT Services</a></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-B4gt1jrGC7Jh4AgNW24Z2EKTzSnyggRKTQomC1OgPBbhzNhuy/uj8a6Ew5K0tctD" crossorigin="anonymous"></script>
  <script>
    function previewImage1(event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          const imagePreview = document.getElementById('image-preview1');
          imagePreview.style.display = 'block';
          imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
      }
    }

    function previewImage2(event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
          const imagePreview = document.getElementById('image-preview2');
          imagePreview.style.display = 'block';
          imagePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
      }
    }

    function previewImage3(event) {
  const file = event.target.files[0];
  const imagePreview = document.getElementById('image-preview3');

  if (file) {
    const reader = new FileReader();

    reader.onload = function(e) {
      imagePreview.style.display = 'block';
      imagePreview.src = e.target.result;
    };

    reader.readAsDataURL(file);
  } else {
    
    imagePreview.style.display = 'none'; 
    imagePreview.src = ''; 
  }
}

  </script>
</body>

</html>
