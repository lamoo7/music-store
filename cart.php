<?php require_once "utilities/accountDataLogic.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="utilities/favicon.ico" type="image/x-icon">
  <script src="https://unpkg.com/htmx.org@1.9.6"></script>
  <title>Music Store</title>
</head>

<body>

  <?php require_once "menu.html"; ?>

  <div id="content" style="display:flex; align-items: flex-start;">
    <table class="cart-table">
      <thead>
        <tr>
          <th colspan="2">Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $userEmail = $user['email'];
        $sql = "SELECT * FROM cart WHERE customer = '$userEmail'";
        $result = $conn->query($sql);
        $totalPrice = 0;

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $item = htmlspecialchars($row['item']);
            $price = number_format($row['price'], 2);
            $amount = $row['amount'];
            $id = $row['id'];

            $subtotal = number_format($price * $amount, 2);
            $totalPrice += $price * $amount;

            echo '
                  <tr>
                    <td><img src="music/' . trim(explode(" - ", $item)[0]) . '.png"></td>
                    <td>
                      <p>' . $item . '</p>
                    </td>
                    <td>' . $price . '$</td>
                    <td>
                      <div class="quantity-input">
                        <button class="quantity-minus" hx-post="utilities/decrementAmount.php?id=' . $id . '" hx-trigger="click" hx-swap="innerHTML" hx-target="#quantity-' . $id . '">-</button>
                        <div id="quantity-' . $id . '">' . $amount . '</div>
                        <button class="quantity-plus" hx-post="utilities/incrementAmount.php?id=' . $id . '" hx-trigger="click" hx-swap="innerHTML" hx-target="#quantity-' . $id . '">+</button>
                      </div>
                    </td>
                    <td class="subtotal" hx-post="utilities/updateSubtotal.php?id=' . $id . '" hx-trigger="every 500ms">' . $subtotal . '$</td>
                    <td>
                      <img src="utilities/icon-delete.png" style="width: 20px; cursor: pointer" alt="remove product"
                       hx-post="utilities/deleteFromCartTable.php?id=' . $id . '" hx-target="closest tr" hx-swap="outerHTML">
                    </td>
                  </tr>
                ';
          }

        } else {
          echo '<tr><td colspan="6">Your cart is empty</td></tr>';
        }

        $conn->close();
        ?>
      </tbody>
    </table>
    <div id="checkout">
      <h2>Summary</h2>
      <div style="display: flex; justify-content: space-between;">
        <h4>Total Price :</h4>
        <h3 id="totalPrice" hx-get="utilities/updateTotalPrice.php" hx-trigger="every 500ms">
          <?php echo number_format($totalPrice, 2); ?>$
        </h3>
      </div>

      <input type="submit" value="Continue to checkout">

      <p>Got a gift card or voucher? Redeem it here</p>
      <input type="text">

      <p>Go back to shopping <a href="store.php">here</a></p>
    </div>


    <?php require_once "footer.html"; ?>

  </div>

</body>

</html>