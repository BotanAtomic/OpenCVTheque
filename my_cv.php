<?php
include("entity/Account.php");
include("entity/CV.php");

include("includes/header.php");
include("function/generator.php");

if (!isset($_SESSION["account"]) || !($_SESSION["account"] instanceof Account)) {
    header('Location: .');
    return;
}

$account = $_SESSION["account"];

if (isset($_GET["remove"])) {
    $cvToRemove = $_GET["remove"];
    $statement = $database->prepare("SELECT * FROM cv WHERE id = ?;");
    $statement->bind_param("i", $cvToRemove);
    $statement->execute();
    $result = $statement->get_result();

    if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        if ($row["owner"] == $account->getId()) {
            $statement = $database->prepare("DELETE FROM cv WHERE id = ?;");
            $statement->bind_param("i", $cvToRemove);
            $statement->execute();
        }
    }

}


$statement = $database->prepare("SELECT * FROM cv WHERE owner = ?;");
$statement->bind_param("i", $account->getId());
$statement->execute();

$cvArray = array();

$result = $statement->get_result();

$i = 0;
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $cvArray[$i] = new CV($row);
    $i++;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>OpenCvTheque - CV</title>
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

                        <div class="headline">
                            <h3>MES CV</h3>
                        </div>

                        <?php
                        if (isset($_GET["success"]) && $_GET["success"] == "true" && !isset($_GET["remove"])) {
                            print '<p style="color : green;">Votre CV à été créer avec succès</p><br>';
                        }

                        if (isset($_GET["update"]) && $_GET["update"] == "true" && !isset($_GET["remove"])) {
                            print '<p style="color : green;">Votre CV à été mis à jours avec succès</p><br>';
                        }

                        if (isset($_GET["remove"])) {
                            print '<p style="color : red;">Votre CV à été supprimé avec succès</p><br>';
                        } else if ($i == 0) {
                            print "<p>Vous n'avez pas encore de CV</p><br>";
                        }
                        ?>
                    </div>


                </div>


                <div class="row">
                    <?php

                    foreach ($cvArray as $cv) {
                        echo generateCV($cv);
                    }

                    ?>

                    <div class="container-login100-form-btn">
                        <button class="cv-form-btn m-t-35 m-b-30" onclick="createCv()">
                            <span class="glyphicon glyphicon-plus"></span>&nbsp;NOUVEAU CV
                        </button>
                    </div>
                </div>
        </section>

    </div>
</div>
<script src="layout/js/jquery-2.1.0.min.js"></script>
<script src="layout/js/waypoints/waypoints.min.js"></script>
<script src="layout/js/waypoints/waypoints-sticky.min.js"></script>
<script>
    function createCv() {
        window.location.href = "cv_creator.php";
    }

    $(document).ready(function () {
        $('#nav').waypoint('sticky', {wrapper: '<div class="sticky-wrapper" />', stuckClass: 'stuck'})
    });
</script>
</body>
</html>
<script></script>