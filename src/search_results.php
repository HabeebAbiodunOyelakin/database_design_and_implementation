<?php
$servername = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "#dccQPY8hv6y!hYG";
$dbname = "mydb";

$connection = new mysqli($servername, $username, $password, $dbname);

// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    // Sanitize the search input
    $searchTerm = mysqli_real_escape_string($connection, $_GET["search"]);

    // Perform the search query
    $query = "SELECT * 
    FROM ceo_view
    WHERE first_name LIKE '%$searchTerm%' OR staff_id LIKE '$searchTerm' OR city LIKE '%$searchTerm%'";
    $result = mysqli_query($connection, $query);

    // Display search results
    if ($result && $result->num_rows > 0) {
        // if (!$_GET["search"]) {
            echo '<h3 class="mt-3 mb-3">Search Results:</h3>';
        // }
        while ($row = mysqli_fetch_assoc($result)) {
            $imageData = $row['profile_picture'];
            // Encode the image data to base64
            $base64Image = base64_encode($imageData);?>
            <div class="row">
                <div class="col-auto"><?php echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Manager Profile Picture" class="img-fluid d-block m-3" style="max-width:200px">'; ?></div>
                <div class="col m-3">
                    <h3 class="mb-3"><?php echo $row['first_name'] . ' ' . $row['last_name'];?></h3>
                    <h5 class="mb-2">Role: <?php echo $row['role_type'] ?></h5>
                    <h5 class="mb-2">Salary: £<?php echo $row['salary'] ?></h5>
                    <h5 class="mb-2">Phone number: <?php echo $row['phone_number'] ?></h5>
                    <h5>Email: <?php echo $row['email'] ?></h5>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<h5 class='mt-3'>No results found :(</h5>" . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
