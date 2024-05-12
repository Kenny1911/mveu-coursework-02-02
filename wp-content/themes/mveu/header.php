<?php
declare(strict_types=1);

$baseUri = get_template_directory_uri();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUri ?>/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/gijgo.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/animate.min.css">
    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/slicknav.css">

    <link rel="stylesheet" href="<?php echo $baseUri ?>/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo $baseUri ?>/css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.html">
                                        <img src="<?php echo $baseUri ?>/img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-10">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.html">home</a></li>
                                            <li><a href="jobs.html">Browse Job</a></li>
                                            <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="candidate.html">Candidates </a></li>
                                                    <li><a href="job_details.html">job details </a></li>
                                                    <li><a href="elements.html">elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="single-blog.html">single-blog</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->
