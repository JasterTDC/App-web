<!Doctype html>
<?php
require ('../models/DAOJson.php');
require ('../controller/summaryController.php');

$summary = new summaryController();
$summary->calculateSummary("2014-10-20", "2014-10-30");
?>

<html>
    
    <head>
        <style type="text/css">
            #summary{ visibility: hidden; };
        </style>
        
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
        <textarea id="summary"><?php echo $summary->getSummary()->getContent(); ?></textarea>
        <div id="line-chart"></div>
    </body>
    
</html>