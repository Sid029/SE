<?php
    session_start();
    if (!isset($_SESSION['user_agent'])) {
        header('Location: login_a.php');
    } else {
    //
    }
?>


<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Corona</title>
</head>

<?php include 'header.php' ?>
        <?php include 'navbar.php' ?>
        <?php include 'config.php' ?>
 
<body>
        <?php
            require('config.php');
            $title = mysqli_real_escape_string($conn, $_POST['visitor_name']);
            $sql_query1 = "SELECT * FROM Visitor WHERE visitor_name='$title'";
            $result1 = mysqli_query($conn, $sql_query1);
            $sql_query_result1 = mysqli_num_rows($result1);

            if ($sql_query_result1 > 0) {
                while ($row = mysqli_fetch_assoc($result1)) {
                    echo "<h1 style='color:white;'>Information of the Person Searched:</h1>
                    <button style=\"color:white;background-color:green;\" class=\"submit\"><a href=\"search_page_agent_visitor.php\"> Go back</button>
                    <table class =\"table\">

                    <tr style='background-color: Green;color:white;text-align:center;'>
                        <th><p>Visitor Name</th></p>
                        <th><p>Address</th></p>
                        <th><p>Phone</th></p>
                        <th><p>Email</th></p>
                        <th><p>Infected</th></p>
                    </tr>

                    <tr style='color:white;'>
                        <td><p>".$row['visitor_name']."</td></p>
                        <td><p>".$row['visitor_address']."</td></p>
                        <td><p>".$row['phone_number']."</</td></p>
                        <td><p>".$row['email']."</</td></p>
                        <td><p>".$row['infected']."</</td></p>
                    </tr>

                    </table>";
                }
            }
            else
            {
                echo 'There are no results matching your search';
            }
        ?>
</body>
</html>