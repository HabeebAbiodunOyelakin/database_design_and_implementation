<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteButton"])) {
    $deletedSupplierID = $_POST["supplier_id"];

$servername = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "#dccQPY8hv6y!hYG";
$dbname = "mydb";

$connection = new mysqli($servername, $username, $password, $dbname);

    $result = mysqli_query($connection, "DELETE FROM ceo_supplier c WHERE c.supplier_id = $deletedSupplierID");

    header("Location: ceo_page.php");
    exit();
}
?>
