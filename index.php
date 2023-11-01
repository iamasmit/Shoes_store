<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles/products.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <?php include("components/navbar.php"); ?>
    <div class="hero-section">
        <h1 class="hero-heading">Welcome to The Shoe Store</h1>
    </div>
    <main>
        <div class="items">
            <div class="heading">
                <h1>Our Products</h1>
            </div>
            <?php
                include_once("config.php");
                $results=$conn->query("select * from inventory order by rand()");
                if($results->num_rows >0){
                    $i=1;
                    while($shoes=$results->fetch_assoc()){
                        $i++;
                        if($i>7){
                            break;
                        }
                        $p_id=$shoes["pid"];
                        $name=$shoes["p_name"];
                        $price=$shoes["p_price"];
                        $image_url=$shoes["image_url"];
                        echo '
                        <div class="product">
                            <form action="addTocart.php" method="POST">
                                <input type="hidden" name="name" value="'.$name.'"><h2>'.$name.'</h2>
                                <img class="image" src="'.$image_url.'" alt="shoe_img">
                                <input type="hidden" name="price" value="'.$price.'"><h2>$'.$price.'</h2>
                                <input type="hidden" name="pid" value="'.$p_id.'">
                                <button type="submit" name="submit" class="check">ADD TO CART</button>
                            </form>
                        </div>
                        ';
                    }
                }

            ?>

        </div>
    </main>
</body>


</html>