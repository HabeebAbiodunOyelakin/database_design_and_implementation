<?php
 include "dataBase_handler.php";
?>
<!-- HTML -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- javaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <title>Staff</title>
</head>

<body>

    <!-- logo & Name -->
    <img src="assets/aa logo.png" class="rounded mx-auto d-block" alt="logo" style="width:100px;height:100px;">
    <p class="text-danger" style="text-align:center;">Aesthetic Affairs</p>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!-- NavbarContent -->
    <div class="collapse multi-collapse" id="navbarToggleExternalContent">
        <div class="bg-light p-4">
            <a href="index.php" style="text-decoration:none">
                <h5 class="text-black h4"><i class="bi bi-box-arrow-left" style="color:black"></i> Logout </h5>
            </a>
            <p> </p>
        </div>
    </div>

    <!-- Intro -->
    <section id="introSec">
        <div class="container-lg">
            <div class="row ">
                <!-- leftCol -->
                <div class="col-8 text-start">
                    <!-- Php for intro -->
                    <?php
                $sql = 
                    "SELECT s.first_name
                    FROM staff_view s
                    WHERE s.staff_id = '4'";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                    <h2 class="mb-5 display text-danger ">Welcome,
                        <?php echo $row['first_name']?>!</h2>
                        <?php
                $sql = 
                    "SELECT s.staff_id
                    FROM staff_view s
                    WHERE s.role_type = 'Staff'";

                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                ?>
                        <h2 class="mb-5 text-danger">ID:
                            <?php echo $row['staff_id']?>
                        </h2>
                        <h2 class="text-danger mb-5">Role: Staff</h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-8">
                    <div class="container-lg p-5">
                        <!--accordian  -->
                        <div class="accordion" id="staffTable">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        ASSIGNMENTS
                                    </button>
                                </h2>
                                <!-- accordian-1 -->
                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#staffTable">
                                    <div class="accordion-body">
                                        <!--php for accordians(clients)  -->
                                        <?php
                      $sql = "SELECT
                      c.first_name AS client_name,
                      GROUP_CONCAT(DISTINCT c.booking_name ORDER BY c.booking_name SEPARATOR ', ') AS events,
                      c.email,
                      c.phone_number,
                      SUM(c.selling_price) AS total_budget
                      FROM
                      customer_view c
                      WHERE
                      c.first_name = 'Daud'
                      AND c.booking_name NOT IN ('Anniversary', 'Baby shower', 'Business event', 'Wedding')
                      GROUP BY
                      c.first_name, c.email, c.phone_number";

                      $result = $conn->query($sql);

                      if ($result && $result->num_rows > 0) {
                          $row = $result->fetch_assoc();
                          ?>
                                        <!-- Display the client information here -->
                                        <h2 class="mb-3 text-success">Client:
                                            <?php echo $row['client_name']; ?>
                                        </h2>
                                        <p>Event(s):
                                            <?php echo $row['events']; ?>
                                        </p>
                                        <p>Email:
                                            <?php echo $row['email']; ?>
                                        </p>
                                        <p>Phone number:
                                            <?php echo $row['phone_number']; ?>
                                        </p>
                                        <p>Total Budget:
                                            <?php echo $row['total_budget']; ?>
                                        </p>
                                        <?php
                      } else {
                          // Handle case when no data is found
                          echo "No client data found.";
                      }
                      ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        SHIFTS
                                    </button>
                                </h2>
                                <!-- accordian-2 -->
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#staffTable">
                                    <div class="accordion-body">
                                        <!-- php accordian for(shift) -->
                                        <?php
                        // SQL query to retrieve start_time and end_time from shifts where the staff_id is '4'
                        $sqlShifts = "SELECT start_time, end_time FROM Shift WHERE staff_id = '4'";
                        $resultShifts = $conn->query($sqlShifts);

                        if ($resultShifts && $resultShifts->num_rows > 0) {
                            // Displaying shift information
                            while ($rowShifts = $resultShifts->fetch_assoc()) {
                                echo "<p>Start Time: " . $rowShifts['start_time'] . "</p>";
                                echo "<p>End Time: " . $rowShifts['end_time'] . "</p>";
                            }
                        } else {
                            // Handle case when no shift data is found
                            echo "No shift data found.";
                        }
                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- righttCol -->
                <div class="col-4 text-center">
                    <?php
                // SQL query for first_name, last_name, email fROM Staff where staff_id is '4'
                $sqlStaffInfo = "SELECT first_name, last_name, email, profile_picture FROM Staff WHERE staff_id = '4'";
                $resultStaffInfo = $conn->query($sqlStaffInfo);
                if ($resultStaffInfo && $resultStaffInfo->num_rows > 0) {
                  $rowStaffInfo = $resultStaffInfo->fetch_assoc();
                ?>
                    <img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($rowStaffInfo['profile_picture']);?>" class="rounded" alt="staffImg" style="border:150px;height:150px;">
                    <!-- btnContainer -->
                    <div class="container-lg my-5">
                        <!-- btnRow -->
                        <div class="row">
                            <button class="btn btn-danger" onclick="openNav()">Details</button>
                            <div class="col text-center">
                                <!-- detailsBtn -->
                                <div id="sidebar">
                                    <a href="javascript:void(0)" class="close-btn" onclick="closeNav()">×</a>
                                    <!-- UpdateForm -->
                                    <h3 class="text-danger">Edit Details</h3>
                                    <form action="includes/staff_Update.php" class="action method">
                                        <input type="text" name="name" placeholder="name">
                                        <input type="text" name="email" placeholder="E-Mail">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </form>
                                    <h3 class="p-5 display ">NAME:
                                        <?php echo $rowStaffInfo['first_name'] . ' ' . $rowStaffInfo['last_name']; ?>!
                                    </h3>
                                    <h2 class="p-5 ">Email:
                                        <?php echo $rowStaffInfo['email']; ?>
                                    </h2>
                                    <?php
                    } else {
                        // Handle case when no staff data is found
                        echo "No staff data found.";
                    }
                    ?>
                                </div>

                            </div>
                            <div class="col text-center">
                            </div>
                            <div class="col text-center">
                                <!-- activitiesBtn -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- sidebar JavaScript -->
    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "50%";
            document.getElementById("content").style.marginLeft = "50%";
            document.getElementById("openButton").style.display = "none";
        }

        function closeNav() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("content").style.marginLeft = "0";
            document.getElementById("openButton").style.display = "block";
        }
    </script>
</body>

</html>