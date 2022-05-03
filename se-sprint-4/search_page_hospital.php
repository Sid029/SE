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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Hospital Portal</title>
    <style type="text/css">
        .ui-autocomplete-row {
            text-decoration: none;
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

    <div class="search">
        <form action="visitor_result_hospital.php" method="POST">
            <h4 style="color: white; font-weight: bold;"> &nbsp; Search for Visitor:</h4>
            <input type="text" id="esearch" required="required" name="visitor_name" placeholder="Name of Visitor" autocomplete="off" style="width:10%;height:0.5%">
            <button type="search" name="search"> Search </button>
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

    <body background-color="black">
    <button style="color:white;background-color:green;" class="submit"><a href="hospital.php"> Go back</button>

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