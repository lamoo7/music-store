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
    <style>
        #dialogElement {
            max-height: 70vh;
        }
    </style>
</head>

<body>
    <?php require_once "menu.html"; ?>

    <div id="content">

        <div class="container">

            <div class="user-details">

                <img src="utilities/<?php echo $user_gender; ?>.png">

                <h2><?php echo $user_name; ?></h2>

                <a href="cart.php" class="user-buttons" style="margin-right: 1em">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path
                            d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg>Shopping Cart
                </a>
                <div class="user-buttons" hx-get="utilities/getFavorites.php" hx-swap="innerHTML" hx-target="#dialogElement" hx-trigger="click" onclick="document.getElementById('dialogElement').showModal();">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                    </svg>Favorites
                </div>

                <p>Main Street No 47</p>
            </div>

            <div class="purchase-history">

                <h2>Purchase History</h2>

                <ul>
                    <li>
                        <div class="flex">
                            <strong>Order #12345</strong>
                            <p>Date: 2023-10-20</p>
                        </div>
                        <br>
                        <div class="flex">
                            <img src="music/The Sickness.png">
                            <img src="music/Believe.png">
                            <img src="music/Ten Thousand Fists.png">
                            <img src="music/Indestructible.png">
                            <img src="music/Asylum.png">
                            <img src="music/The Lost Children.png">
                            <img src="music/Immortalized.png">
                            <img src="music/Evolution.png">
                        </div>
                        <br>
                        <p class="price"><span>100$</span> via Mastercard</p>
                    </li>

                    <li>
                        <div class="flex">
                            <strong>Order #12345</strong>
                            <p>Date: 2023-10-20</p>
                        </div>
                        <br>
                        <div class="flex">
                            <img src="music/The Sickness.png">
                            <img src="music/Believe.png">
                            <img src="music/Ten Thousand Fists.png">
                            <img src="music/Indestructible.png">
                            <img src="music/Asylum.png">
                            <img src="music/The Lost Children.png">
                            <img src="music/Immortalized.png">
                            <img src="music/Evolution.png">
                        </div>
                        <br>
                        <p class="price"><span>100$</span> via Mastercard</p>
                    </li>
                </ul>
            </div>
        </div>

        <dialog id="dialogElement">
			<span class="loader"></span>
		</dialog>

        <?php require_once "footer.html"; ?>

    </div>

    <script src="script.js"></script>

</body>

</html>
