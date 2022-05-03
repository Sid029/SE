<html>

<head>
    <?php include 'header.php'; ?>
    <title>Registration Form</title>
</head>

    <?php include 'navbar.php';?>
    <?php include 'config.php';?>

<body background-color="black">

<div class="row">
  <div class="col-sm-4"></div>
  <div id="coronapic2" class="col-sm-4"></div>
  <div class="col-sm-4"></div>
</div>

  <form action="registerForm_places.php" method="post">
    <div id="cont" class="container">
      <center>
        <h1>Register as a Place</h1>
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

      <br>
      <br>


      <button type="submit" class="registerbtn" name="register" id="regjistrohu">Register</button>
    </div>
    <center>
  </form>
  </div>
  <div id="thespace" class="col-lg-12"></div>


  <?php
  if (isset($_POST['register'])) {
    $p_name = $_POST['name'];
    $p_address = $_POST['address'];
    function make_seed($name, $address)
    {
      list($usec, $sec) = explode(' ', microtime());
      return $sec + $usec + floatval($address) + floatval($name) * 1000000;
    }
    srand(make_seed($p_name, $p_address));
    $randval = rand();


    if ($p_name == '' || $p_address == '') {
      echo 'Fields are empty. Please fill them in';
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $p_name)) { //Validate name
      echo 'Name is invalid!';
      error_log("Invalid name", 0);
    } else {
      $result = "INSERT INTO Places (place_name, place_address, QRcode) VALUES ('$p_name', '$p_address', '$randval')";
      if (mysqli_query($conn, $result)) { ?>
        <center>
          <h2>Please save this QR code:<h2><br>
        </center>
        <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $randval ?>&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" />'
  <?php
      } else {
        echo 'Failed to insert';
      }
    }
  }

  ?>

</body>

</html>
