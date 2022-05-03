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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Agent Portal</title>
        <style type="text/css">
            .ui-autocomplete-row {
                padding: 8px;
                background-color: #f4f4f4;
                border-bottom: 1px solid #ccc;
                font-weight: bold;
            }

            .ui-autocomplete-row:hover {
                background-color: #ddd;
            }
        </style>

    </head>

    <body background-color="black">

        <div class="search">
            <form action="visitor_result.php" method="POST">
                <h4 style="color: white; font-weight: bold;"> &nbsp; Search for Visitor:</h4>
                <input type="text" id="esearch" required="required" name="visitor_name" placeholder="Name of Visitor" autocomplete="off" style="width:10%;height:0.5%">
                <button type="submit" name="submit-search"> Search </button>
            </form>

            <script>
                $(document).ready(function() {
                    $('#esearch').autocomplete({
                        source: "visitor_fetch_data.php",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#esearch').val(ui.item.value);
                        }
                    }).data('ui-autocomplete')._renderItem = function(ul, item) {
                        return $("<li class='ui-autocomplete-row' style= \"color:white;background-color:green;cursor:pointer;border:2px solid white;width:10%\"></li>")
                            .data("item.autocomplete", item)
                            .append(item.label)
                            .appendTo(ul);
                    };
                });
            </script>

        </div>

        <button style="color:white;background-color:green;" class="submit"><a href="agency.php"> Go back</button>

        <h4 style="color: white; font-weight: bold;"> &nbsp; Registered Citizens</h4>

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
            if (isset($_POST['submit-search'])) {
                $visitor_name = array();
                $search1 = mysqli_real_escape_string($conn, $_POST['visitor_name']);
                $sql_search_query = "SELECT * FROM Visitor WHERE visitor_name LIKE '%$search1%'";
                $result = mysqli_query($conn, $sql_search_query);
                $search_query_result = mysqli_num_rows($result);

                echo "There are " . $search_query_result . " result(s)!";

                if ($search_query_result > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<a href='visitor_result.php?visitor_name=" . $row['visitor_name'] . "'><div class='visitor-box'>
                            <h3>" . $row['visitor_name'] . "</h3>
                        </a></div>";
                    }
                }
            }




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

    </body>

    </html>

<?php
}
?>