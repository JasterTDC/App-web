<!DOCTYPE HTML>
<?php
/* It will displays all php errors.  */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Includes section.  */
require '../models/DAOJson.php';
require '../models/DAOLatestSeeks.php';
require '../controller/graphicsController.php';

/* Work section.  */
$gcontrol = new graphicsController($_GET['keyword']);
$gcontrol->searchKeyword();

/* Latest Seeks */
$daoSeek = new DAOLatestSeeks();
$daoSeek->insertLS(new LatestSeeks($_GET['keyword']));
?>
<html>
    <head>
        <title>Estadísticas y gráficas</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Include meta tag to ensure proper rendering and touch zooming -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Include bootstrap stylesheets -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <!-- JavaScript placed at the end of the document so the pages load faster -->
        <!-- Optional: Include the jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../styles/stats.css">
        <!-- Scripting section. -->
        <script type="text/javascript"
                src="https://www.google.com/jsapi?autoload={
                'modules':[{
                'name':'visualization',
                'version':'1',
                'packages':['corechart']
                }]
        }"></script>


        <script type='text/javascript'>
            google.setOnLoadCallback(drawLineChart);
            
            var dataArray = [["Dia", "Polaridad"]];
            
            function evalTextArea (){
                var micro = JSON.parse (document.getElementById("microsoft-json").value);
                var apple = JSON.parse (document.getElementById("apple-json").value);
                var google = JSON.parse (document.getElementById("google-json").value);
                
                for (var i = 0; i < micro.length; i++){
                    dataArray.push ([micro[i].date, micro[i].polarity]);
                }
                
                for (var i = 0; i < apple.length; i++){
                    dataArray.push ([apple[i].date, apple[i].polarity]);
                }
                
                for (var i = 0; i < google.length; i++){
                    dataArray.push ([google[i].date, google[i].polarity]);
                }
                console.log(dataArray.length);
            }

            
            function drawLineChart (){
                evalTextArea();
                
                var options = {
                title : "Nivel de polaridad",
                        curveType : "function",
                        legend : { position : "bottom" }
                };
                var dataChart = google.visualization.arrayToDataTable (dataArray);
                var chart = new google.visualization.LineChart (document.getElementById('line-chart'));
                chart.draw (dataChart, options);
            }
        </script>
    </head>

    <body>
        <div class="container">
            <textarea id='microsoft-json' ><?php echo $gcontrol->getMicrosoft()->getContent(); ?></textarea>
            <textarea id='apple-json'><?php echo $gcontrol->getApple()->getContent(); ?></textarea>
            <textarea id='google-json'><?php echo $gcontrol->getGoogle()->getContent(); ?></textarea>
            
            <div id='line-chart' class='graphics'>
            </div>
        </div>
    </body>
</html>
