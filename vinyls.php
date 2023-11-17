<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="utilities/favicon.ico" type="image/x-icon">
	<script src="https://unpkg.com/htmx.org@1.9.4"></script>
	<title>Music Store</title>
</head>

<body>
	<?php require_once "menu.html"; ?>

	<div id="content">
		<div id="vinyls">
			<a href="" class="vinyl">
				<img src="music/ten thousand fists.png" id="album">
				<img src="utilities/vinyl.png" id="vinyl">
				<h2>Disturbed - Ten Thousand Fists</h2>
			</a>

			<a href="" class="vinyl">
				<img src="music/the sickness.png" id="album">
				<img src="utilities/vinyl.png" id="vinyl">
				<h2>Disturbed - The Sickness</h2>
			</a>

			<a href="" class="vinyl">
				<img src="music/shadow zone.png" id="album">
				<img src="utilities/vinyl.png" id="vinyl">
				<h2>StaticX - Shadow Zone</h2>
			</a>

			<a href="" class="vinyl">
				<img src="music/wisconsin death trip.png" id="album">
				<img src="utilities/vinyl.png" id="vinyl">
				<h2>StaticX - Wisconsin Death Trip</h2>
			</a>
		</div>


		<h1 style="text-align: center; margin: 5em 0; margin-left: 5rem; transition: all 600ms ease">More Vinyls Coming
			Soon...</h1>

		<?php require_once "footer.html"; ?>
	</div>

</body>

</html>