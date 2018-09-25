<?php
include_once(dirname(__FILE__) . '/class/include.php');


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $City = new City(1);
        
        echo $City->name;
        ?>
    </body>
</html>
