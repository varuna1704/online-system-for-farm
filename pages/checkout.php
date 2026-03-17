<?php
@include __DIR__ . '/../includes/Config.php';

$order_message = '';
$order_error = '';
$cart_items = array();
$grand_total = 0;

$cart_query = pg_query($con, "SELECT * FROM cart");
if ($cart_query && pg_num_rows($cart_query) > 0) {
    while ($item = pg_fetch_assoc($cart_query)) {
        $cart_items[] = $item;
        $grand_total += (float)$item['product_price'] * (int)$item['product_quantity'];
    }
}

if (isset($_POST['order_btn'])) {
    $name = trim($_POST['name'] ?? '');
    $number = trim($_POST['onumber'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $method = trim($_POST['omethod'] ?? '');
    $flat = trim($_POST['flat'] ?? '');
    $street = trim($_POST['street'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $pin_code = trim($_POST['pin_code'] ?? '');

    if (count($cart_items) === 0) {
        $order_error = 'Your cart is empty.';
    } else {
        $product_lines = array();
        foreach ($cart_items as $product_item) {
            $product_lines[] = $product_item['product_name'] . ' (' . (int)$product_item['product_quantity'] . ')';
        }

        $total_product = implode(', ', $product_lines);
        @pg_query($con, "DELETE FROM cart");
        $cart_items = array();

        $order_message = "
        <div class='order-message-container'>
            <div class='message-container'>
                <h3>thank you for shopping!</h3>
                <div class='order-detail'>
                    <span>" . htmlspecialchars($total_product, ENT_QUOTES, 'UTF-8') . "</span>
                    <span class='total'> total : &#8377;" . number_format($grand_total) . "/- </span>
                </div>
                <div class='customer-details'>
                    <p> your name : <span>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</span> </p>
                    <p> your number : <span>" . htmlspecialchars($number, ENT_QUOTES, 'UTF-8') . "</span> </p>
                    <p> your email : <span>" . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</span> </p>
                    <p> your address : <span>" . htmlspecialchars($flat . ', ' . $street . ', ' . $city . ', ' . $state . ', ' . $country . ' - ' . $pin_code, ENT_QUOTES, 'UTF-8') . "</span> </p>
                    <p> your payment mode : <span>" . htmlspecialchars($method, ENT_QUOTES, 'UTF-8') . "</span> </p>
                    <p>(*pay when product arrives*)</p>
                </div>
                <a href='fertilizer.php' class='btn'>continue shopping</a>
            </div>
        </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="../css/style.css">
   <style>
      body{
         background-color:#C0C0C0;
      }
      h1{
         text-align:center;
      }
   </style>
</head>
<body>
<?php include __DIR__ . '/../includes/header_logout.php'; ?>

<div class="container">
<?php echo $order_message; ?>

<?php if ($order_error !== ''): ?>
   <div class="message"><span><?php echo htmlspecialchars($order_error, ENT_QUOTES, 'UTF-8'); ?></span></div>
<?php endif; ?>

<section class="checkout-form">
   <h1 class="heading"><b>complete your order</b></h1>

   <form action="" method="post">
      <div class="display-order">
         <?php if (count($cart_items) > 0): ?>
            <?php foreach ($cart_items as $fetch_cart): ?>
               <span><?php echo htmlspecialchars($fetch_cart['product_name'], ENT_QUOTES, 'UTF-8'); ?>(<?php echo (int)$fetch_cart['product_quantity']; ?>)</span>
            <?php endforeach; ?>
            <span class="grand-total"> grand total : &#8377;<?php echo number_format($grand_total); ?>/- </span>
         <?php else: ?>
            <span>your cart is empty!</span>
         <?php endif; ?>
      </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="onumber" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="omethod">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>
</section>
</div>

<?php include __DIR__ . '/../includes/footer_agri.php'; ?>
<script src="../js/script.js"></script>
</body>
</html>
