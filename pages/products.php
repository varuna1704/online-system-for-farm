<?php

include __DIR__ . '/../includes/con_pg.php';

if(isset($_POST['add_to_cart']))
{
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
   $product_quantity=1;
   
   $select_cart =  pg_query($conn,"SELECT * FROM cart WHERE nme = '$product_name");
   
   if($pg_num_rows($select_cart)>0)
   {
       $message[]='product already added to cart';
   }
   else 
   {
       $insert_product = pg_query($conn,"INSERT INTO cart(name,price,image,quantity)VALUES('$product_name','$product_price','$product_image','$product_quntity')");
       $message[]='product  added To cart succesfully';
   }
   
       
   }
   ?>
   



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
      
        <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- comment -->
        <title>PRODUCTS</title>
        <link rel="stylesheet" href="../css/style.css"><!-- comment -->
    </head><!-- comment -->
    <body>
        
        
        <?php
        
        if(isset($meesage))
        {
            foreach($message as $message)
            {
                echo '<div class="message"><span>'.$message.'</span> <i class=  "fas fa-times" onclick=" this.parentElement.style.display= "none";"></i></div>';
            };
        };
    ?>

        <div class="container">
            <section class="products">
                <h1 class="heading">Latest products</h1>
                <div class="box-container"><!-- comment -->
                    
                <?php
                $select_products =pg_query($conn, "SELECT * FROM products");
                if(pg_num_rows($select_products)>0)
                {
                while($fetch_product=pg_fetch_asssoc($select_products))
                {
                    ?>
                    
                    <form action=" " method="post">
                        <div class="box">
                            <img src="images/<?php echo $fetch_product['image'];?>" alt=""><!-- comment -->
                            <h3><?php echo $fetch_product['name'];?></h3>
                            <div class="price">â‚¹<?php echo $fetch_product['price'];?>/-</div><!-- comment -->
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name'];?>"><!-- comment -->
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price'];?>"><!-- comment -->
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image'];?>"><!-- comment -->
                            <input type="submit" class="btn" value="add to cart" name="add to cart">
        </div>
                    </form>
        <?php
                };
                };
                ?>
                </div>
            </section>
        </div>
        <script src="../js/script.js"></script>
    </body>
        </html>
        
        
        

