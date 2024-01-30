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
                            <a class="nav-link active" aria-current="page" href="dashboard.php">Anzeige aller Kunden</a>
                            <a class="nav-link" href="userClients.php">Anzeige meiner Kunden</a>
                            <a class="nav-link" href="createClient.php">Kunde hinzufügen</a>
                            
                            
                        </div>
                        </div>
                    </div>
                    </nav>

                <?php
                $stmt = $pdo->prepare('SELECT * FROM `client`');
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // echo "  Unternehmen | Kunde | Telefonnummer | Adresse | Erstellt von User mit email | Erstellt am <br>";
                // echo"<hr>";
                // for( $i = 0; $i < count($result); $i++ ) {
                //     echo $result[0]['company_name'] . " |" . $result[0]['contact_person']. " " . $result[0]['phone']. " " . $result[0]['adress']. " " . $result[0]['created_by']. " " . $result[0]['created_at'];
                //     echo "<hr>";
                // }
                ?>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Unternehmen</th>
                        <th scope="col">Kunde</th>
                        <th scope="col">Telefonnummer</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Erstellt von User mit email</th>
                        <th scope="col">Erstellt am</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for( $i = 0; $i < count($result); $i++ ) {
                        echo "<tr>";
                        $count = $i +1;
                        echo"<th scope='row'>$count</th>";
                        echo "<td>".$result[$i]['company_name']."</td>";
                        echo "<td>".$result[$i]['contact_person']."</td>";
                        echo "<td>".$result[$i]['phone']."</td>";
                        echo "<td>".$result[$i]['adress']."</td>";
                        echo "<td>".$result[$i]['email']."</td>";
                        echo "<td>".$result[$i]['created_at']."</td>";
                        
                        echo"</tr>";
                        };
                       ?>
                    </tbody>
                    </table>
                    <?php
            }else {
                echo "<h1 style='text-align:center';> Kein Zugriff </h1>";
            }
        ?>
    </main>
</body>
</html>