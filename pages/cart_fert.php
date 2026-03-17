<?php
include __DIR__ . '/../includes/header.php';
include __DIR__ . '/../includes/con_pg.php';
require_once __DIR__ . '/../includes/path_helpers.php';

if(isset($_POST['update_update_btn']))
{
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = pg_query($con, "UPDATE cart SET product_quantity = '$update_value' WHERE cid = '$update_id'");
   if($update_quantity_query)
   {
      header('location:cart_fert.php');
      exit();
   }
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   pg_query($con, "DELETE FROM cart WHERE cid = '$remove_id'");
   header('location:cart_fert.php');
   exit();
}

if(isset($_GET['delete_all'])){
   pg_query($con, "DELETE FROM cart");
   header('location:cart_fert.php');
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Display Selected Fertilizer List</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../css/style_fert.css">
   <style>
      body{ background-color:#C0C0C0; }
   </style>
</head>
<body>
<div class="container">
<section class="shopping-cart">
   <h1 class="heading">Fertilizer List</h1>
   <table>
      <thead>
         <th>Image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <?php
      $select_cart = pg_query($con, "SELECT * FROM cart");
      $grand_total = 0;
      if(pg_num_rows($select_cart) > 0)
      {
         while($fetch_cart = pg_fetch_assoc($select_cart))
         {
            $sub_total = (float)$fetch_cart['product_price'] * (int)$fetch_cart['product_quantity'];
      ?>
      <tr>
         <td><img src="<?php echo htmlspecialchars(osf_resolve_image_path($fetch_cart['product_image']), ENT_QUOTES, 'UTF-8'); ?>" height="100" alt=""></td>
         <td><?php echo htmlspecialchars($fetch_cart['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
         <td>&#8377;<?php echo number_format((float)$fetch_cart['product_price']); ?>/-</td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['cid']; ?>">
               <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['product_quantity']; ?>">
               <input type="submit" value="update" name="update_update_btn">
            </form>
         </td>
         <td>&#8377;<?php echo number_format($sub_total); ?>/-</td>
         <td><a href="cart_fert.php?remove=<?php echo $fetch_cart['cid']; ?>" onclick="return confirm('remove Fertilizer from cart?')" class="delete-btn"><i class="fas fa-trash"></i> remove</a></td>
      </tr>
      <?php
            $grand_total += $sub_total;
         }
      }
      ?>
      <tr class="table-bottom">
         <td><a href="fertilizer.php" class="option-btn" style="margin-top: 0;">continue Purchasing</a></td>
         <td colspan="3">grand total</td>
         <td>&#8377;<?php echo number_format($grand_total); ?>/-</td>
         <td><a href="cart_fert.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"><i class="fas fa-trash"></i> delete all</a></td>
      </tr>
   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>
</section>
</div>
<script src="../js/script.js"></script>
</body>
</html>
