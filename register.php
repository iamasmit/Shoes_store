<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles/custom.css">
</head>
<body>
<?php
session_start();
include("components/navbar.php");
?>
<section class='login' id='login'>
    <div class='head'>
        <h2 class='company'>Register</h2>
    </div>
    <div class='form'>
        <form action="register.php" method="post">
            <input type="text" name="full_name" placeholder='Enter Your Name' class='text' id='username' required><br>
            <input type="email" class="email" placeholder="example@email.com" name="email">
            <input type="text" name="address" placeholder='Enter Your Address' class='text' required><br>
            <input type="text" name="card_details" placeholder='Enter Card Details' class='text' required><br>
            <input type="text" name="username" placeholder='Enter a Username' class='text' id='username' required><br>
            <div class="pass">
                <input type="password" name="password" placeholder='Enter New Password' class='password' id="pass" required>
                <i class="far fa-eye" id="togglePassword"></i> <br>
            </div>
            <button class='btn-login' type="submit" name="submit">Register</button>
            <?php
            $warning = true;
            $check_email = true;
            $check_password = true;
            require_once "config.php";
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $password = trim($_POST['password']);
                $email = trim($_POST['email']);
                $address = trim($_POST['address']);
                $card_details = trim($_POST['card_details']);
                $full_name = trim($_POST['full_name']);
                $designation = "user";

                // Check for password requirements
                if (strlen($password) < 6 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
                    $check_password = false;
                }

                if ($email != NULL) {
                    // Check for duplicate email addresses
                    $query = $conn->prepare("SELECT email FROM users WHERE email=?");
                    $query->bind_param("s", $email);
                    if ($query->execute()) {
                        $query->store_result();
                        if ($query->num_rows() >= 1) {
                            $check_email = false;
                        } else {
                            $email = trim($_POST['email']);
                        }
                    } else {
                        echo "Something went wrong!";
                    }
                    $query->close();
                }

                if ($check_email && $check_password) {
                    $sql = "INSERT INTO users(full_name,email,address,card_details,designation,username,password) VALUES(?,?,?,?,?,?,?)";
                    $stmt = $conn->prepare($sql);
                    if ($stmt) {
                        $stmt->bind_param("sssssss", $full_name, $email, $address, $card_details, $designation, $username, $password);
                        if ($stmt->execute()) {
                            echo "<p style='margin-top:-0.5em;'> <strong>Successfully Registered!</strong></p>";
                            header("location: logout.php");
                        } else {
                            $warning = false;
                        }
                    }
                    $stmt->close();
                }
            }
            $conn->close();
            if ($check_email == false) {
                echo "<p> <strong>Email address already registered! </strong></p>";
            }
            if ($check_password == false) {
                echo "<p> <strong>Password must be at least 6 characters long and contain at least one special character.</strong></p>";
            }
            ?>
        </form>
        <a href="login.php"><button class='btn-login' type="submit" name="login">Login</button></a>
    </div>
</section>
<!-- partial -->
<!--<script  src="./script.js"></script>-->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#pass');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
