<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
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
                        <li class="nav-item"><a class="nav-link" href="umfragen.php">Alle Umfragen</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="contaner-fluid" style="margin-top: 40px">
            <?php
                include('config.php');
                include('ergebnisFunc.php');
                global $pdo;
                $stmt = $pdo->prepare("SELECT public FROM poll WHERE id=?");
                $stmt->execute(array($_GET['pollResultSelected']));
                $row = $stmt->fetch();
                if ($row['public'] == 0){
                    ?>
                    <div class="row" style="color: red">
                        <div class="col text-center">Ergebnisse für diese Umfrage sind noch nicht verfügbar.</div>
                    </div>
                <?php
                } else {
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-4 text-center"><h3>Frage</h3></div>
                        <div class="col-3 text-center"><h3>Ja</h3></div>
                        <div class="col-3 text-center"><h3>Nein</h3></div>
                    </div>
                    <?php
                    $stmt = $pdo->prepare("SELECT question, id FROM questions WHERE pollID=?");
                    $stmt->execute(array($_GET['pollResultSelected']));
                    while ($row = $stmt->fetch()){
                        $frage = $row['question'];
                        $jaAntworten = answersToString(getAnswers( $row['id'], "y"));
                        $neinAntworten = answersToString(getAnswers($row['id'], "n"));
                    ?>
                        <div class="row justify-content-center">
                            <div class="col-4 text-center"><h6><?=$frage?></h6></div>
                            <div class="col-3 text-center"><?=$jaAntworten?></div>
                            <div class="col-3 text-center"><?=$neinAntworten?></div>
                        </div>
                    <?php
                    }
                }
            ?>
        </div>
    </body>
</html>