<?php
require 'checkifdbexists.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kletskoek</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            if(!<?= json_encode(kletskoekExists()) ?>) {
                $(".menu").hide();
            }
            $("#createdb").click(function() {
                $.get("createdb.php", function(data, status) {
                    $("#message").text(data);
                });
            });

        });
    </script>

</head>

<body>

    <div class="container">

        <h1>Admin Pagina</h1>

        <p><b>Maak een keuze:</b>
            <p>

                <div class="list-group menu">
                    <a href="createuser.php" class="list-group-item list-group-item-info">Voeg gebruiker toe</a>
                    <a href="finduser.php" class="list-group-item list-group-item-info">Zoek gebruiker</a>
                </div>
                <br>
                <button id="createdb" class="button btn-info">Maak database aan</button>
                <p style="font-weight: bold" id="message"></p>


    </div>

</body>

</html>