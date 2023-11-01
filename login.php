<?php
$warning = true;
require_once "config.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT username, password, designation, email FROM users WHERE username=?");
    $query->bind_param("s", $username);

    if ($query->execute()) {
        $query->store_result();

        if ($query->num_rows() == 1) {
            $query->bind_result($db_username, $db_password, $db_designation, $db_email);
            if ($query->fetch()) {
                if ($password == $db_password) {
                    session_start();
                    $_SESSION["username"] = $db_username;
                    $_SESSION["email"] = $db_email; // Store the email in the session
                    $_SESSION["loggedIn"] = true;

                    if ($db_designation == "user") {
                        header("location: index.php");
                    } else {
                        header("location: logout.php");
                    }
                } else {
                    $warning = false;
                }
            }
        } else {
            $warning = false;
        }

        $query->close();
    } else {
        $warning = false;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles/custom.css">
</head>
<body>
    <?php include("components/navbar.php"); ?>
    <section class='login' id='login'>
        <div class='head'>
            <h2 class='company'>Login</h2>
        </div>
        <div class='form'>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder='Username' class='text' id='username' required><br>
                <div class="pass">
                    <input type="password" name="password" placeholder='••••••••••' class='password' id="pass" required>
                    <i class="far fa-eye" id="togglePassword"></i> <br>
                </div>
                <button class='btn-login' id='do-login' type="submit" name="submit">Login</button>
                <?php
                if ($warning == false) {
                    echo "<div style='color:rgb(190, 0, 0);'> <strong>Wrong Username or Password, Try again! </strong></div>";
                }
                ?>
            </form>
            <?php
            echo "<p >New User?</p>";
            ?>
            <a href="register.php"><button style="margin-top:-2em;" class='btn-login' id='do-login' type="submit" name="register">Register Now</button></a>
        </div>
    </section>
    <!-- partial -->
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
