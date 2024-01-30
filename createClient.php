<?php
    session_start();
    
    require_once ("connectDb.php")

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <title>User-Bereich</title>
</head>
<body>
    <main>
    
        <?php 
            if (!empty($_SESSION["email"])) {
                
                ?>
                <header >
                    <h6 class="text-white mb">Sie sind mit der Email-Adresse: <?php echo $_SESSION["email"] ?> angemeldet</h6>
                    <div><a class="btn btn-danger" href='./logout.php'>abmelden</a></div>
                    
                </header>
                
                <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
                    
                    <div class="container-fluid">
                       
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link"  href="dashboard.php">Anzeige aller Kunden</a>
                            <a class="nav-link" href="userClients.php">Anzeige meiner Kunden</a>
                            <a class="nav-link active" aria-current="page" href="createClient.php">Kunde hinzufügen</a>
                            
                            
                        </div>
                        </div>
                    </div>
                    </nav>

                    <form id="formUserClients" action="createClient.php" method="post">
    <h1>Kunden Formular</h1>
    
    <div class="mb-3">
        <label for="company" class="form-label">Name des Unternehmens</label>
        <input type="text" class="form-control" id="company" aria-describedby="companyHelp" name="company">
        <div id="companyHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="inputClient" class="form-label">Name des Kunden</label>
        <input type="text" class="form-control" id="inputClient" name="client">
    </div>
    <div class="mb-3">
        <label for="inputPhone" class="form-label">Telefonnummer</label>
        <input type="text" class="form-control" id="inputPhone" name="phone">
    </div>
    <div class="mb-3">
        <label for="inputAdress" class="form-label">Adresse</label>
        <input type="text" class="form-control" id="inputAdress" name="adress">
    </div>
   
  
    <button type="submit" class="btn btn-primary">eintragen</button>
</form>
            <?php 
            }

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (!empty($_POST['company']) && !empty($_POST['client']) && !empty($_POST['phone']) && !empty($_POST['adress'])) {

                    // do some databasestuff
                    $stmt = $pdo->prepare('INSERT INTO `client` (`company_name`, `contact_person`, `phone`, `adress`, `email`, `created_at`) VALUES (:company, :client, :phone, :adress, :email, now())');
                    $stmt->bindValue(':company', $_POST['company']);
                    $stmt->bindValue(':client', $_POST['client']);
                    $stmt->bindValue(':phone', $_POST['phone']);
                    $stmt->bindValue(':adress', $_POST['adress']);
                    $stmt->bindValue(':email', $_SESSION['email']);
                    
                    $stmt->execute();
                    echo "<h6 style='color:green;'>Kunde eingetragen</h6>"."<br>";
                    header("Refresh:2; url=./createClient.php");

                    // end some databasestuff
                }else{echo "<h6 style='color:red;'>Bitte füllen Sie alle Felder vollständig aus</h6>"."<br>";}

            }
            ?>
    </main>
</body>
</html>