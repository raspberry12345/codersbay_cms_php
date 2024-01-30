<?php 
session_start();
$companyId = $_GET['id'];
require_once ("connectDb.php") ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Löschen</title>
</head>
<body>
<?php 
if (!empty($_GET['id']) && !empty($_SESSION["email"])) {
    # code...
    $stmt = $pdo->prepare("DELETE FROM `client` WHERE company_id = $companyId");
    $stmt->execute();

    



    echo "<h1>Der Datensatz wurde gelöscht</h1>";
    header("Refresh:2; url=./userClients.php");
}else{
    echo "<h1>Kein Zugriff</h1>";
}
?>

</body>
</html>