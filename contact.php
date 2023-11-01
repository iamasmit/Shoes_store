<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('config.php');

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // SQL query to insert the contact request into the database
    $insertQuery = "INSERT INTO contact_requests (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($insertQuery) === TRUE) {
        // Insertion successful
        header("location:contact.php?success=true");
    } else {
        // Insertion failed
        echo "
            <script type='text/javascript'>
                alert('Failed to send your message. Please try again later.');
            </script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/contact.css">
    <title>Contact Us</title>
</head>
<body>
    <?php include("components/navbar.php"); ?>
    <div class="heading">
        <h1>Contact Us</h1>
        <p>Feel free to get in touch with us.</p>
    </div>
    
    <div class="contact-container">
        <div class="contact-details">
            <p><strong>Address:</strong> 123 Main St, City</p>
            <p><strong>Phone:</strong> (123) 456-7890</p>
            <p><strong>Email:</strong> contact@example.com</p>
        </div>
        <div class="contact-form">
            <form method="POST" action="contact.php"> 
              
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Send</button>
                <?php
                // Check if the form was successfully submitted
                if (isset($_GET['success']) && $_GET['success'] == 'true') {
                    echo '<p style="color: green;">We have received your request!</p>';
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>
