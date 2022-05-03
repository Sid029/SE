<?php
session_start();
if (!isset($_SESSION['user_visitor'])) {
    header('Location: index.html');
} else {
?>
    <html>
      <head>
          <title><?php echo $_SESSION['user_name']?> - Scan QR</title>
      </head>

    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>
    <?php include 'config.php' ?>


  <body background-color="black">

  <div id="cont" class="container">
    <center>
      <h1 style="color:white">QR Code Scanner</h1>
      <video id="preview" width="100%"></video>
      <form action="codeqr.php" method="post">
        <input type="text" name="qr" id="qr" readonly="" placeholder="" style="text-align:center;">
        <button type="submit" class="registerbtn" name="confirm" id="regjistrohu">Confirm QR code</button>
      </form>
    </center>
  </div>

  <?php
  if (isset($_POST['confirm'])) {

    $qr = $_POST['qr'];
    if ($qr != null) {

      $data = mysqli_query($conn, "SELECT place_name FROM Places WHERE QRcode = '$qr'");
      $result = mysqli_fetch_assoc($data);

      if ($result != NULL) {

        echo '<center><p style="color:white">' . $result['place_name'] . '</p></center>';
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

        $user_ip = getUserIP();
        $entrydate = date("Y-m-d");
        date_default_timezone_set("Europe/Berlin");
        $entrytime = date("H:i:s");

        $result1 = "INSERT INTO VisitorToPlaces (device_ID, entry_date, entry_time, QRcode) VALUES ('$user_ip', '$entrydate', '$entrytime', '$qr')";
        if (mysqli_query($conn, $result1)) {
          echo '<center>You have successfully registered your visit at ' . $result['place_name'] . '</center>';
          header('Location: visitor.php');
          
        } else {
  ?>
          <div class="error">
            <center>
              <?php
              echo 'Error Registering!<br><br>';
              die(mysqli_error($conn));
              ?>

          </div>
          </center>
        <?php
        }
      } else {
        ?>
        <div class="error">
          <center>
            <?php
            echo "Invalid QR code!";
            ?>
        </div>
        </center>
      <?php
      }
    } else {
      ?>
      <div class="error">
        <center>
          <?php
          echo "No QR code detected!";
          ?>
      </div>
      </center>
  <?php
    }
  }
  ?>



  <?php

  ?>
  <script>
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview')
    });
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        alert('No cameras found');
      }
    }).catch(function(e) {
      console.error(e);
    });
    scanner.addListener('scan', function(c) {
      document.getElementById('qr').value = c;
    });
  </script>



</body>
    </html>

<?php
}
?>
