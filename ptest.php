<html>

<head>
</head>

<body background-color="black">

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

  <form action="ptest.php" method="post">
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

    if ($p_name == '' || $p_address == '') {
      echo 'Fields are empty. Please fill them in';
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $p_name)) { //Validate name
      echo 'Name is invalid!';
      error_log("Invalid name", 0);
    } else {
      $result = "INSERT INTO Places (place_name, place_address) VALUES ('$p_name', '$p_address')";
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