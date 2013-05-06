<?php 
session_start();
?>
<html>
    <head>
        <title>Display a Query</title>
        
        <link rel="stylesheet" href="css/reset.css" type="text/css"/>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>
        <link rel="stylesheet" href="css/jquery-ui-1.8.16.custom.css" type="text/css"/>
        <link rel="stylesheet" href="css/slick.grid.css" type="text/css"/>
        <link rel="stylesheet" href="css/slick.pager.css" type="text/css"/>
        <link rel="stylesheet" href="css/examples.css" type="text/css"/>
        <link rel="stylesheet" href="css/colorbox.css" type="text/css"/>
        
        
    </head>
    <body>



<?php

include('dbconnect.php');
//echo '<p>Hello</p><br />';
$conn = defaultConnection();
if(!$conn){
echo "Connection Failed";
}
$queryId = isset($_GET['query_id'])?$_GET['query_id']:1;
//echo $queryId;
$query = getQueryString($queryId, $conn);
//echo $query_string . '<br />';
$conn2=setconnection($_SESSION["servername"],$_SESSION["uname"],$_SESSION["pwd"],$_SESSION["database"]);
$metaArray2 = generateMeta($conn, $_SESSION["database"]);
$generatedQuery = generateQuery($query['query'], $metaArray2);
$finalQuery = $generatedQuery['finalQuery'];
//echo '<br/>' . $finalQuery;
//var_dump($tables);


if(!$conn2){
    die('Database Connectioin failed');
}
$runTime = microtime(true);
$finalRS = mysql_query($finalQuery, $conn2);
$runTime = microtime(true) - $runTime;
$rowCount = mysql_num_rows($finalRS);
//echo $finalQuery;
$i=0;
while ($i < mysql_num_fields($finalRS)) {
    $meta = mysql_fetch_field($finalRS, $i);
    if (!$meta) {
        echo "No information available<br />\n";
        }
    $columns[$i] = $meta->name;
    $i++;
}
//var_dump($columns);


