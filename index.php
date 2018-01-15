<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

    <title>OpenCvTheque - Acceuil</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="layout/css/base.css">
    <link rel="stylesheet" href="layout/css/grid.css">
    <link rel="stylesheet" href="layout/css/elements.css">
    <link rel="stylesheet" href="layout/css/layout.css">

</head>
<body>

<div id="wrap">
    <?php
        $index = 1;
        include("includes/navigation.php");
    ?>
    <div id="content">

        <section>
            <div >
                <br>

                <div class="row">
                    <div class="span12 text-center">

                        <div class="headline">

                            <p><span>Présentation</span></p>
                            <h3>OpenCvTheque ?</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="span4">

                        <ul class="personal-details">
                            <li style="color : red">Groupe n°1</li>
                            <li>Khadim Syilla</li>
                            <li>Mohamed El Digne</li>
                            <li>Yohan Lorem</li>
                            <li>Botan Ahmad</li>
                        </ul>

                    </div>
                    <div class="span5">

                        <h4 class="text-uppercase">PROJET</h4>

                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                            architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                            aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                            voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et
                            dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum
                            exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                            consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil
                            molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>

                    </div>
                </div>

            </div>
        </section>

        <section>
            <div id="work-experience">

                <div class="row">
                    <div class="span12 text-center">

                        <div class="headline">

                            <p><span>JOB & CV</span></p>
                            <br>
                            <h3>Dernières offres ?</h3>
                            <br>
                            <div class="row">

                                <div class="portfolio-filter">

                                    <ul>
                                        <li>
                                            <a class="active" data-filter="*" href="#">JOB</a>
                                        </li>
                                        <li>
                                            <a href="#" data-filter=".term-2">CV</a>
                                        </li>
                                    </ul>


                                </div>
                                <br>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="row cv-section">

                        <div class="span3">

                            <div class="cv-section-title">
                                <dates>Septembre 2013 - Juillet 2014</dates>
                                <br>
                                <grand>MbWay - Nice</grand>

                            </div>

                        </div>
                        <div class="span9">

                            <div class="cv-item">

                                <grand>MBA Manager en Développement Commercial</grand>

                                <p>
                                    Formation en alternance.<br><br>
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="row cv-section">

                        <div class="span3">

                            <div class="cv-section-title">
                                <dates>Septembre 2013 - Juillet 2014</dates>
                                <br>
                                <grand>MbWay - Nice</grand>

                            </div>

                        </div>
                        <div class="span9">

                            <div class="cv-item">

                                <grand>MBA Manager en Développement Commercial</grand>

                                <p>
                                    Formation en alternance.<br>
                                    <br>
                                </p>

                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </section>


    </div>
</div>

</div>

<script src="layout/js/jquery-2.1.0.min.js"></script>

<script src="layout/js/waypoints/waypoints.min.js"></script>
<script src="layout/js/waypoints/waypoints-sticky.min.js"></script>

<script>

    $("#go-down").click(function () {
        $('html, body').animate({
            scrollTop: $("#personal-profile").offset().top
        }, 700);
    });


    $(document).ready(function () {
        $('#nav').waypoint('sticky', {wrapper: '<div class="sticky-wrapper" />', stuckClass: 'stuck'})
    });
</script>

</body>
</html>