<?php
include "dataBase_handler.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];

    // Validate and sanitize input if needed

    // SQL query to update staff details
    $sqlUpdate = "UPDATE Staff SET first_name = '$name', email = '$email' WHERE staff_id = '4'";

    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Details updated successfully";
    } else {
        echo "Error updating details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
