<?php

    session_start();
    if (!isset($_SESSION['user_visitor'])) {
        header('Location: registerForm_visitor.php');
        
    } else {
    $device_Id = $_SESSION['user_visitor'];
?>

    <html>
    <head>
        <?php include 'header.php'; ?>
        <title><?php echo $_SESSION['user_name']?> - Visitor Portal</title>
    </head>

    <body>
    <?php include 'navbar.php';?>
    <?php include 'config.php';?>

    <h1 style="color: white; font-weight: bold;">
        All Visits
    </h1>

    <table class="table" style="color: white;">
        <tr style="background-color: Green;">
            <th>Place Name</th>
            <th>Entry Date</th>
            <th>Entry Time</th>
            <th>Exit Date</th>
            <th>Exit Time</th>
            <th>Action</th>
        </tr>

        <?php 
            /* SQL Commands to Fetch Data*/ 

            $data = mysqli_query($conn, "SELECT Places.place_name, VisitorToPlaces.entry_date, VisitorToPlaces.entry_time, VisitorToPlaces.exit_time, VisitorToPlaces.exit_date FROM Places 
                                        INNER JOIN VisitorToPlaces WHERE Places.QRcode = VisitorToPlaces.QRCode 
                                        AND VisitorToPlaces.device_ID ='$device_Id'");
        
            while ($result = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td> <?php echo $result["place_name"]; ?> </td>
                <td> <?php echo $result["entry_date"]; ?> </td>
                <td> <?php echo $result["entry_time"]; ?> </td>
                
                <?php
                    if (!empty($result["exit_time"])) { ?>
                        <td> <?php echo $result["exit_date"]; ?> </td>
                        <td> <?php echo $result["exit_time"]; ?> </td>
                        <td> <?php echo 'Checked Out'; ?> </td>
                    <?php }  else { ?>
                        <td><?php echo 'pending';?></td>
                        <td><?php echo 'pending';?></td>
                        <form method="POST">
                            <td><input type="submit" name="checkout" value="Check Out" style="background-color: CadetBlue;"></td>
                        </form>  
                        
                        <?php
                            $place_name = $result["place_name"];
                            $entry_date = $result["entry_date"];
                            $entry_time = $result["entry_time"];


                            $entry_id_result = mysqli_query($conn, "SELECT entry_id FROM Places JOIN VisitorToPlaces WHERE VisitorToPlaces.device_ID ='$device_Id' AND Places.place_name = '$place_name' AND VisitorToPlaces.entry_time = '$entry_time' AND VisitorToPlaces.entry_date = '$entry_date'");
                            $entry_id_field = mysqli_fetch_assoc($entry_id_result);
                            $entry_id_data = $entry_id_field["entry_id"];

                            $exitdate = date("Y-m-d");
                            date_default_timezone_set("Europe/Berlin");
                            $exittime = date("H:i:s");
                            
                            if (isset($_POST['checkout'])) {
                                    $sql_query = "UPDATE VisitorToPlaces SET exit_date = '$exitdate', exit_time = '$exittime' WHERE entry_id = '$entry_id_data' AND entry_date = '$entry_date' AND entry_time = '$entry_time'";
                            
                                    if (mysqli_query($conn, $sql_query)) {
                                        header('Location: visitor.php');
                                    } else {
                                        header('Location: index.html');
                                    }
                            }
                        ?>
                    <?php } 
                ?>
            </tr>
        <?php } ?>

            

    </table>



</body>
    </html>

<?php
}
?>
