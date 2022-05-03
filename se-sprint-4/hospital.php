<?php
session_start();
if (!isset($_SESSION['user_hospital'])) {
    header('Location: login_h.php');
} else {
?>

    <html>

    <?php include 'header.php' ?>
    <?php include 'navbar.php' ?>
    <?php include 'config.php' ?>
    <title>Hospital Portal</title>
    </head>

    <div class="search">
        <form action="search_page_hospital.php" method="POST">
            <button style="color: black; font-weight: bold;" a href="search_page_hospital.php">Search for Visitor</button>
        </form>
    </div>

    <body background-color="black">

        <h4 style="color: white; font-weight: bold;"> &nbsp; Registered Citizens</h4>
        <br>

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
            $counter = 0;
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
                            }; ?>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $result["visitor_id"]; ?>">
                            <input type="hidden" name="email" value="<?php echo $result["email"]; ?>">
                            <input type="hidden" name="status" value="<?php echo $result["infected"]; ?>">
                            <button id="change" type="submit" name="submit" style="background-color: CadetBlue;">Change</button>
                        </form>
                    </td>
                </tr>
            <?php
                if (isset($_POST['submit'])) {
                    $id = $_POST['id'];
                    $email = $_POST['email'];
                    if ($_POST['status'] == 0) {
                        $command = "UPDATE Visitor SET infected=1 WHERE visitor_id='$id';";
                        $subject = 'CAUTION!!!';
                        $message = "You are marked as infected!";
                        $headers = "From: (Your Gmail Account)@gmail.com"; //You need to put ur gmail here!
                        if($counter==0)
                        {
                            $mail_sent = mail($email, $subject, $message, $headers);
                        }
                        else{
                            //
                        }
                        mysqli_query($conn, $command);
                    } else {
                        $command = "UPDATE Visitor SET infected=0 WHERE visitor_id='$id';";

                        mysqli_query($conn, $command);

                    };
                    header("Location:hospital.php");
                }
                $counter++;
            }
            ?>
        </table>
    </body>

    </html>

<?php
}
?>