
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
    <title>Registrierung</title>
</head>
<body>
<form action="index.php" method="post">
    <h1>Registrierung</h1>
    <div class="mb-3">
    <label for="exampleInputName1" class="form-name">Name</label>
    <input type="text" class="form-control" id="exampleInputName1" name="username">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
           

            $stmt = $pdo->prepare('INSERT INTO `user` (`name`, `email`, `password`) VALUES (:name, :email, :password)');
            $stmt->bindValue(':name', $_POST['username']);
            $stmt->bindValue(':email', $_POST['email']);
            $stmt->bindValue(':password', password_hash($_POST['password'],PASSWORD_DEFAULT));
            $stmt->execute();
            echo "<h6 style='color:green;'>Registrierung abgeschlossen</h6>"."<br>";
            header("Refresh:2; url=./login.php");
        }else{
            echo "<h6 style='color:red;'>Bitte füllen Sie alle Felder aus!</h6>"."<br>";
        }
    }
    ?>
  
    <button type="submit" class="btn btn-primary">Abschicken</button>
</form>
    
</body>
</html>