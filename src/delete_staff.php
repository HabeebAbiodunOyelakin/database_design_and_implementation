<?php
// Include the database connection code here
$host = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "#dccQPY8hv6y!hYG";
$database = "mydb";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['staff_id'])) {
    $staffId = $_POST['staff_id'];


    $deleteQuery = "DELETE FROM Staff WHERE staff_id = ?";
    
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $staffId);

    if ($stmt->execute()) {

        echo "User deleted successfully";
    } else {

        echo "Error deleting user: " . $stmt->error;
    }


    $stmt->close();
} else {

    echo "Error: staff_id not set";
}


$conn->close();
?>
