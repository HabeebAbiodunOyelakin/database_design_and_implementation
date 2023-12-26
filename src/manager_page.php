<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Manager View</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/tZ1a9gPn1tqz3S4yIx85+spe2q86r0/4jIotk=" crossorigin="anonymous"></script>
</head>
<body>


    <!-- Page upper body  -->
    <section>
        
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
    </section>


    <!-- Page body -->
    <section class="py-5 text-center container bg-body-secondary mt-1">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto" style="width: 30%;">
                <h1 class="fw-light">Manager's Name</h1>
                <img src="Employeesimage.png" class="object-fit-cover border rounded" alt="">
            </div>
            <div class="col-lg-6 col-md-8 mx-auto" style="width: 70%;">
                <h1 class="fw-light">Manager's ID</h1>
                <p>About Manager</p>
                <p class="lead text-body-secondary">This webpage seamlessly integrates HTML, PHP, Bootstrap, and JavaScript to craft a managerial interface. The interface comprises sections dedicated to showcasing manager details, a comprehensive list of clients with outstanding payments, and a complete roster of all employees. The page offers intuitive functionality for toggling the visibility of the client table and is equipped with scripts facilitating the editing and deletion of employee records. Additionally, the manager possesses the capability to perform CRUD operations on the employees table within their designated view.</p>
            </div>
        </div>
    </section>


    <!-- List of Client with Outstanding Payment -->
    <section class="py-2 text-center container bg-body-secondary mt-2 mb-2">
        <button id="dept" type="button">List of Clients with Outstanding Payment</button>
        <div id="tableContainer" style="display:none;">
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

            // SQL Query for Client Table
            $clientSql = "SELECT booking_id, cost_price, selling_price, s.first_name as Deal_owner, c.first_name as Client_name, c.email as Client_contact, outstanding_amount
                  FROM Booking b
                  JOIN Staff s ON b.booking_handler = s.staff_id
                  JOIN Customer c ON b.customer_id = c.customer_id
                  WHERE b.outstanding_amount > 0.00
                  GROUP BY booking_id, cost_price, selling_price, s.first_name, c.first_name, c.email
                  ORDER BY s.first_name DESC";

            $clientResult = $conn->query($clientSql);

            // Display Client Table
            if ($clientResult->num_rows > 0) {
                echo '<form method="post" action="">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cost Price</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Deal Owner</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Client Contact</th>
                            <th scope="col">Outstanding Amount</th>
                          </tr>
                        </thead>
                        <tbody>';
                $count = 1;
                while ($row = $clientResult->fetch_assoc()) {
                    echo '<tr>
                            <th scope="row">' . $count . '</th>
                            <td>' . $row["cost_price"] . '</td>
                            <td>' . $row["selling_price"] . '</td>
                            <td>' . $row["Deal_owner"] . '</td>
                            <td>' . $row["Client_name"] . '</td>
                            <td>' . $row["Client_contact"] . '</td>
                            <td>' . $row["outstanding_amount"] . '</td>
                          </tr>';
                    $count++;
                }
                echo '</tbody></table></form>';
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </div>
    </section>


    <!-- Javascript to Display table  -->
    <script>
        document.getElementById('dept').addEventListener('click', function () {
            var tableContainer = document.getElementById('tableContainer');
            tableContainer.style.display = (tableContainer.style.display === 'none' || tableContainer.style.display === '') ? 'block' : 'none';
        });
    </script>


    <!-- list of all Employee -->
    <section class="py-2 text-center container bg-body-secondary mt-2 mb-2">
       <h3>List of all Employees</h3>
        <?php
        // Include the database connection code here
        $host = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
        $username = "admin";
        $password = "#dccQPY8hv6y!hYG";
        $database = "mydb";
        
        // Create a connection to the database
        $conn = new mysqli($host, $username, $password, $database);
        
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Example: SELECT operation for Employee Table
        $employeeResult = $conn->query("SELECT * FROM Staff");

        // Display Employee Table
        if ($employeeResult->num_rows > 0) {
            echo '<table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role Type</th>
                            <th scope="col">Staff ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Branch ID</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row = $employeeResult->fetch_assoc()) {
                echo '<tr>
                        <th scope="row">' . $row["staff_id"] . '</th>
                        <td>' . $row["role_type"] . '</td>
                        <td>' . $row["staff_id"] . '</td>
                        <td>' . $row["first_name"] . '</td>
                        <td>' . $row["last_name"] . '</td>
                        <td>' . $row["branch_id"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["phone_number"] . '</td>
                        <td><img src="data:image/jpeg;base64,' . base64_encode($row["profile_picture"]) . '" alt="Profile Picture" height="50"></td>
                        <td>
                            <button class="btn btn-primary" onclick="editStaff(' . $row["staff_id"] . ')">Edit</button>
                            <button class="btn btn-danger" onclick="confirmDelete(' . $row["staff_id"] . ')">Delete</button>
                        </td>
                    </tr>';
            }

            echo '</tbody></table>';
        } else {
            echo "0 results";
        }

        // Close the database connection
        $conn->close();
        ?>

        <script>
            function editStaff(staffId) {
                // Redirect to the manage_staff.php page for editing
                window.location.href = 'manage_staff.php?action=edit&id=' + staffId;
            }

            function confirmDelete(staffId) {
                var confirmDelete = confirm("Are you sure you want to delete this user?");
                if (confirmDelete) {
                    // Send AJAX request to delete the record
                    $.ajax({
                        type: 'POST',
                        url: 'delete_staff.php', 
                        data: { staff_id: staffId },
                        success: function(response) {
                            alert(response);  // Add this line to show the response
                            location.reload();
                        },
                        error: function(error) {
                            console.error('Error deleting staff:', error);
                        }
                    });
                }
            }

        </script>




    </section>


    <!-- footer -->
    <section class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img class="bi" width="30" height="30" src="assets/aa logo.png"></img>
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Aesthetic Affairs</span>
        </div>
        </footer>
    </section>

</body>
</html>
