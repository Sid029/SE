<html>

<head>
  <link rel="stylesheet" href="corona.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <title>Hospital Login</title>
</head>

<body background-color="black">

  <?php

  $dbhost = 'localhost';
  $user = 'seteam10';
  $pass = 'QA87uEC2';
  $db = 'seteam10';

  $conn = mysqli_connect('localhost', $user, $pass, $db);
  ?>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a id="ekuqe" class="navbar-brand" href="index.html">Corona Archive</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a id="ekuqe" href="index.html">Home</a></li>
        <li><a id="ekuqe" href="testcases.html">Test Cases</a></li>
        <li> <a id="ekuqe" href="codeqr.php">Scan QR</a></li>
        <li> <a id="ekuqe" href="imprint.html">Imprint</a></li>
      </ul>

    </div>
  </nav>
  <div class="row">
    <div class="col-sm-4"></div>
    <div id="coronapic2" class="col-sm-4"></div>
    <div class="col-sm-4"></div>
  </div>
  <form action="login_h.php" method="post">
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

      <br>
      <br>


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

      $data = mysqli_query($conn, "SELECT h_username, h_password FROM Hospital WHERE h_username = '$username' AND h_password = '$password' AND authorize = 1");

      $result = mysqli_fetch_assoc($data);

      if ($result != NULL) {
        session_start();
        $_SESSION['user_hospital'] = $username;
        header("Location: hospital.php");
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