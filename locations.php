<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations • Music Store</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="utilities/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php require_once "menu.html"; ?>

    <div id="content">

        <div id="location-wrapper">
            <div class="location" style="background-image: url('locations/denver.jpg')">
                <div class="loc__content">
                    <p>625 Pennsylvania St APT 105, CO 80203</p>
                    <h2>Denver, USA</h2>
                </div>
            </div>
            <div class="location" style="background-image: url('locations/newyork.jpg')">
                <div class="loc__content">
                    <p>92-30 168th St, Queens, NY 11433</p>
                    <h2>New York, USA</h2>
                </div>
            </div>
            <div class="location" style="background-image: url('locations/vancouver.jpg')">
                <div class="loc__content">
                    <p>4393 St George St, BC V5V 4A3</p>
                    <h2>Vancouver, CA</h2>
                </div>
            </div>
            <div class="location" style="background-image: url('locations/berlin.jpg')">
                <div class="loc__content">
                    <p>Badstraße 66, 13357</p>
                    <h2>Berlin, DE</h2>
                </div>
            </div>
            <div class="location" style="background-image: url('locations/praga.jpg')">
                <div class="loc__content">
                    <p>Na Květnici 700, 140 00 Praha 4-Nusle</p>
                    <h2>Praga, CZ</h2>
                </div>
            </div>
            <div class="location" style="background-image: url('locations/bucharest.jpg')">
                <div class="loc__content">
                    <p>Mall Park Lake, Str. Liviu Rebreanu 4, 031787</p>
                    <h2>Bucharest, RO</h2>
                </div>
            </div>
        </div>

        <?php require_once "footer.html"; ?>

    </div>

    <script src="script.js"></script>

</body>

</html>