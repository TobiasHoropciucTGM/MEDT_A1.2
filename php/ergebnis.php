<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    </head>
    <body>
        <div class="contaner-fluid">
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
                        <div class="col-4 text-center">Frage</div>
                        <div class="col-3 text-center">Ja</div>
                        <div class="col-3 text-center">Nein</div>
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
                            <div class="col-4 text-center"><?=$frage?></div>
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