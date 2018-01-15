<?php
include("entity/Account.php");

session_start();

if (!isset($_SESSION["account"]) || !($_SESSION["account"] instanceof Account)) {
    header('Location: .');
    return;
}

$account = $_SESSION["account"];

function normalize($string) {
    return htmlspecialchars($string);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>OpenCvTheque - Créer un CV</title>
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
    $index = 5;
    include('includes/navigation.php');
    ?>
    <div id="content">
        <section>
            <div>
                <div class="row">
                    <div class="span12 text-center">
                        <div class="headline m-b-0">
                            <h3>Créer un CV</h3>
                        </div>
                        <div class="limiter">
                            <div class="container-login100">
                                <div class="wrap-login100 p-t-85 p-b-20">
                                    <form id="cv_form" class="login100-form validate-form"
                                          onsubmit="return validateForm();">

                                        <input id="file_chooser" style="display: none;" type='file'
                                               onchange="readURL(this);"/>

                                        <span style="    cursor: pointer;" class="login100-form-avatar"><img id="blah"
                                                                                                             src="layout/images/avatar.png"
                                                                                                             onclick="openFileChooser();"></span>

                                        <br>
                                        <p id="error_label" style="color:red; display:none;"></p>

                                        <div class="wrap-input100 validate-input m-t-30 m-b-35">
                                            <input name="title" class="input100" type="text" required>
                                            <span class="focus-input100" data-placeholder="Intitulé du CV"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-t-30 m-b-35">
                                            <input name="name" class="input100" type="text" value="<?php echo normalize($account->getName());?>" required>
                                            <span class="focus-input100" data-placeholder="Nom de famille"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input name="forename" class="input100" type="text" value="<?php echo normalize($account->getForename());?>" required>
                                            <span class="focus-input100" data-placeholder="Prénom"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input name="email" class="input100" type="email" value="<?php echo normalize($account->getEmail());?>" required>
                                            <span class="focus-input100" data-placeholder="Adresse email"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input name="phone_number" class="input100" type="text" required>
                                            <span class="focus-input100" data-placeholder="Numéro de téléphone"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <input onkeyup="checkBirthDay()" name="birthday" class="input100" type="text" required>
                                            <span class="focus-input100"
                                                  data-placeholder="Date de naissance (Exemple : 24/02/1999)"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <textarea class="input100" name="address" cols="40" rows="5"
                                                      required></textarea>
                                            <span class="focus-input100"
                                            <span class="focus-input100" data-placeholder="Adresse postale"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <textarea class="input100" name="career" cols="500" rows="5"
                                                      required></textarea>
                                            <span class="focus-input100"
                                                  data-placeholder="Votre parcours professionel"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <textarea class="input100" name="training" cols="500" rows="5"
                                                      required></textarea>
                                            <span class="focus-input100" data-placeholder="Vos formations"></span>
                                        </div>
                                        <div class="wrap-input100 validate-input m-b-50">
                                            <textarea class="input100" name="languages" cols="500" rows="5"
                                                      required></textarea>
                                            <span class="focus-input100" data-placeholder="Langues et niveau"></span>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button id="validateButton" class="login100-form-btn">
                                                Valider&nbsp;<img id="loader" style="display : none;" src="layout/images/loader.gif" width="25" height="25"/>
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
    $('.input100').each(function () {
        if ($(this).val().trim() !== "") {
            $(this).addClass('has-val');
        }
        else {
            $(this).removeClass('has-val');
        }
    });

    function checkBirthDay() {
        var birthday = $('[name = "birthday"]');
        if(birthday.val().length === 2 || birthday.val().length === 5) {
            birthday.val(birthday.val() + "/");
        }
    }

    function validateForm() {
        $("#loader").attr("style", "");
        $("#validateButton").attr("disabled", "disabled");

        var birthday = $('[name = "birthday"]').val();
        var errorLabel = document.getElementById("error_label");

        var birthdaySplit = birthday.split("/");

        var date = new Date(parseInt(birthdaySplit[2]), parseInt(birthdaySplit[1]) - 1, parseInt(birthdaySplit[0]));

        if (isNaN(date.getTime()) || date.getTime() > new Date().getTime()) {
            errorLabel.innerHTML = "Date de naissance invalide";
            errorLabel.style.display = "inline";
            backToTop();
        } else {
            var formData = $('#cv_form').serializeArray();

            var imageSource = $('#blah').attr('src');

            if(imageSource.includes("base64")) {
                formData.push({name: "image", value: imageSource});
            }

            $.ajax({
                type: 'POST',
                url: 'function/create_cv.php',
                data: formData,
                success: function (data) {
                    if(data === "0") {
                        errorLabel.innerHTML = "Une erreur inconnu est survenue, contactez l'administrateur du site";
                        errorLabel.style.display = "inline";
                    } else if(data === "1") {
                        location = "my_cv.php?success=true";
                    }
                },
                async:true
            });

        }


        return false;
    }

    function backToTop() {
        document.documentElement.scrollTop = 0;
    }

    function openFileChooser() {
        $('#file_chooser').click();
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            if (!input.files[0].type.match('image.*')) {
                alert("Veuillez séléctionner une image");
                return;
            }

            reader.onload = function (e) {

                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    $('.input100').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() !== "") {
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