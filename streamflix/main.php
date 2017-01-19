<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 18/01/2017
 * Time: 18:22
 */

require_once 'core/include/header.html.php';
?>


<link rel='stylesheet' href='/css/main_layout.css'>

<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet">

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header id="header">

                    <div class="slider">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="http://placehold.it/1200x400/B70700/1E1A1A&text=StreamFlix">
                                </div>
                                <div class="item">
                                    <img
                                        src="http://placehold.it/1200x400/660000/660000&text=a Smarter way to watch videos">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!--slider-->
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">

                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#mainNav">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="site-name"><b>Stream</b>Flix</span>
                            <span class="site-description">Explore the world of videos</span>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="mainNav">
                            <ul class="nav main-menu navbar-nav">
                                <li><a href="/main.php"><i class="fa fa-play"></i> Explore</a></li>
                                <li><a href="/main.php?featured=true"><i class="fa fa-star"></i> Featured</a></li>
                                <li><a href="/main.php?favourites=true"><i class="fa fa-heart"></i> Loved</a></li>
                            </ul>

                            <ul class="nav  navbar-nav navbar-right">
                                <li><a href="/main.php?profile=true"><i class="fa fa-user"></i> Profile</a></li>
                                <li><a href="/main.php?logout=true"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </nav>

                </header><!--/#HEADER-->

            </div>
        </div>
    </div>

    <!-- videos -->

    <div class="container" style="margin-top:10px;">
        <div class="row form-group">

        </div>

        <div class="row form-group">

            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-image">
                        <img
                            src="http://666a658c624a3c03a6b2-25cda059d975d2f318c03e90bcf17c40.r92.cf1.rackcdn.com/unsplash_52cd36aac6bed_1.JPG"
                            class="panel-image-preview"/>
                        <label for="toggle-4"></label>
                    </div>
                    <input type="checkbox" id="toggle-4" checked class="panel-image-toggle">
                    <div class="panel-body">
                        <h4>Show the Description by default!</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in lobortis nisl, vitae iaculis
                            sapien. Phasellus ultrices gravida massa luctus ornare. Suspendisse blandit quam elit, eu
                            imperdiet neque semper et.</p>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="#download"><span class="glyphicon glyphicon-download"></span></a>
                        <a href="#facebook"><span class="fa fa-facebook"></span></a>
                        <a href="#twitter"><span class="fa fa-twitter"></span></a>
                        <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default">
                    <div class="panel-image">
                        <img
                            src="http://666a658c624a3c03a6b2-25cda059d975d2f318c03e90bcf17c40.r92.cf1.rackcdn.com/unsplash_52cd36aac6bed_1.JPG"
                            class="panel-image-preview"/>
                        <label for="toggle-4"></label>
                    </div>
                    <input type="checkbox" id="toggle-4" checked class="panel-image-toggle">
                    <div class="panel-body">
                        <h4>Show the Description by default!</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in lobortis nisl, vitae iaculis
                            sapien. Phasellus ultrices gravida massa luctus ornare. Suspendisse blandit quam elit, eu
                            imperdiet neque semper et.</p>
                    </div>
                    <div class="panel-footer text-center">
                        <a href="#download"><span class="glyphicon glyphicon-download"></span></a>
                        <a href="#facebook"><span class="fa fa-facebook"></span></a>
                        <a href="#twitter"><span class="fa fa-twitter"></span></a>
                        <a href="#share"><span class="glyphicon glyphicon-share-alt"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <hr/>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">Product for Mac</a></li>
                        <li><a href="#">Product for Windows</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">Web analytics</a></li>
                        <li><a href="#">Presentations</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">Product Help</a></li>
                        <li><a href="#">Developer API</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="/">© 2017 <b>Stream</b>Flix.</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- .wrapper -->
</div>

