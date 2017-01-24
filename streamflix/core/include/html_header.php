<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 23/01/2017
 * Time: 20:58
 */

?>

<html>
<head>
<link rel='stylesheet' href='/css/main_layout.css'>

<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

<body>
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
