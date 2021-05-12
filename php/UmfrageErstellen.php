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

</head>
<body>
<nav class="navbar navbar-expand navbar-light bg-light">
    <div class="container">
        <div id="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="chat.php">Chat</a></li>
                <li class="nav-item"><a class="nav-link active"  href="UmfrageErstellen.php">Umfrage erstellen</a></li>
                <li class="nav-item"><a class="nav-link" href="eigeneUmfragen.php">Eigene Umfragen</a></li>
                <li class="nav-item"><a class="nav-link" href="umfragen.php">Alle Umfragen</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container-fluid">
        <div class="text-center">
            <form action="" method="post">
                <label><h2 style="color: blue">Umfrage Titel</h2></label><br>
                <input type="text" name="umfrageTitle"><br><br>
                <label>1. Frage</label><br>
                <input type="text" name="frage1"><br><br>
                <label>2. Frage</label><br>
                <input type="text" name="frage2"><br><br>
                <label>3. Frage</label><br>
                <input type="text" name="frage3"><br><br>
                <input type="submit" name="submit" value="Umfrage erstellen">
            </form>
        </div>
    </div>
    <?php 
      include('config.php');
      global $pdo;
      if(isset($_POST['submit'])){
        $stmt = $pdo->prepare("SELECT id FROM users WHERE usersname = ?");
        $stmt->bindValue(1, $_SESSION['usersname']);
        $stmt->execute();
        $result = $stmt->fetch();
        $creatorID = $result['id'];
        $stmt = $pdo->prepare("SELECT count(*) AS count FROM poll WHERE pollTitle = ? AND pollCreatorID = ?");
        $stmt->bindValue(1,$_POST['umfrageTitle']);
        $stmt->bindValue(2,$creatorID);
        $stmt->execute();
        $count =  $stmt->fetch();
        if($count['count'] == 0){
          $stmt = $pdo->prepare("INSERT INTO poll VALUES(null,?,?,?)");
          $stmt->bindValue(1,$_POST['umfrageTitle']);
          $stmt->bindValue(2, $creatorID);
          $stmt->bindValue(3, 0);
          $stmt->execute();

          $stmt = $pdo->prepare("SELECT id FROM poll WHERE pollTitle = ? AND pollCreatorID = ?");
          $stmt->bindValue(1,$_POST['umfrageTitle']);
          $stmt->bindValue(2,$creatorID);
          $stmt->execute();
          $pollID = $stmt->fetch();
          $stmt = $pdo->prepare("INSERT INTO questions VALUES(null,?,?)");
          $stmt->bindValue(1,$_POST['frage1']);
          $stmt->bindValue(2,$pollID['id']);
          $stmt->execute();
          $stmt->bindValue(1,$_POST['frage2']);
          $stmt->bindValue(2,$pollID['id']);
          $stmt->execute();
          $stmt->bindValue(1,$_POST['frage3']);
          $stmt->bindValue(2,$pollID['id']);
          $stmt->execute();
          unset($_POST['submit']);
        }else{
          ?><div class="container-fluid">
              <div class="text-center" style="color:red; margin-top:10px">Sie haben schon eine Umfrage mit dem selben Titel.</div>
            </div>
          <?php  
        }
      }
?>
</body>
</html>
