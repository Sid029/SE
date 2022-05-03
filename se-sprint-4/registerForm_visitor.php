<html>

  <?php include 'header.php' ?>
  <?php include 'navbar.php' ?>
  <?php include 'config.php' ?>

  <title>Visitor Register</title>
</head>

<body>

  <div class="row">
    <div class="col-sm-4"></div>
    <div id="coronapic2" class="col-sm-4"></div>
    <div class="col-sm-4"></div>
  </div>

  <form id="formID" action="registerForm_visitor.php" method="post">
    <div id="cont" class="container">
      <center>
        <h1>Register as a Visitor</h1>
        <div class="row">
          <div id="role1" class="col-sm-4"></div>

        </div>
        <p>Please fill in this form to create an account.</p>
        <hr>
      </center>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name">

      <label for="address"><b>Address</b></label>
      <input type="text" placeholder="Enter Address" name="address">

      <label for="phone"><b>Phone number</b></label>
      <input type="text" placeholder="Enter Phone number" name="phone">

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email">

      <input type="hidden" name="device_Id" id="device_Id" value=""><br> <br>

      <button type="submit" class="registerbtn" name="register" id="regjistrohu">Register</button>
    </div>


  </form>
  </div>
  <div id="thespace" class="col-lg-12"></div>


  <script>
    var navigator_info = window.navigator;
    var screen_info = window.screen;
    var uid = navigator_info.mimeTypes.length;
    uid += navigator_info.userAgent.replace(/\D+/g, '');
    uid += navigator_info.plugins.length;
    uid += screen_info.height || '';
    uid += screen_info.width || '';
    uid += screen_info.pixelDepth || '';
    console.log(uid);
    document.getElementById("device_Id").value = uid
  </script>

  <?php
  function getUserIP()
  {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
      $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
      $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
      $ip = $forward;
    } else {
      $ip = $remote;
    }

    return $ip;
  }
  if (isset($_POST['register'])) {
    $v_name = $_POST['name'];
    $v_address = $_POST['address'];
    $v_phone = $_POST['phone'];
    $v_email = $_POST['email'];
    $device_Id = getUserIP();

    $minDigits = 9;
    $maxDigits = 15;

    if ($v_name == '' || $v_address == '' || $v_phone == '' || $v_email == '' || $device_Id == '') {
      echo 'Fields are empty. Please fill them in';
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $v_name)) { // Validate name
      echo 'Name is invalid!';
      error_log("Invalid name", 0);
    } elseif (!preg_match('/^[0-9]{' . $minDigits . ',' . $maxDigits . '}\z/', $v_phone)) { //Validate phone number
      echo 'Phone number is invalid!';
      error_log("Invalid phone number", 0);
    } elseif (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $v_email)) { // Validate email
      echo 'Email is invalid!';
      error_log("Invalid email", 0);
    } else {

      $result = "INSERT INTO Visitor (visitor_name, visitor_address, phone_number, email, device_ID, infected) VALUES ('$v_name', '$v_address', '$v_phone', '$v_email', '$device_Id', 1)";
      if (mysqli_query($conn, $result)) {
        session_start();
        $_SESSION['user_visitor'] = $device_Id;
        $_SESSION['user_name'] = $v_name;
        header("Location:codeqr.php");
      } else {
        echo 'Failed to insert';
      }
    }
  }

  ?>

</body>

</html>
