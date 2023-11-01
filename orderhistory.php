<?php
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: login.php"); 
}
else{?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="styles/cart.css">
</head>
<body style="background:black;">
<?php include("components/navbar.php") ?>

        <main>
        <div class="cart review">
        <h1 class="main-heading">Order History</h1>
            <div class="list">
                <table class="table-tot rev-table">
                    <tr class="headings">
                        <td>Product Name</td>
                        <td>Quantity</td>
                        <td>Sub-Total</td>

                    </tr>
                    <?php
                    include('config.php');
                    $customer_username = $_SESSION["username"];
                    $sql2 = "SELECT username,p_name,p_price,p_quantity FROM orderhistory join users on orderhistory.user_id=users.user_id join inventory on orderhistory.pid=inventory.pid where username='$customer_username'";  
                    $result = $conn ->query($sql2);
                        
                    if($result-> num_rows > 0) {  
                        while($row = $result-> fetch_assoc()) {
                            echo "<tr><td>".$row["p_name"]."</td><td>".$row["p_quantity"]."</td><td>".$row["p_price"]."$</td></tr>";

                        }
                        echo "</table>";  
                    }  
                    else {  
                        echo "<tr>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        </tr> ";
                    } 

                    ?>
                </table>
            </div>

        </main>
</body>

</html>

<?php }?>