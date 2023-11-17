<?php require_once "utilities/signupDataSubmission.php"; ?>

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
    <script src="https://kit.fontawesome.com/c48f0d09a5.js" crossorigin="anonymous"></script>
    <title>Music Store</title>
    <style>
        #content {
            display: grid;
            place-items: center;
        }
    </style>
</head>

<body>
    <?php require_once "menu.html"; ?>

    <div id="content">
        <div class="grid">

            <form action="" method="POST" class="form login">
                <h2>Sign Up</h2>
                <div id="errors"><?php
                    foreach ($errors as $error) {
                        echo '<p class="error">' . $error . '</p>';
                    }
                    ?></div>
                <div class="form__field">
                    <label for="login__fname">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </label>
                    <input autocomplete="fname" id="login__fname" type="text" name="fname" class="form__input gapped"
                        placeholder="First Name" required>

                    <label for="login__lname">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </label>
                    <input autocomplete="lname" id="login__lname" type="text" name="lname" class="form__input"
                        placeholder="Last Name" required>
                </div>

                <div class="form__field">
                    <label for="login__email">
                        <i class="fa-solid fa-at"></i>
                    </label>
                    <input autocomplete="email" id="login__email" type="email" name="email" class="form__input gapped"
                        placeholder="Email" required>


                    <label for="login__password">
                        <i class="fa-solid fa-venus-mars"></i>
                    </label>
                    <select name="gender" class="form__input">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Rather not say</option>
                    </select>
                </div>

                <div class="form__field">
                    <label for="login__password">
                        <i class="fa-solid fa-lock"></i>
                    </label>
                    <input id="login__password" type="password" name="password" class="form__input gapped"
                        placeholder="Password" required>

                    <label for="login__cpassword">
                        <i class="fa-solid fa-key"></i>
                    </label>
                    <input id="login__cpassword" type="password" name="cpassword" class="form__input"
                        placeholder="Confirm Password" required>
                </div>

                <div class="form__field">
                    <input type="submit" value="Sign Up">
                </div>

            </form>

            <p class="text--center">Already a member? <a href="login.php">Log In now</a> <i
                    class="fa-solid fa-circle-arrow-right"></i></p>

        </div>

        <?php require_once "footer.html"; ?>
    </div>

    <script src="script.js"></script>
</body>

</html>