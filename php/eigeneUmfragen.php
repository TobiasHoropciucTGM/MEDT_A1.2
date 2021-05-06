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


    <div class="container-fluid text-center">
        <?php 
            $pdo = new PDO('mysql:host=localhost;dbname=MEDTA12', 'root', '');        
            function getCreatorID(){
                GLOBAL $pdo;
                $stmt = $pdo->prepare("SELECT id as id FROM users WHERE usersname= ?");
                $stmt->execute(array($_SESSION['usersname']));
                $id = $stmt->fetch();
                return $id['id'];
            }
            $stmt = $pdo->prepare("SELECT pollTitle FROM poll WHERE pollCreatorID = ?");
            $stmt->execute(array(getCreatorID()));
            while($row = $stmt->fetch()){
                ?>
                    <div class="row m-1 justify-content-center">
                        <div class="col-2 umfrageName column"><?=$row['pollTitle']?></div>
                        <div class="col-2 column"><button class="optionen">Ergebnisse</button></div>
                        <div class="col-2 column"><button class="optionen">veröffentlichen</button></div>
                    </div>
                <?php
            }
        ?>
    </div>
</body>
<style>
    .umfrageName{
        color: blue;
        font-size: 28px;
    }
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
