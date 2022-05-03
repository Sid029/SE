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

  <form action="htest.php" method="post">
    <div id="cont" class="container">
      <center>
        <h1>Log In as a Hospital</h1>
        <div class="row">
          <div id="role1" class="col-sm-4"></div>

        </div>

      </center>

      <label for="email"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" id="username">

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pass" id="pass">


      <button type="submit" class="registerbtn" name="login" id="regjistrohu">Login</button>
    </div>
    <center>

    </center>
  </form>
  </div>
  <div id="thespace" class="col-lg-12"></div>



  <?php
  if (isset($_POST['login'])) {

    if (!empty($_POST['username']) && !empty($_POST['pass'])) {
      $username = $_POST['username'];
      $password = $_POST['pass'];

      $data = mysqli_query($conn, "SELECT h_username, h_password FROM Hospital WHERE h_username = '$username' AND h_password = '$password'");

      $result = mysqli_fetch_assoc($data);

      if ($result != NULL) {
        echo "Login works perfectly!";
      } else { ?>
        <div class="error">
          <?php
          echo "Login is invalid!";
          error_log("Invalid login", 0);
          ?>
        </div> <?php
              }
            } else { ?>
      <div class="err">
        <?php
              echo "Fill in all the fields!";
              error_log("Required fields are empty!", 0);
        ?>
      </div> <?php
            }
          }

              ?>

</body>

</html>