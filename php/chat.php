<html>
    <head>
        <meta charset="utf-8">
        <title>test</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
                integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </head>
    <body>
        <h1>Chat</h1>

        <div id="chat" class="container">
            <div id="chat-mes" class="">
                <?php
                    include('config.php');
                    session_start();
                    $_SESSION['username'] = 'Sebi';
                    $mes = $pdo -> prepare("SELECT * FROM nachrichten");
                    $mes -> execute();
                    $user = $pdo -> prepare("SELECT * FROM user WHERE id = ?");
                    
                    while($message = $mes -> fetch()) {
                        $userid = $message['user'];
                        $user -> execute(array($userid));
                        $userf = $user -> fetch();
                        echo "<h2 id='".$message['id']."'>".$message['nachricht']." von: ".$userf['username']."</h2>";
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