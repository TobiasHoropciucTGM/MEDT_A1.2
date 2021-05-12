<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Umfrage Website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <!-- CSS only -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="login.php">MEDT A1.2</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="chat.php">Chat</a></li>
      <li><a class="active"href="#">Umfrage Erstellen</a></li>
      <li><a href="eigeneUmfragen.php">eigene Umfragen</a></li>
      <li><a href="umfragen.php">alle Umfragen</a></li>
    </ul>
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
