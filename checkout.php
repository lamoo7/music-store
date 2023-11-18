<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout • Music Store</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="utilities/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php require_once "menu.html"; ?>

    <div id="content">

        <div class="mainscreen">
            <div class="card">
                <div class="leftside">
                    <img src="utilities/main.png" class="product">
                </div>
                <div class="rightside">
                    <form action="">
                        <h1>CheckOut</h1>
                        <h2>Payment Information</h2>
                        <p>Cardholder Name</p>
                        <input type="text" class="inputbox" name="name" required />
                        <p>Card Number</p>
                        <input type="number" maxlength="16" pattern="[0-9]*" inputmode="numeric" class="inputbox" name="card_number" id="card_number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />

                        <p>Card Type</p>
                        <select class="inputbox" name="card_type" id="card_type" required>
                            <option value="">--Select a Card Type--</option>
                            <option value="Visa">Visa</option>
                            <option value="MasterCard">MasterCard</option>
                        </select>
                        <div class="expcvv">

                            <p class="expcvv_text">Expiry</p>
                            <input type="date" class="inputbox" name="exp_date" id="exp_date" required />

                            <p class="expcvv_text2">CVV</p>
                            <input type="number" maxlength="3" pattern="[0-9]*" inputmode="numeric" min="1" max="999" class="inputbox" name="cvv" id="cvv" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required />
                        </div>
                        <button type="submit" class="button">CheckOut</button>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once "footer.html"; ?>

    </div>

    <script src="script.js"></script>

</body>

</html>