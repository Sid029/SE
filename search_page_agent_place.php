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


            <form action="place_result.php" method="POST">
                <h4 style="color: white; font-weight: bold;"> &nbsp; Search for Establishment:</h4>
                <input type="text" id="esearch2" required="required" name="place_name" placeholder="Name of Place" autocomplete="off" style="width:10%;height:0.5%">
                <button type="submit" name="submit-search"> Search </button>
            </form>

            <script>
                $(document).ready(function() {
                    $('#esearch2').autocomplete({
                        source: "place_fetch_data.php",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#esearch2').val(ui.item.value);
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

        <h4 style="color: white; font-weight: bold;"> &nbsp; Registered Establishments</h4>

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
    </body>

    </html>

<?php
}
?>