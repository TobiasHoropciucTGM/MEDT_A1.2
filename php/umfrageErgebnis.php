<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Umfrage Website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container">
            <div id="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="chat.php">Chat</a></li>
                    <li class="nav-item"><a class="nav-link"  href="UmfrageErstellen.php">Umfrage erstellen</a></li>
                    <li class="nav-item"><a class="nav-link" href="eigeneUmfragen.php">Eigene Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link" href="umfragen.php">Alle Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center">
            
        <?php 
            include('config.php');
            echo $_SESSION['pollResultSelected'];

        ?>
    </div>
</body>

</html>
