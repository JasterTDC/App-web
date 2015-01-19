<!DOCTYPE HTML>
<html>
    <head>
        <title>SQL test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    
    <body>
        <?php
            require ('../models/DBMy.php');
        
            $db = new DBMy();
            
            $db->dbQuery("SELECT * FROM `user`");
            
            while (($row = $db->nextRow()) != false){
                echo $row['E-mail'] . "<br />";
            }
            
        ?>
    </body>
    
</html