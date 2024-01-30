<?php 
    require_once ("connectDb.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<form action="login.php" method="post">
    <h1>Login</h1>
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <?php 
        $emailAccess = false;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                
                $stmt = $pdo->prepare('SELECT email FROM `user`');
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($result[0]['email']);
                for ($i=0; $i < count($result); $i++) { 
                    
                    if ($_POST['email'] === $result[$i]['email']) {
                        # code...
                        $emailAccess = true;
                        
                    }
                    
                }
                
                // var_dump($email);
                if ($emailAccess) {
                    $stmt = $pdo->prepare("SELECT password FROM `user` WHERE email = '".$_POST['email']."' ");
                    // $stmt = $pdo->prepare("SELECT password FROM `users` WHERE email = 'seebachera@gmx.at' ");
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                     
                    if (password_verify($_POST['password'],$result[0]['password'])) {
                        echo "<h6 style='color:green;'> Sie haben sich erfolgreich angemeldet</h6>"."<br>";
                        session_start();
                        $_SESSION['email'] = $_POST['email'];
                        header("Refresh:2; url=./dashboard.php");
                    }else{
                        echo "<h6 style='color:red;'>Bitte prüfen Sie ihre Eingaben</h6>"."<br>";
                    }
                }else{
                    echo "<h6 style='color:red;'>Email nicht vorhanden</h6>"."<br>";
                    
                }
                
                
                
            }else{
                echo "<h6 style='color:red;'>Bitte füllen Sie alle Felder aus!</h6>"."<br>";
                // header("Refresh:2; url=./login.php");
            }
        }
    ?>
  
    <button type="submit" class="btn btn-primary">anmelden</button>
</form>
    
</body>
</html>