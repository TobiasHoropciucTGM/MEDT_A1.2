<?php
    session_start();
    include('config.php');
    if(isset($_REQUEST['action'])) {
        if($_REQUEST['action']=='sendMessage') {
            $prepGetUser = $pdo -> prepare('SELECT * FROM user WHERE username = ?');
            $prepGetUser -> execute(array($_SESSION['username']));
            $getUser = $prepGetUser -> fetch();
            $user = $getUser['id'];
            $prepInsert = $pdo -> prepare('INSERT INTO nachrichten (user, nachricht) VALUES (?, ?)');
            $prepInsert -> execute(array($user, $_REQUEST['message']));
        } else if($_REQUEST['action']=='getMessage') {
            $prepGetMessage = $pdo -> prepare('SELECT * FROM nachrichten WHERE id > ?');
            $prepGetMessage -> execute(array($_REQUEST['latestId']));
            $messages = array();

            while($message = $prepGetMessage -> fetch()) {
                $prepGetUser = $pdo -> prepare('SELECT username FROM user WHERE id = ?');
                $prepGetUser -> execute(array($message['user']));
                $getUser = $prepGetUser -> fetch();
                $messages = array($message['nachricht'], $message['id'], $getUser['username']);
            } 

            echo json_encode($messages);

            //$prepGetUser = $pdo -> prepare('SELECT * FROM user WHERE username = ?');
            //$prepGetUser -> execute(array($_SESSION['username']));
            //$getUser = $prepGetUser -> fetch();
        } 
    }

?>