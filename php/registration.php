<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid text-center mt-5">
        <div class="row justify-content-center">
            <form class="bg-secondary text-white p-5 fs-5" method="POST" action="" style="max-width: 400px;">
                <label>Username:</label><br>
                <input class="form-control" type="text" name="username" required><br>
                <label>E-Mail:</label><br>
                <input class="form-control" type="email" name="email" required><br>
                <label>Password:</label><br>
                <input class="form-control" type="password" name="password" required><br>
                <button type="submit" name="submit" class="btn btn-light">Create Account</button><br>
                <?php
                include('config.php');
                global $pdo;
                if (isset($_POST['submit'])) {
                    $uname_available = $pdo->prepare("SELECT count(*) AS count FROM users WHERE usersname = ?");
                    $uname_available->bindValue(1, $_POST['username']);
                    $uname_available->execute();
                    $email_available = $pdo->prepare("SELECT count(*) AS count FROM users WHERE email = ?");
                    $email_available->bindValue(1, $_POST['email']);
                    $email_available->execute();
                    $urow = $uname_available->fetch();
                    $erow = $email_available->fetch();
                    if ($urow['count'] == 1 && $erow['count'] == 1) {
                        echo '<span class="text-danger">Username and Email already taken!</span>';
                    } else if ($urow['count'] == 1) {
                        echo '<span class="text-danger">Username already taken!</span>';
                    } else if ($erow['count'] == 1) {
                        echo '<span class="text-danger">Email already taken!</span>';
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO users (usersname,email,password) VALUES (?,?,?)");
                        $stmt->bindValue(1, $_POST['username']);
                        $stmt->bindValue(2, $_POST['email']);
                        $stmt->bindValue(3, password_hash($_POST['password'], PASSWORD_DEFAULT));
                        $stmt->execute();
                        header("Location: registration_confirm.php");
                    }
                }
                ?>
                <br>
                <label><a href="login.php" class="link-info" style="text-decoration: none">Already have an account?</a></label>
            </form>
        </div>
    </div>
</body>

</html>