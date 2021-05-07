<html>
    <head>
        <meta charset="utf-8">
        <title>test</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <!-- Bootstrap -->
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
            <li><a class="active"href="#">Chat</a></li>
            <li><a href="UmfrageErstellen.php">Umfrage Erstellen</a></li>
            <li><a href="#">Umfragen</a></li>
            <li><a href="logout.php">LogOut</a></li>
            </ul>
        </div>
        </nav>

        <div id="chat" class="container">
            <div id="chat-mes" class="scrollable-panel">
                <?php
                
                    include('config.php');
                    session_start();    
                    $mes = $pdo -> prepare("SELECT * FROM messages");
                    $mes -> execute();
                    $user = $pdo -> prepare("SELECT * FROM users WHERE id = ?");
                    
                    while($message = $mes -> fetch()) {
                        $userid = $message['users'];
                        $user -> execute(array($userid));
                        $userf = $user -> fetch();
                        if(strcmp($userf['usersname'], $_SESSION['usersname']) == 0) {
                            echo "<h2 style='text-align:right' id='".$message['id']."'>".$message['messageText']." von: ".$userf['usersname']."</h2>";
                        } else {
                            echo "<h2 style='text-align:left' id='".$message['id']."'>".$message['messageText']." von: ".$userf['usersname']."</h2>";
                        }
                    } 

                ?>
            </div>
            <div class="col-7">
                <form style="text-align: center" class="col-5" action="" method="POST">
                    <textarea style="text-align: center" class="mesarea" id="messageArea" name="messageArea"></textarea>
                </form>
            </div>
        </div>
        <script>
            var messageBody = document.querySelector('#chat-mes');
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        </script> 
        <script src="../js/reload.js"></script>
        <script src="../js/message.js"></script>
    </body>
</html>