
<?php
try{

    $dbhost = "localhost";
    $dbname="customer management system";
    $dbuser = "root";
    $dbpass = "";
    $pdo = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            }
            catch(PDOException $e){
                echo "Probleme mit der Datenverbindugn";
                die();
            }
            ?>