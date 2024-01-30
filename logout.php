<?php 
session_start();
unset($_SESSION["email"]);
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abmeldung</title>
</head>
<body>
    <h1 style='text-align:center';>Sie haben sich erfolgreich abgemeldet</h1>
    <?php 
        header("Refresh:2; url=./login.php");
    ?>
</body>
</html>