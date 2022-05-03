<html>

<head>
</head>

<body>

  <?php

  $dbhost = 'localhost';
  $user = 'seteam10';
  $pass = 'QA87uEC2';
  $db = 'seteam10';

  $conn = mysqli_connect('localhost', $user, $pass, $db);

  ?>

  <div class="row">
    <div class="col-sm-4"></div>
    <div id="coronapic2" class="col-sm-4"></div>
    <div class="col-sm-4"></div>
  </div>

  <a href="testcases.html"> Back </a> <br>

  <form id="formID" action="vtest.php" method="post">
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
  if (isset($_POST['register'])) {
    $v_name = $_POST['name'];
    $v_address = $_POST['address'];
    $v_phone = $_POST['phone'];
    $v_email = $_POST['email'];
    $device_Id = $_POST['device_Id'];

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

      $result = "INSERT INTO Visitor (visitor_name, visitor_address, phone_number, email, device_ID, infected) VALUES ('$v_name', '$v_address', '$v_phone', '$v_email', '$device_Id', 0)";
      if (mysqli_query($conn, $result)) {
        echo 'Inserted!';
      } else {
        echo 'Failed to insert';
      }
    }
  }

  ?>

</body>

</html>