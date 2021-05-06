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
      <a class="navbar-brand" href="#">MEDT A1.2</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#">Chat</a></li>
      <li><a class="active"href="#">Umfrage Erstellen</a></li>
      <li><a href="#">eigene Umfragen</a></li>
      <li><a href="#">alle Umfragen</a></li>
    </ul>
  </div>
</nav>
    <div class="container-fluid">
        <div class="text-center">
            <form action="" method="post">
                <label><p style="color: blue">Umfrage Titel</p></label><br>
                <input type="text" name="uumfrageTitle"><br><br>
                <label>1. Frage</label><br>
                <input type="text" name="frage1"><br><br>
                <label>2. Frage</label><br>
                <input type="text" name="frage2"><br><br>
                <label>3. Frage</label><br>
                <input type="text" name="frage3"><br><br>
                <input type="submit" value="Umfrage erstellen">
            </form>
        </div>
    </div>
    <?php 
        $db = new PDO('mysql:host=localhost; dbname=MEDTA12', "root" , "" );
        $pollTitle = $_POST['umfrageTitle'];
        $pollCreatorID;
        $stmt = db->prepare("SELECT id FROM users WHERE usersname = ?");
        stm

        $statement->execute(array(null, 'umfrage1' , 12332));
?>
</body>
</html>
