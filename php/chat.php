<html>
    <head>
        <meta charset="utf-8">
        <title>test</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <!-- Bootstrap -->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
        <!-- CSS only -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        
        
    </head>
    <body>
        <!-- Navigationsleiste -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <div class="container">
                <div id="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="#">Chat</a></li>
                        <li class="nav-item"><a class="nav-link" href="UmfrageErstellen.php">Umfrage erstellen</a></li>
                        <li class="nav-item"><a class="nav-link" href="eigeneUmfragen.php">Eigene Umfragen</a></li>
                        <li class="nav-item"><a class="nav-link" href="umfragen.php">Alle Umfragen</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">LogOut</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        

        <!--  -->
        <div id="chat" class="container">
            <div id="chat-mes" class="scrollable-panel" style="word-wrap: break-word;  ">
                <?php
                
                    include('config.php');
                    session_start();
                    global $pdo;
                    $mes = $pdo -> prepare("SELECT * FROM messages");
                    $mes -> execute();
                    $user = $pdo -> prepare("SELECT * FROM users WHERE id = ?");
                    
                    while($message = $mes -> fetch()) {
                        $userid = $message['users'];
                        $user -> execute(array($userid));
                        $userf = $user -> fetch();
                        if(strcmp($userf['usersname'], $_SESSION['usersname']) == 0) {
                            echo "<h2 style='text-align:right;margin-bottom:0;' id='".$message['id']."'>".$message['messageText']."</h2>";
                            echo "<h5 class='usern' style='text-align:right;margin-top:0;' >".$userf['usersname']."</h5>";
                        } else {
                            echo "<h2 style='text-align:left;margin-bottom:0;' id='".$message['id']."'>".$message['messageText']."</h2>";
                            echo "<h5 style='text-align:left;margin-top:0;' class='usern'>".$userf['usersname']."</h5>";
                        }
                    } 

                ?>
            </div>
            <div class="col-12">
                <form style="display: block;margin-left: auto;margin-right: auto;" class="col-1" action="" method="POST">
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