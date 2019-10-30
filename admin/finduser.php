
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

</head>

<body>
    <div class="container">
        <h1>Vind een gebruiker</h1>
        <br>
        <h2>Zoek op:</h2>
        <form method="GET" action="userlist.php" >
            <div class="form-group">
                Username: <input type="text" class="form-control" name="username" >
            </div>
            <div class="form-group">
                Voornaam:<input type="text" class="form-control" name="first_name">
            </div>
            <div class="form-group">
                Achternaam:<input type="text" class="form-control" name="last_name">
            </div>
            <input class="btn btn-primary" type="submit" value="Verstuur">

        </form>
        <br>
        <a href="admin.php" class="btn btn-info" role="button">Terug naar admin pagina</a>
    </div>
</body>

</html>