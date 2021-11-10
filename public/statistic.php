<?php
    require('menu.php');
?>
<html>
    <head>
        <link rel="stylesheet" href="../style/statistic.css">
    </head> 

    <body>
        <canvas id="myCanvas">
            Your browser does not support the HTML canvas tag.
        </canvas>
        <canvas id="myCanvas">
            Your browser does not support the HTML canvas tag.
        </canvas>
        <canvas id="myCanvas">
            Your browser does not support the HTML canvas tag.
        </canvas>
    </body>
</html>
<script>
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    ctx.font = "30px Arial";
    ctx.strokeText("Hello World",10,50);
</script>