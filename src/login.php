<?php
// Used for displaying an error on invalid login.
$isValidLogin = true;

// If this page is requested via a POST method, then the user is trying to log in.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    login($inputUsername, $inputPassword);
}

function login($username, $password) {
    global $isValidLogin;
    if ($password !== "password123") {
        $isValidLogin = false;
        return;
    }

    if ($username === 'staff'
        || $username === 'ceo'
        || $username === 'customer'
        || $username === 'manager'
    ) {
        header("Location: " . $username . "_page.php");
        exit();
    } else {
        // Username not found
        $isValidLogin= false;
        return;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boxicons/css/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Aesthetic Affairs</title>
    <script src="index.js" defer></script>
</head>

<body>
    <div class="wrapper">
        <nav class="nav">
            <div class="nav-logo">
                <a href="index.php">Aesthetic Affairs</a>
            </div>
            <div class="nav-menu" id="navMenu">
                <ul>
                    <li><a href="index.php" class="link">Home</a></li>
                    <li><a href="services.html" class="link">Services</a></li>
                    <li><a href="about.html" class="link">About</a></li>
                    <li><a href="login.php" class="link active">Login</a></li>
                </ul>
            </div>

            <div class="nav-menu-btn">
                <i class="bx bx-menu" onclick="myMenuFunction()"></i>
            </div>
        </nav>

        <div class="form-box">

            <div class="login-container" id="login">
                <div class="top">
                    <header>
                        <?php
                            if ($isValidLogin) {
                                echo "Welcome";
                            } else {
                                echo "Invalid username or password";
                            }
                        ?>
                    </header>
                </div>

                <form method="post" action="login.php">
                    <div class="input-box">
                        <input type="text" name="username" id="username" class="input-field" placeholder="Username">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="password" class="input-field" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="submit" class="submit" value="Log in">
                    </div>
                </form>


                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>