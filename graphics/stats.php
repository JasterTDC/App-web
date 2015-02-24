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
$gcontrol = new graphicsController($_GET['keyword'], $_GET['startDate'], $_GET['endDate']);
$gcontrol->searchKeyword();
$gcontrol->searchNews();
$gcontrol->searchTweets();

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
        <link rel="stylesheet" href="../styles/jquery.datetimepicker.css">
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
                    dataArray.push ([new Date(micro[i].date), micro[i].sum]);
                }
                console.log(dataArray.length);
            }


            function drawLineChart (){
                evalTextArea();

                var options = {
                    width: 700,
                    height: 300,
                    hAxis: {
                        title: 'Tiempo'
                    },
                    vAxis: {
                        title: 'Polaridad'
                    }
                }
                var dataChart = google.visualization.arrayToDataTable (dataArray);
                var chart = new google.visualization.LineChart (document.getElementById('line-chart'));
                chart.draw (dataChart, options);
            }
        </script>
    </head>

    <body>
        <div class="container">

            <div class="row">
                <div class="col-md-2">
                    <h3>Datos proc. </h3>
                    <p> N&uacute;mero de datos procesados: <span class="bold"><?php echo number_format($gcontrol->getNumTweets()); ?></span></p>
                </div>
                <div class="col-md-10">
                    <h3>Búsqueda</h3>
                    <p class="formated">Resultados para el término: <span class="bold"><?php echo $gcontrol->getKeyword(); ?> </span></p>
                    <p class="formated">
                        Si desea ver más información acerca de los tweets pase el puntero del ratón por la gráfica para ver el nivel de 
                        polaridad y la fecha y hora en la que fue publicado el tweet. 
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <h3>Buscar</h3>
                    <form method="get" action="stats.php" target="_self">
                        <label for="keyword"> Palabra clave </label>
                        <input name="keyword" type="text" class="form-control" placeholder="Palabra clave" />
                        <label for="startDate"> Fecha de inicio </label>
                        <input id="startDate" name="startDate" type="text" class="form-control" placeholder="" value="" />
                        <label for="endDate"> Fecha de fin </label>
                        <input id="endDate" name="endDate" type="text" class="form-control" placeholder="" value="" />
                        <button name="Buscar" type="submit" class="btn btn-primary" placeholder="Buscar">Buscar</button>
                    </form>
                </div>
                <div id='line-chart' class='col-md-10'>
                </div>
            </div>

            <div class="row">
                <?php
                if ($gcontrol->getNews()->getNumItems() > 0) {
                    echo "<h3>Noticias</h3>";
                } else {
                    echo "<h3>Tweets</h3>";
                }
                ?>
                <?php
                if ($gcontrol->getNews()->getNumItems() > 0){
                    for ($i = 0; $i < $gcontrol->getNews()->getNumItems(); $i++) {
                            echo "<div class='col-md-4' >";
                            echo "<p class='title'>" . $gcontrol->getNews()->getDocAttribute($i, "title") . "</p>";
                            echo "<p class='description'>" . $gcontrol->getNews()->getDocAttribute($i, "description") . "</p>";
                            echo "</div>";
                    }
                }else{
                    for ($i = 0; $i < $gcontrol->getTweets()->getNumItems(); $i++){
                        echo "<div class='col-md-4'>";
                        echo "<p class='title'>@".$gcontrol->getTweets()->getDocAttribute($i, "user"). "</p>";
                        echo "<p class='description'>". $gcontrol->getTweets()->getDocAttribute($i, "tweet") ."</p>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
        
        <textarea id='json' ><?php echo $gcontrol->getRes()->getContent(); ?></textarea>
        
        <!-- Optional: Incorporate the Bootstrap JavaScript plugins -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <!-- Incorporate jquery.datetimerpicker  -->
        <script src="../scripts/jquery.js"></script>
        <script src="../scripts/jquery.datetimepicker.js" ></script>
        <!-- Datetimerpicker form field.  -->
        <script type="text/javascript">
            $('#startDate').datetimepicker({
                format: 'Y-m-d',
                timepicker: false,
                dayOfWeekStart : 1,
                lang:'es'
            });
            $('#endDate').datetimepicker({
                format: 'Y-m-d',
                timepicker: false,
                dayOfWeekStart : 1,
                lang: 'es'
            });
            $('#startDate').datetimepicker({ value: '2014-10-01', step: 10 });
            $('#endDate').datetimepicker({ value: '2014-10-10', step: 10 })
        </script>
    </body>
</html>
