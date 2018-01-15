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
    <title>OpenCvTheque - Connexion</title>
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
        $index = 3;
        include('includes/navigation.php');
    ?>
    <div id="content">
        <section>
            <div>
                <div class="row">
                    <div class="span12 text-center">
                        <div class="headline m-b-0">
                            <h3>Connexion</h3>
                        </div>
                        <div class="limiter">
                            <div class="container-login100">
                                <div class="wrap-login100 p-t-85 p-b-20">
                                    <form class="login100-form validate-form" onsubmit="return validateForm()">

                                        <span class="login100-form-avatar"><img src="layout/images/avatar.png"></span>
                                        <br>
                                        <p id="error_label" style="color:red; display:none;"></p>

                                        <div class="wrap-input100 validate-input m-t-30 m-b-35">
                                            <input id="email" class="input100" type="email" required>
                                            <span class="focus-input100" data-placeholder="Adresse email"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input id="password" class="input100" type="password">
                                            <span class="focus-input100" data-placeholder="Mot de passe"></span>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button class="login100-form-btn">
                                                Connexion
                                            </button>
                                        </div>
                                        <ul class="login-more p-t-30">
                                            <li class="m-b-8">
                                          <span class="txt1">Mot de passe oublié ?
                                          </span><a href="#" class="txt2">Récupérez le</a>
                                            </li>
                                            <li>
                                          <span class="txt1">
                                          Pas encore de compte ?
                                          </span><a href="register.php" class="txt2">Créer un compte</a>
                                            </li>
                                        </ul>
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
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var errorLabel = document.getElementById("error_label");

        const request = new XMLHttpRequest();

        request.onreadystatechange = function (event) {
            var response = request.responseText;

            if (response === "0") {
                errorLabel.innerHTML = "Nom de compte ou mot de passe incorrect";
                errorLabel.style.display = "inline";
            } else if (response === "1") {
                location = "";
            }
        };

        request.open('GET', "function/login.php?email=" + email + "&password=" + password, true);
        request.send(null);

        return false;
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