<?php
    session_start();
    include('config.php');
    if(isset($_REQUEST['action'])) {
        if($_REQUEST['action']=='sendMessage') {
            $prepGetUser = $pdo -> prepare('SELECT * FROM users WHERE usersname = ?');
            $prepGetUser -> execute(array($_SESSION['usersname']));
            $getUser = $prepGetUser -> fetch();
            $user = $getUser['id'];
            $prepInsert = $pdo -> prepare('INSERT INTO messages (users, messageText) VALUES (?, ?)');
            $prepInsert -> execute(array($user, $_REQUEST['message']));
        } else if($_REQUEST['action']=='getMessage') {
            $prepGetMessage = $pdo -> prepare('SELECT * FROM messages WHERE id > ?');
            $prepGetMessage -> execute(array($_REQUEST['latestId']));
            $messages = array();

            while($message = $prepGetMessage -> fetch()) {
                $prepGetUser = $pdo -> prepare('SELECT usersname FROM users WHERE id = ?');
                $prepGetUser -> execute(array($message['users']));
                $getUser = $prepGetUser -> fetch();
                $messages = array($message['messageText'], $message['id'], $getUser['usersname']);
            } 

            echo json_encode($messages);

            //$prepGetUser = $pdo -> prepare('SELECT * FROM user WHERE username = ?');
            //$prepGetUser -> execute(array($_SESSION['username']));
            //$getUser = $prepGetUser -> fetch();
        } 
    }

?>