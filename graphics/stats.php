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
$gcontrol->searchNews();

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
                var micro = JSON.parse (document.getElementById("json").value);
                
                for (var i = 0; i < micro.length; i++){
                    dataArray.push ([new Date(micro[i].date), micro[i].polarity]);
                }
                console.log(dataArray.length);
            }

            
            function drawLineChart (){
                evalTextArea();
                
                var options = {
                    width: 1000,
                    height: 300,
                    hAxis: {
                        title: 'Tiempo'
                    },
                    vAxis: {
                        title: 'Polaridad'
                    }
                }
//                var options = {
//                title : "Nivel de polaridad",
//                        curveType : "function",
//                        legend : { position : "bottom" }
//                };
                var dataChart = google.visualization.arrayToDataTable (dataArray);
                var chart = new google.visualization.LineChart (document.getElementById('line-chart'));
                chart.draw (dataChart, options);
            }
        </script>
    </head>

    <body>
        <div class="container">
            <textarea id='json' ><?php echo $gcontrol->getRes()->getContent(); ?></textarea>
            
            <div class="row">
                <h3>Búsqueda</h3>
                <p class="formated">Resultados para el término: <span class="bold"><?php echo $gcontrol->getKeyword(); ?> </span></p>
                <p class="formated">
                    Si desea ver más información acerca de los tweets pase el puntero del ratón por la gráfica para ver el nivel de 
                    polaridad y la fecha y hora en la que fue publicado el tweet. 
                </p>
            </div>
            
            <div id='line-chart' class='graphics'>
            </div>
            
            <div class="row">
                <?php 
                    if ($gcontrol->getNews()->getNumItems() > 0) { 
                        echo "<h3>Noticias</h3>"; 
                    }else{
                        echo "<h3>Tweets</h3>";
                    } 
                
                ?>
                <?php
                    for ($i = 0; $i < $gcontrol->getNews()->getNumItems(); $i++){
                        if ($gcontrol->getNews()->getNumItems() > 0){
                            echo "<div class='col-md-4' >";
                            echo "<p class='title'>".$gcontrol->getNews()->getDocAttribute($i, "title")."</p>";
                            echo "<p class='description'>".$gcontrol->getNews()->getDocAttribute($i, "description")."</p>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>
