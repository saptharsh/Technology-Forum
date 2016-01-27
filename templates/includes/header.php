<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PHP Forum</title>

        <!-- Bootstrap core CSS -->
        <link href="templates/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="templates/css/custom.css" rel="stylesheet">

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo BASE_URI; ?>templates/js/bootstrap.js"></script> 
        <script src="<?php echo BASE_URI; ?>templates/js/jquery.confirm.min.js"></script>
        <script src="<?php echo BASE_URI; ?>templates/js/ckeditor/ckeditor.js"></script>

        <?php
        // Check if title is set, if not  assign it
        if (!isset($title)) {
            $title = SITE_TITLE;
        }
        ?>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <!-- For Mobile devices -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">PHP Forum</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <?php if (!isLoggedIn()) : ?>
                            <li><a href="register.php">Create An Account</a></li>
                        <?php else : ?>
                            <li><a href="create.php">Create Topic</a></li>
                            <li><a href="create.php">Profile</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">

            <!-- Bootstrap Grid -->
            <div class="row">
                <div class="col-md-8">
                    <div class="main-col">
                        <div class="block"> <!-- has custom styling -->
                            <h1 class="pull-left"><?php echo $title; ?></h1>
                            <h4 class="pull-right">Participate to grow PHP community</h4>
                            <div class="clearfix"></div> <!-- Bootstrap class -->
                            <hr/>
                            <?php displayMessage(); ?>
                          