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
                    <li class="nav-item"><a class="nav-link active" href="eigeneUmfragen.php">Eigene Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link" href="umfragen.php">Alle Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid ">
        <?php 
            include('config.php');
            include('voteFunc.php');
            global $pdo;
            $stmt = $pdo->prepare("SELECT pollTitle, id FROM poll WHERE pollCreatorID = ?");
            $stmt->execute(array(getUserID()));
            while($row = $stmt->fetch()){
                ?>
                    <div class="row m-1 justify-content-center">
                        <div class="col-5 column"><h4><?=$row['pollTitle']?></h4></div>
                        <div class="col-2 column text-center"><a href="ergebnis.php?pollResultSelected=<?=$row['id']?>"><button class="optionen">Ergebnis</button></a></div>
                        <div class="col-2 column text-center"><a href="eigeneUmfragen.php?ver??ffentlichen=true&poll=<?=$row['id']?>"><button class="optionen">ver??ffentlichen</button></a></div>
                    </div>
                <?php
            }
            if(isset($_GET['ver??ffentlichen'])){
                $stmt = $pdo->prepare("UPDATE poll SET public=1 WHERE id = ?");
                $stmt->execute(array($_GET['poll']));
            }
        ?>
    </div>
</body>
<style>
    .optionen{
        border: 2px black solid;
        background-color: white;
        font-size: 22px;
        border-radius: 4px;
    }
    .column{
        margin-top: 12px;
    }
</style>
</html>
