<?php

$host = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "#dccQPY8hv6y!hYG";
$database = "mydb";


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$roleType = $staffId = $firstName = $lastName = $branchId = $email = $phoneNumber = $profilePicture = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Set variables from POST data
        $roleType = $_POST["role_type"];
        $staffId = $_POST["staff_id"];
        $firstName = $_POST["first_name"];
        $lastName = $_POST["last_name"];
        $branchId = $_POST["branch_id"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phone_number"];


        if ($_FILES["profile_picture"]["size"] > 0) {
            $profilePicture = file_get_contents($_FILES["profile_picture"]["tmp_name"]);
        }


        if (isset($_POST["staff_id"]) && !empty($_POST["staff_id"])) {

            $stmt = $conn->prepare("UPDATE Staff SET role_type=?, first_name=?, last_name=?, branch_id=?, email=?, phone_number=?, profile_picture=? WHERE staff_id=?");
            $stmt->bind_param("sssssssi", $roleType, $firstName, $lastName, $branchId, $email, $phoneNumber, $profilePicture, $staffId);
        } else {

            $stmt = $conn->prepare("INSERT INTO Staff (role_type, first_name, last_name, branch_id, email, phone_number, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $roleType, $firstName, $lastName, $branchId, $email, $phoneNumber, $profilePicture);
        }


        if (!$stmt->execute()) {
            throw new Exception("Error executing query: " . $stmt->error);
        }


        $stmt->close();


        header("Location: manager_page.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


if (isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $conn->prepare("SELECT * FROM Staff WHERE staff_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    $roleType = $row["role_type"];
    $staffId = $row["staff_id"];
    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $branchId = $row["branch_id"];
    $email = $row["email"];
    $phoneNumber = $row["phone_number"];

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Manage Staff</title>
</head>
<body>

<div class="mt-5 container position-absolute top-10 start-10" style="">
    <h2>Manage Staff</h2>

    <form action="manage_staff.php" method="post" enctype="multipart/form-data">
        <!-- Add hidden input for staff_id when editing -->
        <?php if (isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_GET["id"])): ?>
            <input type="hidden" name="staff_id" value="<?php echo $staffId; ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label for="role_type" class="form-label">Role Type</label>
            <input type="text" class="form-control" id="role_type" name="role_type" value="<?php echo $roleType; ?>">
        </div>
        <div class="mb-3">
            <label for="staff_id" class="form-label">Staff ID</label>
            <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staffId; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $firstName; ?>">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>">
        </div>
        <div class="mb-3">
            <label for="branch_id" class="form-label">Branch ID</label>
            <input type="text" class="form-control" id="branch_id" name="branch_id" value="<?php echo $branchId; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $phoneNumber; ?>">
        </div>
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>
