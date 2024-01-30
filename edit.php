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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <title>Bearbeitung</title>
</head>
<body>
<?php
if (!empty($_SESSION["email"])) {
    # code...`client`
    ?>
    <form style="width: 100%; margin-top: 0rem;" id="editForm" action=<?php echo "edit.php?id=".$companyId ?> method="post">
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Unternehmen</th>
        <th scope="col">Kunde</th>
        <th scope="col">Telefonnummer</th>
        <th scope="col">Adresse</th>
        </tr>
    </thead>
    <tbody>
    <tr>
    <th scope='row'>
    <td><input type="text" name="company_name"></td>
    <td><input type="text" name="contact_person"></td>
    <td><input type="text" name="phone"></td>
    <td><input type="text" name="adress"></td>
    </th>
    </tr>
    </tbody>
    
    </table>
    
    
    <button id="ändernBtn" type="submit" class="btn btn-primary">ändern</button>
    <?php
    // $inputName = array("company_name", "contact_person", "phone", "adress");
    if (!empty($_POST["company_name"])||!empty($_POST["contact_person"])||!empty($_POST["phone"])||!empty($_POST["adress"])) {
        # code...
    
    $stmt = $pdo->prepare("SELECT * FROM `client` WHERE `company_id`=$companyId");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    
    
    
    
    
    
        if (empty($_POST['company_name'])) {
            $company_name = $result[0]['company_name'];
        }else{
            $company_name = $_POST['company_name'];
        }
        
        if (empty($_POST['contact_person'])) {
            $contact_person =$result[0]['contact_person'];
        }else{
            $contact_person = $_POST['contact_person'] ;
        }
        
        if (empty($_POST['phone'])) {
            $phone =$result[0]['phone'];
        }else{
            $phone =$_POST['phone'];
        }
        if (empty($_POST['adress'])) {
            $adress =$result[0]['adress'];
        }else{
            $adress = $_POST['adress'] ;
        }
    
    
    
    // $sqlQuery = "UPDATE client SET company_name= $company_name, contact_person= $contact_person, phone= $phone, adress= $adress WHERE `company_id`= $companyId";
    $sqlQuery = "UPDATE client SET `company_name`= :com, `contact_person`= :con, `phone`= :pho, `adress`= :adr WHERE `company_id`= $companyId";
    
   
    $stmt = $pdo->prepare($sqlQuery);
    $stmt->bindValue(':com', $company_name);
    $stmt->bindValue(':con', $contact_person);
    $stmt->bindValue(':pho', $phone);
    $stmt->bindValue(':adr', $adress);
        
        $stmt->execute();
        echo "<h6>Daten wurden aktualisiert</h6>";
        header("Refresh:3; url=./userClients.php");
    
    }
    ?>
    </form>
    <?php
    
}else{
    echo "<h1>Kein Zugriff</h1>";
}
?>
</body>
</html>

<!-- $stmt = $pdo->prepare("UPDATE client SET :com  WHERE `company_id`=:id");
        $stmt->bindValue(':com', $_POST['company']);
        $stmt->bindValue(':id', $companyId); -->