<?php
include('config.php');
function getAnswers($questionID, $yesOrNoAnswers)
{
    global $pdo;
        $stmt = $pdo->prepare("SELECT vote, usersID, anonym, users.usersname as username FROM votes 
                                LEFT JOIN users on users.id=usersID WHERE questionID=? AND vote=?");
    if ($yesOrNoAnswers == "y") {
        $stmt->execute(array($questionID, 1));
    } else {
        $stmt->execute(array($questionID, 0));
    }
    $answers = array();
    while ($row = $stmt->fetch()) {
        if ($row['anonym'] == 1) {
            $answers[]= "anonym";
        } else {
            $answers[]= $row['username'];
        }
    }
    return $answers;
}

function answersToString($answers)
{
    $string = "";
    for ($i = 0; $i < sizeof($answers); $i++) {
        $string .= $answers[$i] . ",";
    }
    return $string;
}
?>