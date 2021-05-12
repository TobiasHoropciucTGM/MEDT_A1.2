<?php
    session_start();
    include('config.php');
    if(isset($_REQUEST['action'])) {
        if($_REQUEST['action']=='sendMessage') {
            if (!trim($_REQUEST['message']) == "") {
                $prepGetUser = $pdo -> prepare('SELECT * FROM users WHERE usersname = ?');
                $prepGetUser -> execute(array($_SESSION['usersname']));
                $getUser = $prepGetUser -> fetch();
                $user = $getUser['id'];
                $prepInsert = $pdo -> prepare('INSERT INTO messages (users, messageText) VALUES (?, ?)');
                $prepInsert -> execute(array($user, $_REQUEST['message']));
            }
            
        } else if($_REQUEST['action']=='getMessage') {
            $prepGetMessage = $pdo -> prepare('SELECT * FROM messages WHERE id > ?');
            $prepGetMessage -> execute(array($_REQUEST['latestId']));
            $temp = array();
            $messages = array();
            $ret = array();
            $i = 0;

            while($temp = $prepGetMessage -> fetch()) {
                $prepGetUser = $pdo -> prepare('SELECT usersname FROM users WHERE id = ?');
                $prepGetUser -> execute(array($temp['users']));
                $getUser = $prepGetUser -> fetch();
                $ret[$i] = array($temp['messageText'], $temp['id'], $getUser['usersname']);
                $i = $i +1;
            } 

            $messages = array($ret, $_SESSION['usersname']);

            echo json_encode($messages);
            

            //$prepGetUser = $pdo -> prepare('SELECT * FROM user WHERE username = ?');
            //$prepGetUser -> execute(array($_SESSION['username']));
            //$getUser = $prepGetUser -> fetch();
        } else if($_REQUEST['action']=='getUser') {
            echo json_encode($_SESSION['usersname']);
        }
    }

?>