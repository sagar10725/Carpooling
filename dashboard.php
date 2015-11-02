<?php session_start(); ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/test.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script src="js/test.js" type="application/javascript"></script>
        <link href="css/dashboard-test.css" rel="stylesheet" type="text/css">
        <script src="js/dashboard-test.js" type="application/javascript"></script>
    </head>

    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <!-- <div class="col-lg-6 col-sm-6"> -->
                <div class="card hovercard">
                    <div class="card-background">
                        <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">
                    </div>
                    <div class="useravatar">
                        <img alt="" src="http://lorempixel.com/100/100/people/9/">

                    </div>
                    <div class="card-info"> <span class="card-title"><?= $_SESSION['username']; ?></span>

                    </div>
                </div>
                <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                            <div class="hidden-xs">Home</div>
                        </button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            <div class="hidden-xs">Favorites</div>
                        </button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <div class="hidden-xs">Profile</div>
                        </button>
                    </div>




                </div>
                <div class="col-sm-3 col-md-3 pull-right">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="q">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <div class="well">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                    <div class="well">
                        <textarea class="form-control" rows="3" id="txtArea"></textarea>
                        <button type="button" class="btn btn-primary" id="addPost">Add Trip</button>
                    </div>
                </div>
                <div id="tab1">


                </div>

                <div class="tab-pane fade in" id="tab2">
                    <h3>This is tab 2</h3>
                </div>
                <div class="tab-pane fade in" id="tab3">
                    <h3>This is tab 3</h3>
                </div>
            </div>
        </div>

        <!-- </div> -->



        <!--
            <div id="trips">

            </div>
-->
    </body>

    </html>