//$querytable="select * from ".$_GET['dbselect']." ";


   /* if($tableres=mysql_query($finalQuery, $conn2))
    {
        //var_dump(mysql_fetch_field($tableres));
        //$colres=mysql_query('SHOW COLUMNS FROM ',$conn);
        echo "<table id='restable' border=5>";
        echo "<tr>";
        $i = 0;
        while($i < count($columns)) {
            echo "<th>{$columns[$i]}</th>";
            $i++;
        }
        echo "</tr>";
        while($tablerow=mysql_fetch_array($tableres)) {
            echo "<tr>";
            for($i=0;$i<  mysql_num_fields($tableres);$i++) {
            echo "<td>{$tablerow[$i]}</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    else {
    echo "<br/>Result Failed";
    echo mysql_error();
    
    }


//$columns

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        
<div style="width:100%;margin:0 auto;">
  <div class="display_header" style="width:100%">
    
        <!--<span style="float:right;display:inline-block;">
          Search:
          <input type="text" id="txtSearch" value="apple">
        </span>-->
  </div>
  <div id="myGrid" style="width:100%;height:400px;"></div>
  <div id="pager" style="width:100%;height:30px;">
      <div class="slick-pager">
          <span class="slick-pager-nav">
              <span class="ui-state-default ui-corner-all ui-icon-container">
                  <span class="ui-icon ui-icon-seek-first ui-state-enabled">
                      
                  </span>
                  
              </span>
              <span class="ui-state-default ui-corner-all ui-icon-container">
                  <span class="ui-icon ui-icon-seek-prev ui-state-enabled">
                      
                  </span>
                  
              </span>
              <span class="ui-state-default ui-corner-all ui-icon-container">
                  <span class="ui-icon ui-icon-seek-next ui-state-enabled">
                      
                  </span></span>
              <span class="ui-state-default ui-corner-all ui-icon-container">
                  <span class="ui-icon ui-icon-seek-end ui-state-enabled">
                      
                  </span>
                  
              </span>
              
          </span>
          <span class="slick-pager-status">Showing page 1 of 1</span>
      </div>
  </div>
  <div class="gridFooter" style="width:100%;height:20px;text-align: right;">
      <div id="queryInfo">
        <p>Row Count : <?php echo $rowCount;?></p>
        <p>Execution Time : <?php echo $runTime ?>
      </div>
      <button class="clean-gray inline" href="#queryContent" >Export Query</button>
      <button class="clean-gray"  onclick="exportQuery();" >Export</button><!---->
    </div>
  
  <div style='display:none'>
			<div id='queryContent'>
                            <p><?php echo $finalQuery?></p>
			</div>
		</div>

        
<script src="javascript/jquery-1.7.min.js"></script>
<script src="javascript/jquery-ui-1.8.16.custom.min.js"></script>
<script src="javascript/jquery.event.drag-2.0.min.js"></script>
<script src="javascript/jquery.jsonp-1.1.0.min.js"></script>

<script src="javascript/slick.core.js"></script>
<script src="javascript/slick.remotemodel.js"></script>
<script src="javascript/slick.formatters.js"></script>
<script src="javascript/slick.grid.js"></script>


<script src="javascript/jquery.colorbox-min.js"></script>
<script>
    function exportQuery(){
        window.location='queryExport.php?queryid=<?php echo $queryId; ?>';
    }
   
  var grid;
  $focussedElement='';
  var filters = [];
  var loader = new Slick.Data.RemoteModel(<?php echo $queryId;?>);
  
  //loader.queryId = <?php echo $queryId;?>;
  var storyTitleFormatter = function (row, cell, value, columnDef, dataContext) {
    return "<b><a href='" + dataContext["link"] + "' target=_blank>" +
        dataContext["title"] + "</a></b><br/>" + dataContext["description"];
  };


  var columns = [
      <?php 
      $len = sizeof($columns);
      for($i=0;$i<$len;$i++){
          if($i == $len - 1)
            echo '{id: "' . $i . '", name: "' . $columns[$i] . '", field: ' . $i .', sortable: true}';
          else
              echo '{id: "' . $i . '", name: "' . $columns[$i] . '", field: ' . $i .', sortable: true}, ';
      }?>
    
  ];

  var options = {
    //rowHeight: 64,
    editable: false,
    enableAddRow: false,
    enableCellNavigation: true,
    forceFitColumns:true,
    showHeaderRow: true,
    headerRowHeight: 30
  };

  var loadingIndicator = null;

  $canvasHeight = 0;
  $(document).ready(function(){
      loadGrid();
      
      //Paginate Icons
    $gridHeight = $('.slick-viewport').height();
    $canvasHeight = $('.grid-canvas').height();
    //alert($canvasHeight);
    $('.ui-icon-seek-next').click(function(){
        //alert('scroll');
        //$('.slick-viewport').scrollTo( '+=' + $gridHeight, 800 );
        $gridScroll = $('.slick-viewport').scrollTop();
        //alert($gridScroll);
        //alert($gridScroll + $gridHeight);
        $('.slick-viewport').animate({ 
            scrollTop: ($gridScroll + $gridHeight)}, 
            1400, 
            "easeOutQuint"
         );
    
    });
    $('.ui-icon-seek-prev').click(function(){
        //alert('scroll');
        //$('.slick-viewport').scrollTo( '-=' + $gridHeight, 800 );
        $gridScroll = $('.slick-viewport').scrollTop();
        $('.slick-viewport').animate({ 
            scrollTop: ($gridScroll - $gridHeight)}, 
            1400, 
            "easeOutQuint"
         );
    });
    $('.ui-icon-seek-end').click(function(){
        //alert('scroll');
        //$('.slick-viewport').scrollTo( '100%', 800 );
        $('.slick-viewport').scrollTop($canvasHeight);
    });
    $('.ui-icon-seek-first').click(function(){
        //alert('scroll');
        $('.slick-viewport').scrollTop(0);
    });
      
  });
  function loadGrid() {
      var loader = new Slick.Data.RemoteModel(<?php echo $queryId;?>);
        
        grid = new Slick.Grid("#myGrid", loader.data, columns, options);
        
    //console.log(loader.data);
    //console.log(columns);
    
        
    grid.onViewportChanged.subscribe(function (e, args) {
      var vp = grid.getViewport();
      loader.ensureData(vp.top, vp.bottom);
    });

    grid.onSort.subscribe(function (e, args) {
      loader.setSort(args.sortCol.field, args.sortAsc ? 1 : -1);
      var vp = grid.getViewport();
      loader.ensureData(vp.top, vp.bottom);
    });

    loader.onDataLoading.subscribe(function () {
      if (!loadingIndicator) {
        loadingIndicator = $("<span class='loading-indicator'><label>Buffering...</label></span>").appendTo(document.body);
        var $g = $("#myGrid");

        loadingIndicator
            .css("position", "absolute")
            .css("top", $g.position().top + $g.height() / 2 - loadingIndicator.height() / 2)
            .css("left", $g.position().left + $g.width() / 2 - loadingIndicator.width() / 2);
      }

      loadingIndicator.show();
      $(".inline").colorbox({inline:true, title:'Export Query',
         maxWidth: '70%',
         maxHeight: '70%',
         scrolling: false
      });
    });

    loader.onDataLoaded.subscribe(function (e, args) {
      for (var i = args.from; i <= args.to; i++) {
        grid.invalidateRow(i);
      }

      grid.updateRowCount();
      grid.render();

      loadingIndicator.fadeOut();
      $canvasHeight = $('.grid-canvas').height();
    });

    /*$("#txtSearch").keyup(function (e) {
      if (e.which == 13) {
        loader.setSearch($(this).val());
        var vp = grid.getViewport();
        loader.ensureData(vp.top, vp.bottom);
      }
    });*/

    // load the first page
    grid.onViewportChanged.notify();
    
    
    
    //var headerColumnCount = 0;
    $i=0;
    $('.slick-headerrow-column').each(function(){
       //alert($(this).attr('class').split(' ').filter('r'));
       //alert('hi');
        if(typeof filters[$i] != 'undefined'){
            value = filters[$i];
        }
        else{
            value = '';
        }
        $(this).append("<input id = 'filter-" + ($i+1) + "' value='" + value + "' type='text' />");
        $i++;
    });
    if($focussedElement){
        $('#' + $focussedElement).focus();
    }
    $('.slick-headerrow').keyup(function(){
       console.log('Key Down') ;
       //headerColumnCount = 0;
       filters = [];
       $('.slick-headerrow-column').each(function(){
                   $filterValue = $(this).children().val();
                   filters.push($filterValue);
       });
              
       console.log(filters);
       $focussedElement = $(document.activeElement).attr('id');
       loadGrid();
       //loader.
       
       //var loader = new Slick.Data.RemoteModel(<?php echo $queryId;?>);
       //var vp = grid.getViewport();
       //loader.ensureData(vp.top, vp.bottom);
       //grid = new Slick.Grid("#myGrid", loader.data, columns, options);
       //grid.invalidate();
       //grid.updateRowCount();
       //grid.render();
       //grid.render();
       // grid.onViewportChanged.notify();
    });
    
  }
</script>

    </body>
</html>
