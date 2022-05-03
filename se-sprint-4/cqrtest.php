<html>

<head> </head>

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

    <form action="cqrtest.php" method="post">
        <div id="cont" class="container">
            <center>
                <h1>Trying to register at the place of this QR:</h1>
                <div class="row">
                    <div id="role1" class="col-sm-4"></div>

                </div>
                <img src="dummyqr.png" />
                <hr>
                <h3> This is the decoding of the QR code: </h3>
                <input type="text" name="qr" id="qr" readonly="" placeholder="800527143" style="text-align:center;">
                <h3> We shall use a pre-registered device-id '10.222.129.16' for this test. </h3>
                <button type="submit" class="registerbtn" name="confirm" id="regjistrohu">Confirm QR code</button>

            </center>

        </div>
    </form>
    </div>
    <div id="thespace" class="col-lg-12"></div>




    <?php
    if (isset($_POST['confirm'])) {

        $qr = '800527143';
        if ($qr != null) {

            $data = mysqli_query($conn, "SELECT place_name FROM Places WHERE QRcode = '$qr'");
            $result = mysqli_fetch_assoc($data);

            if ($result != NULL) {

                echo '<center>' . $result['place_name'] . '</center>';

                $user_ip = '10.222.129.16';
                $entrydate = date("Y-m-d");
                date_default_timezone_set("Europe/Berlin");
                $entrytime = date("H:i:s");

                $result1 = "INSERT INTO VisitorToPlaces (device_ID, entry_date, entry_time, QRcode) VALUES ('$user_ip', '$entrydate', '$entrytime', '$qr')";
                if (mysqli_query($conn, $result1)) {
                    echo '<center>Successfully registered your visit at ' . $result['place_name'] . '</center>';
                } else {
    ?>
                    
                        <center>
                            <?php
                            echo 'Error Registering!<br><br>';
                            die(mysqli_error($conn));
                            ?>

                    
                    </center>
                <?php
                }
            } else {
                ?>
                
                    <center>
                        <?php
                        echo "Invalid QR code!";
                        ?>
                
                </center>
    <?php
            }
        }
    }
    ?>

</body>

</html>