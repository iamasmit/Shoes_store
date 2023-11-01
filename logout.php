<?php
    include('config.php');
    $sql = "DELETE FROM cart";
    $data = mysqli_query($conn,$sql);
    if($data){
        session_start();
        $_SESSION=array();
        unset($_SESSION['loggedIn']);  
        session_destroy();
        header("location:login.php");
    }
    else{
        echo "<script type= 'text/javascript'>
            alert('Logout Failed');
        </script>";
    }
    
?>