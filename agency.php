<?php
session_start();
if (!isset($_SESSION['user_agent'])) {
    header('Location:login_a.php');
} else {
?>

    <html>

    <head>

        <?php include 'header.php' ?>
        <?php include 'navbar.php' ?>
        <?php include 'config.php' ?>
        <title>Agent Portal</title>

    </head>

    <div class="search">
        <form action="search_page_agent_visitor.php" method="POST">
            <button style="color: black; font-weight: bold;" a href="search_page_agent_visitor.php"> Search for Visitor</button>
        </form>


        <form action="search_page_agent_place.php" method="POST">
            <button style="color: black; font-weight: bold;" a href="search_page_agent_place.php"> Search for Establishment</button>
        </form>

        <form action="agent_hospital_authorize.php" method="POST">
            <button style="color: black; font-weight: bold;" a href="agent_hospital_authorize.php"> Authorize Hospital</button>
        </form>
    </div>

    <body background-color="black">


        <h4 style="color: white; font-weight: bold;">Registered Citizens</h4>

        <?php
        $data = mysqli_query($conn, "SELECT * FROM Visitor");
        ?>


        <table class="table" style="color: white;">

            <tr style="background-color: Green;">
                <th>Name</th>
                <th>Address</th>
                <th>Phone number</th>
                <th>Email</th>
                <th>Infected</th>
            </tr>
            <?php
            while ($result = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td> <?php echo $result["visitor_name"]; ?> </td>
                    <td> <?php echo $result["visitor_address"]; ?> </td>
                    <td> <?php echo $result["phone_number"]; ?> </td>
                    <td> <?php echo $result["email"]; ?> </td>
                    <td> <?php if ($result["infected"] == 0) {
                                echo "no";
                            } else {
                                echo "yes";
                            }; ?> </td>
                </tr>
            <?php } ?>

        </table>

        <br>
        <br>
        <br>


        <h4 style="color: white; font-weight: bold;">Registered Establishments</h4>

        <?php

        $data = mysqli_query($conn, "SELECT * FROM Places");
        ?>



        <table class="table" style="color: white;">

            <tr style="background-color: Green;">
                <th>Name</th>
                <th>Address</th>
                <th>QRcode</th>
            </tr>
            <?php while ($result = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td> <?php echo $result["place_name"]; ?> </td>
                    <td> <?php echo $result["place_address"]; ?> </td>
                    <td> <?php echo $result["QRcode"]; ?> </td>
                </tr>
            <?php } ?>

        </table>
        <br>
        <br>
        <br>
        <h4 style="color: white; font-weight: bold;">Hospitals</h4>

        <?php

        $data = mysqli_query($conn, "SELECT * FROM Hospital");
        ?>

        <table class="table" style="color: white;">

            <tr style="background-color: Green;">
                <th>Username</th>
                <th>Password</th>
                <th>approved?</th>
            </tr>
            <?php
            while ($result = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td> <?php echo $result["h_username"]; ?> </td>
                    <td> <?php echo $result["h_password"]; ?> </td>
                    <td> <?php if ($result["authorize"] == 0) {
                                echo "no";
                            } else {
                                echo "yes";
                            }; ?>
                    <?php
                }
                    ?>
                    </td>
                </tr>
                <?php

                ?>
        </table>
        <br>
        <br>
        <br>
        <h4 style="color: white; font-weight: bold;">Hospitals</h4>

        <?php

        $data = mysqli_query($conn, "SELECT * FROM VisitorToPlaces");
        $data2 = mysqli_query($conn, "
        SELECT visitor_name
        FROM Visitor V INNER JOIN VisitorToPlaces VTP
        ON V.device_ID = VTP.device_ID
        WHERE V.device_ID = VTP.device_ID");

        $data3 = mysqli_query($conn, "
        SELECT place_name
        FROM Places P INNER JOIN VisitorToPlaces VTP
        ON P.QRcode = VTP.QRcode
        WHERE P.QRcode = VTP.QRcode");
        ?>

        <table class="table" style="color: white;">

            <tr style="background-color: Green;">
                <th>Entry ID</th>
                <th>QR Code</th>
                <th>Device Id</th>
                <th>Entry date</th>
                <th>Entry time</th>
                <th>Exit date</th>
                <th>Exit time</th>
                <th>Name of Visitor</th>
                <th>Name of Place Visited</th>
            </tr>
            <?php
            while ($result = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td> <?php echo $result["entry_id"]; ?> </td>
                    <td> <?php echo $result["QRcode"]; ?> </td>
                    <td> <?php echo $result["device_ID"]; ?> </td>
                    <td> <?php echo $result["entry_date"]; ?> </td>
                    <td> <?php echo $result["entry_time"]; ?> </td>
                    <td> <?php echo $result["exit_date"]; ?> </td>
                    <td> <?php echo $result["exit_time"]; ?> </td>
                    <?php
                }
                while ($result = mysqli_fetch_assoc($data2)) { ?>
                        <td> <?php echo $result["visitor_name"]; ?> </td>
                    <?php
                    }
                    ?>
                <?php
                while ($result = mysqli_fetch_assoc($data3)) { ?>
                        <td> <?php echo $result["place_name"]; ?> </td>
                    <?php
                    }
                    ?>
                    </td>
                
                <?php

                ?>
        </table>
    </body>

    </html>

<?php
}
?>