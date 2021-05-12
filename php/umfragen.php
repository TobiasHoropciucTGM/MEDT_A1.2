<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Umfrage Website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container">
            <div id="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="chat.php">Chat</a></li>
                    <li class="nav-item"><a class="nav-link"  href="UmfrageErstellen.php">Umfrage erstellen</a></li>
                    <li class="nav-item"><a class="nav-link" href="eigeneUmfragen.php">Eigene Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link  active" href="umfragen.php">Alle Umfragen</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <?php 
            include('config.php');
            global $pdo;
            $stmt = $pdo->prepare("SELECT pollTitle as poll , id as id FROM poll");
            $stmt->execute();
            while($row = $stmt->fetch()){
                ?>
                <div class="row justify-content-center reihe">
                    <div class="col-5 umfrage"><?=$row['poll']?></div>
                    <div class="col-1 option text-center"><a href="vote.php?teilnehmen=<?=$row['id']?>">teilnehmen</a></div>
                    <div class="col-2 option text-center"><a href="vote.php?teilnehmenA=<?=$row['id']?>">anonym teilnehmen</a> </div>
                    <div class="col-1 option text-center"><a href="ergebnis.php?pollResultSelected=<?=$row['id']?>">Ergebnisse</a></div>
                </div>
                <?php
            }
        ?>
    </div>
    <style>
        .reihe{
            margin-top: 12px;
        }
        .umfrage{
            font-size: 24px;
        }
        .option{
            border: 2px black solid;
            background-color: white;
            font-size: 22px;
            border-radius: 4px;
            margin: 10px;
            
        }
        a{
            color: #1144FF;
            text-decoration: none;
        }
    </style>
</body>
</html>
