<?php session_start(); 
include "dbconnect.php";

?>
<html>
    <head>
        <title>UI-Data</title>
        <link rel="stylesheet" href="style.css"/>
        <script src="javascript/jquery-1.9.1.js"></script>
    </head>
<body>
    <header>
        <!--<img src="images/ninja.png"/>-->
        <h1>Interactive UI Design</h1>
    </header>
    <section class="content">
        <section class="left">


        <?php 
        
        $metaArray = array();
        $metaArray2 = array();
        $conn=setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],$_SESSION["database"]);
           
        $metaArray2 = generateMeta($conn, $_SESSION["database"]);
        
        $query="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = '".$_SESSION["database"]."'";
        
        
        if($res=mysql_query($query,$conn))
        {
            
            $nrows=mysql_num_rows($res);
            if($nrows==0)
            echo "No Tables in DataBase....";
            else
            {
            echo "<div class='tables'>" ;

            while($row=mysql_fetch_array($res))
            {
                    //echo '<pre>' . var_dump($row) . '</pre>';
                    echo "<div class='table'><div class='tablename'><a><span class='opr'>+</span><span class='name'> " . $row[0] . "</span></a></div>";

                    $queryc="show columns from " . $row[0] . "";

                    if($colres=mysql_query($queryc,$conn))
                    {
                        $nclms=mysql_num_rows($colres);

                        //echo "<h2>".$_GET["dbselect"]."</h2>";
                        echo "<div class='columns'>";
                        while($cols=mysql_fetch_array($colres))
                        {
                            //echo "<input type='checkbox' value={$cols[0]}/> {$cols[0]} </br>";
                            $class = '';
                            if(isset($metaArray2[$row[0] . '.' . $cols[0]])){
                                    if($metaArray2[$row[0] . '.' . $cols[0]] == 'PRI')
                                        $class = 'pri';
                                    else
                                        $class = 'for';
                            }
                            echo "<div class='column'><span class='key " . $class . "'></span><span class='columnName'>" . $cols[0] . "</span></div> ";
                        }
                        echo "</div>";
                    }

                    echo "</div>";



            }
            echo "</div>";
            }
            echo "<script>
                    var metaArray2 = JSON.parse('". json_encode($metaArray2) . "');
                    console.log(metaArray2);
</script>";
        }
        ?>
            
<a href="#" onclick="getData()">Process</a>
        </section>
    
            
            
            <!--<div id="tablediv">
    <div id="tableelements">
    
    
    

    </div>


    </div>-->
            <section class="right">
                <iframe name="myFrame" src="">
                </iframe>
            </section>
    </section>
    <footer>
        <p>This is a Footer</o>
    </footer>
    <script>
        $(document).ready(function(){
            $('.tablename').click(function(){
                $status = $(this).next().css('display') ;
                if($status == 'block'){
                    $(this).next().css('display', 'none') ;
                    //alert($(this).children().html());
                    $(this).children().children('.opr').html('+') ;
                    /*$(this).next().css('height', '0') ;
                    $(this).next().animate({
                        height: 'auto'
                      }, 5000);*/
                } else{
                    $(this).next().css('display', 'block') ;
                    $(this).children().children('.opr').html('-') ;
                };
            });
            
            $('.column').click(function(){
                
                if(!$(this).children().hasClass('pri')){
                    $(this).toggleClass('select');
                    $(this).parent().find('.pri').parent().addClass('select');
                } else if(!$(this).hasClass('select'))
                {
                    $(this).toggleClass('select');
                    // Primary has been clicked.
                }
                else{
                    var flag = false;
                    $(this).parent().children().each(function(){
                                if(   !$(this).children().hasClass('pri')  &&  $(this).hasClass('select') )
                                    flag=true;
                                    
                    });
                    if(!flag){
                        //$(this).toggleClass('select');
                        $(this).removeClass('select');
                    }
                }
                reflectState();
               //alert($(this).parent().find('.pri').parent().addClass('select'));
            });
        });
        
        var data = new Array();
        function getData(){
            getString();
            
            alert(JSON.stringify(data));
            //alert(data);
            $.post(
                    "query_store.php", 
                    {query_string:JSON.stringify(data)},
                    function(data){
                        $('iframe').attr('src', 'display.php?query_id=' + data)
                        alert(data);
                    }
                    
                );
            //console.log(data);
            //alert(data);
        }
        function getString(){
            var count = 0;
                        
            $('.select').each(function(){
                $tableName = $(this).parent().prev().children().children('.name').html();
                $columnName = $(this).children('.columnName').html();
                //alert($tableName  + " " + $columnName);
                //data.$tableName[0] = $columnName;
                data[count] = new Array();
                data[count][0] = $tableName;
                data[count][1] = $columnName;
                count++;
                //data.$tableName[data.$tableName.length] = $columnName;
            });
        }
        function reflectState(){
            getString();
            $('.table').addClass('red');
            $('.table').removeClass('green');
            if(data == ''){
                $('.table').removeClass('red');
                $('.table').addClass('green');
                
            }
            else{
                var table = new Array();
            }
            alert(data);
        }
        reflectState();
    </script>
</body>
</html>
