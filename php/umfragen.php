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

    <div class="container-fluid">
        <?php 
            include('config.php');
            $stmt = $pdo->prepare("SELECT pollTitle as polls FROM poll");
            $stmt->execute();
            while($row = $stmt->fetch()){
                ?>
                <div class="row justify-content-center reihe">
                    <div class="col-5 umfrage"><<?=$row['polls']?></div>
                    <div class="col-1 option text-center">teilnehmen</div>
                    <div class="col-2 option text-center">anonym teilnehmen</div>
                    <div class="col-1 option text-center"><a href="umfragen.php?pollSelected=<?=$row['polls']?>">Ergebnisse</a></div>
                </div>
                <?php
            }
            if(isset($_GET['pollSelected'])){
                $_SESSION['pollSelected']=$_GET['pollSelected'];
                echo $_SESSION['pollSelected'];
                    header("Location: umfrageErgebnis.php");
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

    </style>
</body>
</html>
