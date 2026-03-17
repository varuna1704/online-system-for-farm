<?php
include __DIR__ . '/../includes/con_pg.php';
require_once __DIR__ . '/../includes/path_helpers.php';

if(isset($_POST['add_product']))
{
   $p_name = $_POST['product_name'];
   $p_price = $_POST['product_price'];
   $p_image = basename($_FILES['product_image']['name'] ?? '');
   $p_image_tmp_name = $_FILES['product_image']['tmp_name'] ?? '';
   $p_image_folder = __DIR__ . '/../images/' . $p_image;
   $insert_query = pg_query($con, "INSERT INTO products(product_name, product_price, product_image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed.....');
   if($insert_query)
   {
      if($p_image !== '' && $p_image_tmp_name !== ''){
         move_uploaded_file($p_image_tmp_name, $p_image_folder);
      }
      $message[] = 'product add succesfully';
   }
   else
   {
      $message[] = 'could not add the product';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = pg_query($con, "DELETE FROM products WHERE product_id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      exit();
   }else{
      header('location:admin.php');
      exit();
   }
}

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $existing_image = $_POST['existing_image'] ?? '';
   $update_p_image = basename($_FILES['update_p_image']['name'] ?? '');
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'] ?? '';
   if($update_p_image === ''){
      $update_p_image = $existing_image;
   }
   $update_p_image_folder = __DIR__ . '/../images/' . $update_p_image;
   $update_query = pg_query($con, "UPDATE products SET product_name = '$update_p_name', product_price = '$update_p_price', product_image = '$update_p_image' WHERE product_id = '$update_p_id'");
   if($update_query)
   {
      if($update_p_image_tmp_name !== '' && $update_p_image !== ''){
         move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      }
      header('location:admin.php');
      exit();
   }else{
      header('location:admin.php');
      exit();
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>admin panel</title>
<style>
    body{
      background-color:#C0C0C0;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="../css/style_fert.css">
</head>
<body>
<?php
if(isset($message))
{
   foreach($message as $message)
   {
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = \'none\';"></i> </div>';
   }
}
?>

<?php include __DIR__ . '/../includes/header_fert.php'; ?>

<div class="container">
<section>
<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="text" name="product_name" placeholder="enter the product name" class="box" required>
   <input type="number" name="product_price" min="0" placeholder="enter the product price" class="box" required>
   <input type="file" name="product_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>
</section>

<section class="display-product-table">
   <table>
      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>Product Action</th>
      </thead>
      <tbody>
         <?php
            $select_products = pg_query($con, "SELECT * FROM products");
            if(pg_num_rows($select_products) > 0)
            {
               while($row = pg_fetch_assoc($select_products))
               {
         ?>
         <tr>
            <td><img src="<?php echo htmlspecialchars(osf_resolve_image_path($row['product_image']), ENT_QUOTES, 'UTF-8'); ?>" height="100" alt=""></td>
            <td><?php echo htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($row['product_price'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['product_id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"><i class="fas fa-trash"></i> delete</a>
               <a href="admin.php?edit=<?php echo $row['product_id']; ?>" class="option-btn"><i class="fas fa-edit"></i> update</a>
            </td>
         </tr>
         <?php
               }
            }else{
               echo "<div class='empty'>no product added</div>";
            }
         ?>
      </tbody>
   </table>
</section>

<section class="edit-form-container">
   <?php
   if(isset($_GET['edit']))
   {
      $edit_id = $_GET['edit'];
      $edit_query = pg_query($con, "SELECT * FROM products WHERE product_id = $edit_id");
      if(pg_num_rows($edit_query) > 0)
      {
         while($fetch_edit = pg_fetch_assoc($edit_query))
         {
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <img src="<?php echo htmlspecialchars(osf_resolve_image_path($fetch_edit['product_image']), ENT_QUOTES, 'UTF-8'); ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['product_id']; ?>">
      <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($fetch_edit['product_image'], ENT_QUOTES, 'UTF-8'); ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo htmlspecialchars($fetch_edit['product_name'], ENT_QUOTES, 'UTF-8'); ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo htmlspecialchars($fetch_edit['product_price'], ENT_QUOTES, 'UTF-8'); ?>">
      <input type="file" class="box" name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the product" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>
   <?php
         }
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      }
   }
   ?>
</section>
</div>
<script src="../js/script.js"></script>
</body>
</html>
