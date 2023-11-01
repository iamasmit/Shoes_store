<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
} else {
    if (isset($_POST['checkout'])) {
        include('config.php');
        $user_email = $_SESSION['email']; // Retrieve user's email from the session
        $user_name = $_SESSION['username'];

        // Clear the cart after checkout
        $conn->query("DELETE FROM cart");

        // Send confirmation email
        $to = $user_email;
        $subject = 'Order Confirmation';
        $message = "Hello $user_name,\n\nThank you for your order. Your order has been successfully placed.";
        $headers = 'From: asmitreal@gmail.com'; // Replace with your email address

        if (mail($to, $subject, $message, $headers)) {
            echo '<p style="color: green;">Confirmation email sent successfully.</p>';
        } else {
            echo '<p style="color: red;">Error sending confirmation email.</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles/cart.css">
</head>
<body style="background:black;">
    <?php
    $sum = 0;
    include("components/navbar.php")
    ?>

    <main>
        <div class="cart">
            <h1 class="main-heading">Cart</h1>
            <div class="list">
                <table class="table-tot">
                    <thead>
                        <tr class="headings">
                            <td>PRODUCT</td>
                            <td>Quantity</td>
                            <td>SUB-TOTAL</td>
                        </tr>
                    </thead>
                    <?php
                    include('config.php');

                    $sql2 = "SELECT p_id,p_name,p_price,quantity FROM cart";
                    $result = $conn->query($sql2);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["p_name"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["p_price"] * $row["quantity"] . '$' . "</td>
                            <td>
                                <form action='cart.php' method='POST'>
                                    <input type='hidden' name='pid' value='" . $row["p_id"] . "' />
                                    <button class='submit-btn' type='submit' name='delete'>
                                    <img width='24' height='24' src='https://img.icons8.com/material-rounded/24/ffffff/trash.png' alt='trash'/></button>
                                </form>
                            </td></tr>";

                        }
                    } else {
                        echo "<tr>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        </tr> ";
                    }
                    ?>
                </table>
            </div>

            <div class="total">
                <h3>Total Bill:
                    <?php
                    include('config.php');
                    error_reporting(0);

                    $sql2 = "SELECT SUM(p_price*quantity) AS totalAmount FROM cart";
                    $result2 = $conn->query($sql2);
                    if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        $total = $row2['totalAmount'];
                        echo $total, "$";
                    } else {
                        echo "Record Not Found";
                    }
                    ?> </h3>
            </div>
            <div class="checkout">
                <?php
                $check = $conn->query("select count(*) as count from cart");
                if ($check->num_rows > 0) {
                    $count = $check->fetch_assoc()["count"];
                    if ($count > 0) {
                        ?>
                        <form method="post">
                            <button class="checkout-btnn" type="submit" name="checkout">CheckOut</button>
                        </form>
                <?php }
                } ?>
            </div>
        </div>
    </main>
</body>
</html>
