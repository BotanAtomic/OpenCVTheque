<?php
include("entity/Account.php");

session_start();

if (isset($_SESSION["account"])) {
    $account = $_SESSION["account"];
    if ($account instanceof Account) {
        header('Location: .');
        return;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>OpenCvTheque - Inscription</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="layout/css/base.css">
    <link rel="stylesheet" href="layout/css/grid.css">
    <link rel="stylesheet" href="layout/css/elements.css">
    <link rel="stylesheet" href="layout/css/layout.css">
    <link rel="stylesheet" type="text/css" href="layout/css/util.css">
    <link rel="stylesheet" type="text/css" href="layout/css/login.css">
</head>
<body>
<div id="wrap">
    <?php
        $index = 4;
        include('includes/navigation.php');
    ?>
    <div id="content">
        <section>
            <div>
                <div class="row">
                    <div class="span12 text-center">
                        <div class="headline m-b-0">
                            <h3>Inscription</h3>
                        </div>
                        <div class="limiter">
                            <div class="container-login100">
                                <div class="wrap-login100 p-t-85 p-b-20">
                                    <form id="register_form" class="login100-form validate-form" method="post"
                                          action="function/register.php" onsubmit="return validateForm()">

                                        <p id="error_label" style="color:red; display:none;"></p>

                                        <div class="wrap-input100 validate-input m-t-30 m-b-35">
                                            <input name="name" class="input100" type="text" required>
                                            <span class="focus-input100" data-placeholder="Nom"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input name="forename" class="input100" type="text" required>
                                            <span class="focus-input100" data-placeholder="Prénom"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input id="email" name="email" class="input100" type="email" required>
                                            <span class="focus-input100" data-placeholder="Adresse email"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input id="password" name="password" class="input100" type="password"
                                                   required>
                                            <span class="focus-input100" data-placeholder="Mot de passe"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input id="password_confirmation" class="input100" type="password" required>
                                            <span class="focus-input100"
                                                  data-placeholder="Confirmation du mot de passe"></span>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button class="login100-form-btn">
                                                S'inscrire
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="layout/js/jquery-2.1.0.min.js"></script>
<script src="layout/js/waypoints/waypoints.min.js"></script>
<script src="layout/js/waypoints/waypoints-sticky.min.js"></script>
<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var passwordConfirmation = document.getElementById("password_confirmation").value;

        var errorLabel = document.getElementById("error_label");

        if (password.length < 4) {
            errorLabel.innerHTML = "Votre mot de passe doit contenir au moins 4 caractères";
            errorLabel.style.display = "inline";
            return false;
        }

        if (password !== passwordConfirmation) {
            errorLabel.innerHTML = "Les mots de passe ne correspondent pas";
            errorLabel.style.display = "inline";
            return false;
        }

        var email = document.getElementById("email").value;

        var request = new XMLHttpRequest();
        request.open("GET", "function/checkemail.php?email=" + email, false);
        request.send(null);

        if (request.responseText === "0") {
            errorLabel.innerHTML = "L'adresse email est déjà utilisée";
            errorLabel.style.display = "inline";
        }

        return request.responseText === "1";
    }

    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    });

    $(document).ready(function () {
        $('#nav').waypoint('sticky', {wrapper: '<div class="sticky-wrapper" />', stuckClass: 'stuck'})
    });
</script>
</body>
</html>
<script></script>