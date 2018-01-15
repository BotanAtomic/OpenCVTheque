<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once "entity/Account.php";
require_once "includes/header.php";

$connected = (isset($_SESSION["account"]) && $_SESSION["account"] instanceof Account);


if ($connected) {
    $account = $_SESSION["account"];
}

?>


<header>
    <div id="header">
        <div class="sticky-wrapper" style="">
            <div id="nav" class="">
                <div class="row">
                    <div class="span3">
                        <a href="" id="logo">
                            OpenCVTheque
                        </a>
                    </div>
                    <nav>
                        <div class="span9">
                            <a href="#" id="mobile-menu-trigger" class="mobile-menu-closed"><i class="fa fa-bars"></i>
                            </a>
                            <ul class="sf-menu sf-js-enabled" id="menu">
                                <li id="1">
                                    <a href="index.php"><span class="glyphicon glyphicon-home"></span> Acceuil</a>
                                </li>
                                <li id="2">
                                    <a href=""><span class="glyphicon glyphicon-search"></span> Rechercher</a>
                                    <ul>
                                        <li>
                                            <a href=""><span class="glyphicon glyphicon-briefcase"></span>
                                                EMPLOI</a>
                                        </li>
                                        <li>
                                            <a href=""><span class="glyphicon glyphicon-education"></span> CV</a>
                                        </li>
                                    </ul>
                                </li>

                                <?php
                                if ($connected) {
                                    print '
                                    <li id="5">
                                        <a href="register.php"><span class="glyphicon glyphicon-user"></span> Bienvenue ' . $account->getForename() . '</a>
                                        <ul>
                                            <li>
                                                <a href="my_offers.php"><span class="glyphicon glyphicon-briefcase"></span>
                                                    MES OFFRES</a>
                                            </li>
                                            <li>
                                                <a href="my_cv.php"><span class="glyphicon glyphicon-education"></span> MES CV</a>
                                            </li>
                                            <li>
                                                <a href="function/disconnect.php"><span class="glyphicon glyphicon-log-out"></span> Deconnexion</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ';

                                } else {
                                    print ' 
                                    <li id="3">
                                        <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Connexion</a>
                                    </li>
                                    <li id="4">
                                        <a href="register.php"><span class="glyphicon glyphicon-user"></span> Inscription</a>
                                    </li>';
                                }
                                ?>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.getElementById(<?php echo "'$index'"; ?>).setAttribute("class", "active");
</script>