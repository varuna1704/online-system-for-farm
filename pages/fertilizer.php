<?php
include __DIR__ . '/../includes/con_pg.php';
require_once __DIR__ . '/../includes/path_helpers.php';

if(isset($_POST['add_to_cart']))
{
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;
   $select_cart = pg_query($con, "SELECT * FROM cart WHERE product_name = '$product_name'");
   if(pg_num_rows($select_cart) > 0)
   {
      $message[] = 'Crop Fertilizers already added to cart';
   }
   else
   {
      $insert_product = pg_query($con, "INSERT INTO cart(product_name, product_price, product_image, product_quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'Fertilizer added to cart succesfully';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Fertilizer</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../css/style_fert.css">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}
?>

<?php include __DIR__ . '/../includes/header_fert.php'; ?>

<div class="container">
<section class="products">
   <h1 class="heading">latest Fertilizer</h1>
   <div class="box-container">
      <?php
      $select_products = pg_query($con, "SELECT * FROM products");
      if(pg_num_rows($select_products) > 0){
         while($fetch_product = pg_fetch_assoc($select_products)){
      ?>
      <form action="" method="post">
         <div class="box">
            <img src="<?php echo htmlspecialchars(osf_resolve_image_path($fetch_product['product_image']), ENT_QUOTES, 'UTF-8'); ?>" alt="">
            <h3><?php echo htmlspecialchars($fetch_product['product_name'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <div class="price">&#8377;<?php echo htmlspecialchars($fetch_product['product_price'], ENT_QUOTES, 'UTF-8'); ?></div>
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_product['product_name'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_product['product_price'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_product['product_image'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>
      <?php
         }
      }
      ?>
   </div>
</section>
</div>

<script src="../js/script.js"></script>
</body>
</html>
