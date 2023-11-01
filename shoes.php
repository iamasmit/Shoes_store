<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slides</title>
    <link rel="stylesheet" href="styles/products.css">
</head>
<body>
    <?php include("components/navbar.php"); ?>
    <main>
    <div class="items">
        <div class="heading">
            <h1>Shoes</h1>
        </div>
        <?php
        include_once("config.php");
        $results=$conn->query("select * from inventory where category='shoes' ");
        if($results->num_rows >0){
            while($shoes=$results->fetch_assoc()){
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

                        <label for="size">Select Size:</label>
                        <select name="size" id="size">
                            <option value="" selected disabled>Select Size</option>
                            <option value="6">Size 6</option>
                            <option value="7">Size 7</option>
                            <option value="8">Size 8</option>
                            <option value="9">Size 9</option>
                        </select>


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