<!Doctype html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Includes section.  */
require './models/DAOJson.php';
require './models/DAOLatestSeeks.php';
require './controller/searchController.php';
require './controller/statsController.php';
require './controller/summaryController.php';

/* Search Controller section.  */
$searchController = new searchController();
$statsController = new statsController();

/* Summary Controller section.  */
$summary = new summaryController();
$summary->calculateSummary("2014-10-01", "2014-10-30");

/* Work section.  */
$statsController->loadMonthInfo(10);
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
        <link rel="stylesheet" href="styles/jquery.datetimepicker.css">
        
        <!-- Scripting section. -->
        <script type="text/javascript"
                src="https://www.google.com/jsapi?autoload={
                'modules':[{
                'name':'visualization',
                'version':'1',
                'packages':['corechart']
                }]
        }"></script>
        
        <script type="text/javascript">
            google.setOnLoadCallback(drawLineChart);
            
            var dataArray = [["Dia", "Polaridad"]];
            
            function evalTextArea (){
                var micro = JSON.parse (document.getElementById("summary").value);
                
                for (var i = 0; i < micro.length; i++){
                    dataArray.push ([new Date(micro[i].date), micro[i].sum]);
                }
                console.log(dataArray.length);
            }
            
            function drawLineChart (){
                evalTextArea();
                
                var options = {
                    width: 800,
                    height: 300,
                    hAxis: {
                        title: 'Tiempo'
                    },
                    vAxis: {
                        title: 'Polaridad'
                    }
                }
//                var options = {
//                    title : "Resumen de finales de Octubre"
//                };
                var dataChart = google.visualization.arrayToDataTable (dataArray);
                var chart = new google.visualization.LineChart (document.getElementById('line-chart'));
                chart.draw (dataChart, options);
            }
        </script>
        
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
                    <h4>Tweets proc.</h4>
                    <p class = "lead">
                        <span class="tweets-number">Octubre: <?php echo $statsController->getTotal();  ?> </span> <br />
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets positivos</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php echo $statsController->getPos();  ?> - <span class="positives"> <?php echo $statsController->getPositivesPerc(); ?> %</span></span>
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets negativos</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php echo $statsController->getNeg();  ?> - <span class="negatives"> <?php echo $statsController->getNegativesPerc();  ?> %</span></span>                        
                    </p>
                </div>
                <div class="col-md-2">
                    <h4>Tweets neutros</h4>
                    <p class="lead">
                        <span class="tweets-number"><?php echo $statsController->getNeu(); ?> - <span class="neut"> <?php echo $statsController->getNeutresPerc(); ?> %</span></span>                        
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
                        <label for="keyword"> Palabra clave </label>
                        <input name="keyword" type="text" class="form-control" placeholder="Palabra clave" />
                        <label for="startDate"> Fecha de inicio </label>
                        <input id="startDate" name="startDate" type="text" class="form-control" placeholder="" value="" />
                        <label for="endDate"> Fecha de fin </label>
                        <input id="endDate" name="endDate" type="text" class="form-control" placeholder="" value="" />
                        <button name="Buscar" type="submit" class="btn btn-primary" placeholder="Buscar">Buscar</button>
                    </form>
                </div>
                <div class="col-md-10">
                    <h4>Últimas consultas realizadas</h4>
                    <table class="table table-condensed">
                        <tr>
                            <th>Fecha</th>
                            <th>Palabra clave</th>
                            <?php echo $searchController->getTable();?>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <h4>Resumen de Octubre</h4>
                    <p>En la grafica posterior se muestra una media diaria de polaridad del t&eacute;rmino "Google" para todo el mes de Octubre. </p>
                </div>
            </div>
            
            <div class="row">                
                <div class="col-md-2"></div>
                <div id="line-chart" class="col-md-10"></div>
            </div>

            <textarea id="summary"><?php echo $summary->getSummary()->getContent(); ?></textarea>
            
        </div>

        <!-- Optional: Incorporate the Bootstrap JavaScript plugins -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <!-- Incorporate jquery.datetimerpicker  -->
        <script src="scripts/jquery.js"></script>
        <script src="scripts/jquery.datetimepicker.js" ></script>
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

