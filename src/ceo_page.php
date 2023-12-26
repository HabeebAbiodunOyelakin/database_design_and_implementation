<?php
// Database Connection
  $servername = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
  $username = "admin";
  $password = "#dccQPY8hv6y!hYG";
  $dbname = "mydb";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CEO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  </head>
  <body>
    <!-- logo -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <img src="assets/aa logo.png" class="rounded mx-auto d-block" alt="logo" style="width:100px;height:100px;">
    <p class="text-danger" style="text-align:center;">Aesthetic Affairs</p>

    <!-- navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="collapse multi-collapse" id="navbarToggleExternalContent">
        <div class="bg-light p-4">
            <a href ="index.php" style="text-decoration:none"><h5 class="text-black h4"><i class="bi bi-box-arrow-left" style="color:black"></i> Logout </h5></a>
            <p> </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <!-- SQL Query -->
                <?php
                $sql = 
                    "SELECT c.profile_picture
                    FROM ceo_view c
                    WHERE c.role_type = 'CEO'";

                $result = $conn->query($sql);
                // Fetch the image data
                $row = $result->fetch_assoc();
                $imageData = $row['profile_picture'];

                // Encode the image data to base64
                $base64Image = base64_encode($imageData);

                // Display the base64 encoded image inline in HTML
                echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="CEO Profile Picture" class="img-fluid mx-auto d-block m-3" style="max-width:200px">';
                ?>     

            </div>
            <div class="p-3 text-primary-emphasis col-4">
                <?php
                $sql = 
                    "SELECT c.first_name
                    FROM ceo_view c
                    WHERE c.role_type = 'CEO'";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <h2 class="mb-3">Welcome, <?php echo $row['first_name']?>!</h2>
                <?php
                $sql = 
                    "SELECT c.staff_id
                    FROM ceo_view c
                    WHERE c.role_type = 'CEO'";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                <h2 class="mb-5">ID: <?php echo $row['staff_id']?></h2>
                <h2 class="text-success mb-5">Role: CEO</h2>
            </div>
        </div>
        <div class="row">
            <h2 class="p-3 text-primary-emphasis">Quote of the day:</h2> 
        </div>    
        <div class="row mb-5">
            <div class="col-8">
                <?php
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://zenquotes.io/api/today");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($curl);
                curl_close($curl);

                // Decode JSON string into an array.
                $data = json_decode($output);

                // Print quote of the day.
                echo $data[0]->q . "<br>";
                ?>
            </div>
            <div class="col-4">
                <a href="assets/chart.webp"><button type="button" class="btn btn-success btn-lg">Statistics</button></a>
            </div>
        </div>
        <div class="row">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <strong>Weekly view</strong>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Day</th>
                                        <th scope="col">Gross Profit</th>
                                        <th scope="col">Expenditure</th>
                                        <th scope="col">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <td scope="row">Monday</td>
                                        <td>£3,000</td>
                                        <td>£700</td>
                                        <td>£15,000</td>
                                        </tr>
                                        <tr>
                                        <td scope="row">Tuesday</td>
                                        <td>£900</td>
                                        <td>£300</td>
                                        <td>£15,600</td>
                                        </tr>
                                        <tr>
                                        <td scope="row">Wednesday</td>
                                        <td>£2,000</td>
                                        <td>£800</td>
                                        <td>£16,800</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <strong>Employees</strong>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="ceo_page.php" method="get" class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Name, Staff ID, Branch name ..." name="search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                            <!-- Display search results here -->
                            <?php include('search_results.php'); ?>
                            <div class="row">
                                <h3 class="text-center mt-3">Branch Managers<h3>
                            </div>
                            <div class="row">
                                <?php
                                $sql = 
                                    "SELECT c.*
                                    FROM ceo_view c
                                    WHERE c.role_type = 'Manager'";

                                    $result = $conn->query($sql);
                                ?>
                                <div class="accordion" id="accordion2">
                                    <?php
                                    $count = 1;
                                    while($row = $result->fetch_assoc()) {
                                        $imageData = $row['profile_picture'];
                                        // Encode the image data to base64
                                        $base64Image = base64_encode($imageData);
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button <?php if ($count != 1) echo 'collapsed';?> text-info" type="button" data-bs-toggle="collapse" data-bs-target="#a2collapse<?php echo $count; ?>" aria-expanded="true" aria-controls="a2collapse<?php echo $count; ?>">
                                            <p class="text-success"><?php echo $row['city'] ?></p>
                                            </button>
                                        </h2>
                                        <div id="a2collapse<?php echo $count; ?>" class="accordion-collapse collapse" data-bs-parent="#accordion2">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-auto"><?php echo '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Manager Profile Picture" class="img-fluid d-block m-3" style="max-width:200px">'; ?></div>
                                                    <div class="col m-3">
                                                        <h3 class="mb-3"><?php echo $row['first_name'] . ' ' . $row['last_name'];?></h3>
                                                        <h5 class="mb-3">Salary: £<?php echo $row['salary'] ?></h5>
                                                        <h5 class="mb-3">Phone number: <?php echo $row['phone_number'] ?></h5>
                                                        <h5>Email: <?php echo $row['email'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php
                                    $count++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <strong>Suppliers</strong>
                        </button>
                    </h2>
                    <?php
                    $sql = 
                        "SELECT c.*
                        FROM ceo_supplier c";

                    $result = $conn->query($sql);
                    ?>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) {?>
                                <tr>
                                <td><?php echo $row['supplier_id']?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['phone_number'];?></td>

                                <form method="post" action="delete_supplier.php">
                                    <!-- Hidden input to store the supplier_id -->
                                    <input type="hidden" name="supplier_id" value="<?php echo $row['supplier_id']; ?>">
                                    <td><button type="submit" class="btn btn-outline-danger" name="deleteButton">Delete</button></td>
                                </form>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img class="bi" width="30" height="30" src="assets/aa logo.png"></img>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Aesthetic Affairs</span>
        </div>
        </footer>
    </div>
  </body>
</html>

<?php
// Close connection
$conn->close();
?>