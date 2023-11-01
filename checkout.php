<?php
session_start();
if(!isset($_SESSION['loggedIn'])){
    header("Location: login.php"); 
}
else{
include('config.php'); 
$customer_username = $_SESSION["username"];                 
$query = "select user_id from users where username='$customer_username'";
$data = mysqli_query($conn,$query);
if($data){
    $rs=$data->num_rows;
    if ($rs>=1) {
        $row = mysqli_fetch_assoc($data);
        $u_id=$row['user_id'];
        $query2="select p_name,p_price,quantity,p_id from cart";
        $data2 = mysqli_query($conn,$query2);
        if($data2){
            $rs2=$data2->num_rows;
            if($rs2>0) {
                
                while($row2 = $data2-> fetch_assoc()) {
                    $p_id=$row2['p_id'];
                    $p_quantity=$row2['quantity'];
                    $query3="insert into orderhistory (user_id,pid,p_quantity) values($u_id,$p_id,$p_quantity)";
                    $q3 =mysqli_query($conn,$query3);
                }
                echo "
                <script type='text/javascript'>
                    alert('Successfully added to cart!');
                </script>";
                header("Location: receipt.php");
            }    
        } 
        else {
            echo "
                <script type= 'text/javascript'>
                    alert('Failed!');
                </script>";
        }
        }
    }
    $conn->close();
}
?>