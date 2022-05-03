<?php
session_start();
if (!isset($_SESSION['user_agent'])) {
    header('Location:agency.php');
} else {
?>

    <html>

    <head>

        <?php include 'header.php' ?>
        <?php include 'navbar.php' ?>
        <?php include 'config.php' ?>
        <title>Agent Portal</title>

    </head>

    <button style="color:white;background-color:green;" class="submit"><a href="agency.php"> Go back</button>

    <body background-color="black">

        <h4 style="color: white; font-weight: bold;"> Hospitals</h4>

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
                            <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $result["hospital_id"]; ?>">
                            <input type="hidden" name="status" value="<?php echo $result["authorize"]; ?>">
                            <button id="submit" type="submit" name="submit" style="text-align:center; background-color: green;">Change Authorize Status</button>
                        </form>
                    </td>
                </tr>
            <?php
                if (isset($_POST['submit'])) {
                    $id = $_POST['id'];
                    if ($_POST['status'] == 0) {
                        $command = "UPDATE Hospital SET authorize=1 WHERE hospital_id='$id';";
                        mysqli_query($conn, $command);
                    } else {
                        $command = "UPDATE Hospital SET authorize=0 WHERE hospital_id='$id';";
                        mysqli_query($conn, $command);
                    };
                    header("Location: agent_hospital_authorize.php");
                }
            }
            ?>
        </table>
    </body>

    </html>

<?php
}
?>