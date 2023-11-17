<?php
session_start();

if (isset($_COOKIE['searchInput'])) {
	$searchInput = $_COOKIE['searchInput'];
} else {
	$searchInput = "";
}

?>
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

	<div id="content">

		<div id="search-section">
			<div class="flex" id="input-div">
				<input type="text" value="<?php echo $searchInput; ?>" id="searchAlbums"
					placeholder="Search for albums by title, artist, or release year"
					hx-post="utilities/getProducts.php" name="searchTerm" hx-target="#content-store"
					hx-trigger="load, keyup changed delay:500ms, search">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
					<path
						d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
				</svg>
			</div>

			<div class="flex" style="align-items: inherit">
				<a href="cart.php" class="actions">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
						<path
							d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
					</svg>Shopping Cart <span class="cart-count" id="cart-count">
						<?php require_once "utilities/cartCount.php" ?>
					</span>
				</a>

				<a href="account.php" class="actions">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
						<path
							d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
					</svg>Your Account
				</a>
			</div>
		</div>

		<div id="product-show">
			<h4 id="text">Type something in the search bar...</h4>

			<p>Recommended to you</p>
			<div class="horizontal-snap">
				<?php
				require_once "utilities/config.php";

				$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 15";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {

					while ($row = $result->fetch_assoc()) {
						$albumTitle = $row["album"];
						$albumImage = "music/" . $albumTitle . ".png";
						echo '<div class="product__blur" style="background-image: url(\'' . $albumImage . '\');" hx-get="utilities/buyProduct.php?album=' . $albumTitle . '" hx-swap="innerHTML" hx-target="#dialogElement" hx-trigger="click" onclick="document.getElementById(\'dialogElement\').showModal();">' . PHP_EOL;
						echo '  <div class="product">' . PHP_EOL;
						echo '    <img src="' . $albumImage . '">' . PHP_EOL;
						echo '    <h2>' . $albumTitle . '</h2>' . PHP_EOL;
						echo '    <h3>' . $row["artist"] . '</h3>' . PHP_EOL;
						echo '    <h4>' . $row["price"] . '$</h4>' . PHP_EOL;
						echo '  </div>' . PHP_EOL;
						echo '</div>' . PHP_EOL;
					}
				} else {
					echo "No products found in the database.";
				}
				?>
			</div>
		</div>

		<div id="content-store">
			<span class="loader" id="loading-indicator"></span>
		</div>

		<dialog id="dialogElement">
			<span class="loader"></span>
		</dialog>

		<?php require_once "footer.html"; ?>

	</div>

	<script src="script.js"></script>

</body>

</html>