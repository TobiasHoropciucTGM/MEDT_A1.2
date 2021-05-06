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
        <h1>Chat</h1>
        
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
            <div id="chat-mes" class="">
                <?php
                    include('config.php');
                    $mes = $pdo -> prepare("SELECT * FROM messages");
                    $mes -> execute();
                    $user = $pdo -> prepare("SELECT * FROM users WHERE id = ?");
                    
                    while($message = $mes -> fetch()) {
                        $userid = $message['users'];
                        $user -> execute(array($userid));
                        $userf = $user -> fetch();
                        echo "<h2 id='".$message['id']."'>".$message['messageText']." von: ".$userf['usersname']."</h2>";
                    } 

                ?>
            </div>
            <form action="" method="POST">
                <textarea class="mesarea" id="messageArea" name="messageArea"></textarea>
            </form>  
        </div>

        <script src="../js/reload.js"></script>
        <script src="../js/message.js"></script>
    </body>
</html>