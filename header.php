<!DOCTYPE HTML>
<html lang="en">
<?php
$base_url = $_SERVER['HTTP_HOST'];
$self = $_SERVER['PHP_SELF'];
$arr = explode("/", $self);
$with_ext = $arr['2'];
$arr2 = explode(".", $with_ext);
$page = $arr2['0'];
?>

<head>
    <title>Shot Technologies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="template" content="content-page" />
    <meta name="robots" content="noindex" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="content/dam/web/en/global-resource/designs/css/commonstylesNew.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="./assets/images/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/favicon.png" />
    <link id="favicon" href="./assets/images/favicon.png" rel="shortcut icon" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="./assets/css/mouse-cursor.css" rel="stylesheet" />
    <link href="./assets/css/style.css" rel="stylesheet" />

    <script type="text/javascript" src="content/dam/web/en/global-resource/designs/js/fix-urls.js"></script>
    <script type="text/javascript" src="clientlibs/web/clientlibs/clientlib-dependencies.js"></script>
    <script type="text/javascript" src="https://unpkg.com/aos@2.3.0/dist/aos.js"></script>

    <?php
    if ($page != 'index') {
    ?>
        <link rel="stylesheet" href="inner/css/animate.css">
        <link rel="stylesheet" href="inner/css/style.css">
    <?php
    }
    ?>
</head>

<body class="page basepage basicpage <?php echo $page ?>">
    <div id="cursor">
        <div class="cursor__circle"></div>
    </div>
    <div>
        <div class="root responsivegrid">

            <div class="aem-Grid aem-Grid--12 aem-Grid--default--12 ">

                <div class="pagedetails parbase aem-GridColumn aem-GridColumn--default--12"></div>
                <div class="header aem-GridColumn aem-GridColumn--default--12">
                    <header>
                        <nav class="navbar navbar-default scrollbg-show " role="navigation">
                            <div class="container mt45">
                                <div class="navbar-header page-scroll">
                                    <a class="navbar-brand" href="/">
                                        <img src="./assets/images/shot-logo.png">
                                    </a>
                                </div>
                                <div class="header-menu hidden-tab">
                                    <ul class="nav navbar-nav navbar-right top-nav">
                                        <li><img src="./assets/images/phone-icon.png" /> <a href="tel:+923333906233" title="+923333906233">+92-333-3906-233</a> </li>
                                        <li><img src="./assets/images/mail-icon.png" /> <a href="mailto:info@shottechnologies.co" title="info@shottechnologies.co">info@shottechnologies.co</a> </li>
                                    </ul>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li> <a href="/" title="Home">Home</a> </li>
                                        <li> <a href="about" title="About Shot technologies">About Us</a> </li>
                                        <li> <a href="ourservices" title="Our Services">Our Services</a> </li>
                                        <li> <a href="ourportfolio" title="Our Portfolio">Our Portfolio</a> </li>
                                        <li> <a href="career" title="Career">Career</a> </li>
                                        <li> <a href="contactus" title="Contact Us">Contact Us</a> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="progressbar">
                                <div class="width"></div>
                            </div>
                        </nav>
                    </header>
                </div>
                <div class="experiencefragment aem-GridColumn aem-GridColumn--default--12">

                    <div class="xf-content-height">

                        <div class="aem-Grid aem-Grid--12 aem-Grid--default--12 ">

                            <div class="freeflowhtml aem-GridColumn aem-GridColumn--default--12">
                                <!-- Custom CSS -->
                                <link href="content/dam/web/burger-menu/en/css/burger-menu.css" rel="stylesheet">

                                <!-- Burger Menu START -->
                                <div class="burger-search-wrapper navbar-fixed-top">
                                    <div class="container">
                                        <div class="hamburger-menu">
                                            <div class="menu-bg"></div>
                                            <div class="circle"></div>
                                            <div class="menu">
                                                <div class="col-md-4 col-sm-12 col-xs-12 menuItems">
                                                    <a href="/"> <img src="./assets/images/shot-logo.png" alt="shot" class="img-responsive logo-inner"> </a>
                                                    <ul class="list-unstyled">
                                                        <li class="" title="Home"> <a href="/" title="Home" class="" target="_self">Home<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <li class="" title="About Us"> <a href="about" title="About Us" class="" target="_self">About Us<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <li class="" title="Services"> <a href="ourservices" title="Services" class="services" target="_self">Our Services<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <li class="" title="Portfolio"> <a href="ourportfolio" title="Portfolio" class="" target="_self">Our Portfolio<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <li class="" title="Contact Us"> <a href="contactus" title="Contact Us" class="" target="_self">Contact Us<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <li class="" title="Career"> <a href="career" title="Career" class="" target="_self">Career<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>
                                                        <!--<li class="" title="Blog"> <a href="javascript:void(0)" title="Blog" class="" target="_self">Blog<span class="un-line hidden-sm hidden-xs hidden-tab"></span> </a> </li>-->
                                                        <div class="menu-social-links">
                                                            <ul>
                                                                <li>
                                                                    <a title="Facebook" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" href="https://www.facebook.com/Shot-Technologies-Pvt-Ltd-108207918017087">
                                                                        <i class="fa fa-facebook"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a title="instagram" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom" href="https://www.instagram.com/shottechnologies/">
                                                                        <i class="fa fa-instagram"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="burger">
                                                <div class="icon-bar1"></div>
                                                <div class="icon-bar2"></div>
                                                <div class="icon-bar3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Burger Menu End -->
                                <!-- Custom JS -->
                                <script type="text/javascript" src="content/dam/web/burger-menu/en/js/burger-menu.js"></script>

                            </div>

                        </div>
                    </div>
                </div>