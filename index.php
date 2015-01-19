<!Doctype html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Includes section.  */
require './models/DAOJson.php';
require './models/DAOLatestSeeks.php';
require './controller/searchController.php';
require './controller/statsController.php';

/* Search Controller section.  */
$searchController = new searchController();
$statsController = new statsController();

/* Date section  */
$from = "2014-10-01";
$to = "2014-10-10";
?>
<html>
    <head>
        <title>Monitor Social</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Include meta tag to ensure proper rendering and touch zooming -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Include bootstrap stylesheets -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/main.css">

        <!-- JavaScript placed at the end of the document so the pages load faster -->
        <!-- Optional: Include the jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="row">
                <?php
                ?>
                <div class="col-md-2">
                    <h4>Tweets procesados</h4>
                    <p class = "lead">
                        <span class="tweets-number">1 - 10 Octubre : <?php echo $statsController->getCountDate($from, $to) ?> </span>
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets positivos</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php echo $statsController->getCountDatePol(1, $from, $to);  ?> - <span class="positives"> <?php  ?> %</span></span>
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets negativos</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php  ?> - <span class="negatives"> <?php  ?> %</span></span>                        
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets neutros</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php  ?> - <span class="neut"> <?php  ?> %</span></span>                        
                    </p>
                </div>
                <div class="col-md-4">
                    <h4>Tags relacionados</h4>
                    <p class="tags">Lumia, iPhone, Android, Lion</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h4>Buscar</h4>
                    <form method="get" action="graphics/stats.php" target="_self">
                        <input name="keyword" type="text" class="form-control" placeholder="Palabra clave" />
                        <button name="Buscar" type="submit" class="btn btn-primary" placeholder="Buscar">Buscar</button>
                    </form>
                </div>
                <div class="col-md-10">
                    <h4>Consultas</h4>
                    <table class="table table-striped">
                        <tr>
                            <th>Fecha</th>
                            <th>Palabra clave</th>
                            <?php echo $searchController->getTable();?>
                        </tr>
                    </table>
                </div>
            </div>


        </div>

        <!-- Optional: Incorporate the Bootstrap JavaScript plugins -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    </body>
</html>

