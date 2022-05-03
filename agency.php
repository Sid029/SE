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

            <?php while ($result = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td> <?php echo $result["h_username"]; ?> </td>
                    <td> <?php echo $result["h_password"]; ?> </td>
                    <td> <?php if ($result["authorize"] == 0) {
                                echo "no";
                            } else {
                                echo "yes";
                            }; ?>                        
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </body>

    </html>

<?php
}
?>