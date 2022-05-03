<?php
session_start();
if (!isset($_SESSION['user_visitor'])) {
    header('Location: index.html');
} else {
?>
    <html>
    <head>
    <?php include 'header.php' ?>
        <?php include 'navbar.php' ?>
        <?php include 'config.php' ?>
        <title><?php echo $_SESSION['user_name']?> - Account Information</title>
        </head>

  <body background-color="black">
  <?php
  $device_ID = $_SESSION['user_visitor'];
  $data = mysqli_query($conn, "SELECT * FROM Visitor WHERE device_ID = '$device_ID'");

  ?>

  <h3 style="color: white; font-weight: bold;"> Account Information </h3>

  <table class="table" style="color: white;">
            <tr style="background-color: Green;">
                <th>Name</th>
                <th>Address</th>
                <th>Phone number</th>
                <th>Email</th>
                <th>Infected</th>
            </tr>
            <?php while ($result = mysqli_fetch_assoc($data)) { ?>
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
 

  </div>



</body>
    </html>

<?php
}
?>
