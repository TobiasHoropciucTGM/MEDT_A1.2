<!DOCTYPE html>
<?php 
    session_start();
?>
<html>
    <head>
        <title>Login</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid text-center mt-5">
            <div class="row justify-content-center">
                <form class="bg-secondary text-white p-5 fs-5" method="POST" action="" style="max-width: 400px;">
                    <label>Username: </label><br>
                    <input class="form-control" type="text" name="username" required><br>
                    <label>Password:</label><br>
                    <input class="form-control" type="password" name="password" required><br>
                    <button class="btn btn-light" type="submit" name="submit">Login</button><br>
                    <?php 
                        if(isset($_POST['submit']) && isset($_POST['username'])){
                            $dbconnection = new PDO("mysql:host=localhost;dbname=medt","tobi", "tobi");
                            $stmt = $dbconnection->prepare("SELECT password FROM user_accounts WHERE username=?");
                            $stmt->bindValue(1, $_POST['username']);
                            $stmt->execute();
                            $row = $stmt->fetch();
                            if($row != null){
                                if(password_verify($_POST['password'], $row['password'])){
                                    $_SESSION['username'] = $_POST['password'];
                                    header("Location: index.php");
                                }else{
                                    echo '<span class="text-danger">Wrong password!</span>';
                                }
                            }else{
                                echo '<span class="text-danger">Username not found!</span>';
                            }
                        }
                    ?>
                    <br>
                    <label><a href="registration.php" class="link-info" style="text-decoration: none">Don't have an account yet?</a></label>
                </form>
            </div>
        </div>
    </body>
</html>