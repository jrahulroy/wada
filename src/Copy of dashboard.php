<?php session_start(); 
include "dbconnect.php";

?>
<html>
    <head>
        <title>UI-Data</title>
        <link rel="stylesheet" href="style.css"/>
        
        
        <link href="css/modern.css" rel="stylesheet">
        <link href="css/modern-responsive.css" rel="stylesheet">
        <link href="css/site.css" rel="stylesheet" type="text/css">
        
        <link href="js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="javascript/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="javascript/jquery.mousewheel.min.js"></script>
        <script type="text/javascript" src="javascript/moment.js"></script>
        <script type="text/javascript" src="javascript/moment_langs.js"></script>

        <script type="text/javascript" src="javascript/dropdown.js"></script>
        <script type="text/javascript" src="javascript/accordion.js"></script>
        <script type="text/javascript" src="javascript/buttonset.js"></script>
        <script type="text/javascript" src="javascript/carousel.js"></script>
        <script type="text/javascript" src="javascript/input-control.js"></script>
        <script type="text/javascript" src="javascript/pagecontrol.js"></script>
        <script type="text/javascript" src="javascript/rating.js"></script>
        <script type="text/javascript" src="javascript/slider.js"></script>
        <script type="text/javascript" src="javascript/tile-slider.js"></script>
        <script type="text/javascript" src="javascript/tile-drag.js"></script>
        <script type="text/javascript" src="javascript/calendar.js"></script>

    
    </head>
<body class="metrouicss" onload="prettyPrint()" style="zoom:1;">
    <div class="page">
        <div class="nav-bar">
            <div class="nav-bar-inner padding10">
                <span class="pull-menu"></span>

                <a href="/"><span class="element brand">
                    <img class="place-left" src="images/logo32.png" style="height: 20px">
                    Metro UI CSS <small>0.16.8.12</small>
                </span></a>

                <div class="divider"></div>

                <ul class="menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="https://github.com/olton/Metro-UI-CSS">Source</a></li>
                </ul>

            </div>
        </div>
    </div>
    
    
    
    <div class="content page">
        <div class="left page-sidebar">


        <?php 

        $conn=setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],$_SESSION["database"]);

        $query="show tables from ".$_SESSION["database"]."";

        if($res=mysql_query($query,$conn))
        {
            $nrows=mysql_num_rows($res);
            if($nrows==0)
            echo "No Tables in DataBase....";
            else
            {
            echo "<ul class='tables'>" ;

            while($row=mysql_fetch_array($res))
            {
                    echo "<li class='table'><a>" . $row[0] . "</a>";

                    $queryc="show columns from " . $row[0] . "";

                    if($colres=mysql_query($queryc,$conn))
                    {
                        $nclms=mysql_num_rows($colres);

                        //echo "<h2>".$_GET["dbselect"]."</h2>";
                        echo "<ul class='columns'>";
                        while($cols=mysql_fetch_array($colres))
                        {
                            //echo "<input type='checkbox' value={$cols[0]}/> {$cols[0]} </br>";
                            echo "<li class='column'><a>" . $cols[0] . "</a></li> ";
                        }
                        echo "</ul>";
                    }

                    echo "</li>";



            }
            echo "</ul>";
            }
        }
        ?>

        </div>
    
            
            
            <!--<div id="tablediv">
    <div id="tableelements">
    <?php
    $querytable="select * from ".$_GET['dbselect']." ";

    if($tableres=mysql_query($querytable,$conn))
    {
    $colres=mysql_query($queryc,$conn);
    echo "<table id='restable' border=5>";
    echo "<tr>";
    while($cols=mysql_fetch_array($colres))
    {

    echo "<th>{$cols[0]}</th>";

    }
    echo "</tr>";
    while($tablerow=mysql_fetch_array($tableres))
    {
    echo "<tr>";
    for($i=0;$i<$nclms;$i++)
    {
    echo "<td>{$tablerow[$i]}</td>";

    }
    echo "</tr>";

    }
    echo "</table>";
    }
    ?>

    </div>


    </div>-->
            <section class="right">
            </section>
            <div class="clearfix"></div>
    </div>
    <div class="page">
        <p>This is a Footer</o>
    </div>
</body>
</html>
