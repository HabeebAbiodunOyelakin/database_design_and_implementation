<?php
    $servername = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
    $username = "admin";
    $password = "#dccQPY8hv6y!hYG";
    $database = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Customer page</title>
</head>

<body>
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
            <a href="index.php" style="text-decoration:none">
                <h5 class="text-black h4"><i class="bi bi-box-arrow-left" style="color:black"></i> Logout </h5>
            </a>
            <p> </p>
        </div>
    </div>

    <div class="container">
        <?php
            $sql = "SELECT first_name
                FROM customer_view c
                WHERE c.first_name = 'Daud'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_array();
                $firstName = $row[0];
            }
        ?>
        <div class="row">
            <div class="col">
                <h1 class="py-2">Welcome, <?php echo $firstName;?>!</h1>
        </div>

        <!-- Bookings accordions. -->
        <?php
            $sql = "SELECT booking_name, selling_price, outstanding_amount, booking_handler_first_name, booking_handler_last_name, booking_handler_email, booking_handler_phone_number, profile_picture
                FROM customer_view c
                WHERE c.first_name = 'Daud'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
        ?>
        <div class="row">
            <div class="col  bg-body-secondary p-3">
                <h2 class="mb-3 text-center mb-4">Here are your bookings</h2>

                <div class="accordion" id="accordion">
                    <?php
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                        <button class="accordion-button <?php if ($count != 1) echo 'collapsed';?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count;?>" aria-expanded="true" aria-controls="collapse<?php echo $count;?>">
                            <strong><?php echo $row['booking_name'];?></strong>
                        </button>
                        </h2>
                        <div id="collapse<?php echo $count;?>" class="accordion-collapse collapse <?php if ($count == 1) echo 'show';?>" data-bs-parent="#accordion">
                        <div class="accordion-body text-break">
                            <div class="row">
                                <div class="col-lg-6 table-responsive ">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">Outstanding amount</th>
                                            <th scope="col">Total price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><?php echo '£' . $row['outstanding_amount'];?></td>
                                            <td><?php echo '£' . $row['selling_price'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 col-sm-3 col-md-2">
                                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($row['profile_picture']);?>" alt="Booking handler profile picture" class="img-fluid shadow rounded img-thumbnail">
                                </div>
                                <div class="col">
                                    <h3 class="mb-3 fs-5">
                                        Your booking handler is: <?php echo $row['booking_handler_first_name'] . ' ' . $row['booking_handler_last_name'];?>
                                    </h3>
                                    <h3 class="mb-3 fs-5">
                                        Email: <?php echo $row['booking_handler_email'];?>
                                    </h3>
                                    <h3 class="fs-5">
                                        Phone number: <?php echo $row['booking_handler_phone_number'];?>
                                    </h3>
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
                <?php } else { echo "You have no bookings at this time."; }; ?>
            </div>
        </div>
        <p class="mt-4 mb-0">Please email contact@aestheticaffairs.uk in order to make new bookings.</p>


        <!-- footer -->
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
	$conn->close();
?>