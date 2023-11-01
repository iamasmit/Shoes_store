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
    <title>Order Receipt</title>
    <link rel="stylesheet" href="styles/receipt.css">
</head>
<body>
<?php include("components/navbar.php"); ?>
    <main>

        <div class="table">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>

                <?php
                require_once('config.php');
                $customEmail = $_SESSION["username"];
                $sql = "select quantity,p_name,p_price from cart";  
                $result = $conn -> query($sql);
                if($result-> num_rows > 0) {  
                    while($row = $result-> fetch_assoc()) {
                        echo "<tr><td>".$row["p_name"]."</td><td>".$row["quantity"]."</td><td>".$row["p_price"]*$row["quantity"],'$'."</td></tr>";
                    }
                    echo "</table>";?>
            <div class="total">
                <h3 class="heading">Total Bill: 
               <?php include('config.php');
                error_reporting(0); 

                $sql2 = "SELECT SUM(p_price*quantity) AS totalAmount FROM cart";  
                $result2 = $conn -> query($sql2);
                
                if($result2-> num_rows > 0) {

                   // $total_drops = $row['a'];
                   $row2 = $result2-> fetch_assoc();
                    $total = $row2['totalAmount'];
                    echo $total,"$";

                }  
                else {  
                    echo "Record Not Found";
                }
            ?> </h3>
            </div> <?php
                    $query2= "DELETE FROM cart";
                    $q2=$conn->query($query2);
                    if($q2){
                        echo "
                        <h2 class='heading'>Take the screenshot of your reciept!</h2>";
                    }
                }  
                else {  
                    echo 
                    "<tr>
                    <td> - </td>
                    <td> - </td>
                    <td> - </td>
                    </tr> ";
                }
                $conn->close(); 
                ?>
            </table>
            
        </div>
    </main>
</body>
</html>
           <?php }?>