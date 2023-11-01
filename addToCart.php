<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
} else {
    include('config.php');
    
    if (isset($_POST['submit'])) {
        $customer_username = $_SESSION["username"];
        $product_name = $_POST['name'];
        $size = $_POST['size'];
        $product_price = $_POST['price'];
        $pid = $_POST['pid'];
        
        // Generate a random order number (e.g., using uniqid())
        $order_number = uniqid('ORDER', true);

        // Get the current date and time
        $order_date = date('Y-m-d H:i:s');
        
        $product_name = mysqli_real_escape_string($conn, $product_name);
        $size = mysqli_real_escape_string($conn, $size);

        $query = "INSERT INTO cart(p_id, p_name, size, p_price, quantity, order_number, order_date) 
                  VALUES ($pid, '$product_name', '$size', $product_price, 1, '$order_number', '$order_date') 
                  ON DUPLICATE KEY UPDATE quantity = quantity + 1";

        $data = mysqli_query($conn, $query);

        if ($data) {
            echo "<script type='text/javascript'>
                alert('Successfully added to cart!');
            </script>";
            header("Location: cart.php");
        } else {
            echo "<script type='text/javascript'>
                alert('Failed!');
            </script>";
        }
    }
    
    $conn->close();
}

?>
