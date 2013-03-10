<?php
session_start();
	var_dump($_POST);
	
	$tablename = $_POST['table-1'];
	$columns = '';
	$commaset = false;

	if(isset($_POST['column-1'])){
	
		foreach ($_POST['column-1'] as $col){
			if($commaset)
				$columns = $columns . ',' . $col;
				else{
				$columns = $columns .  $col;
				$commaset = true;
				}
			}
	}
	else{
		$columns = '*';
	}
	//echo $tablename;
	//echo $columns;
	$_SESSION['tablename'] = $tablename;
	$_SESSION['columns'] = $columns;
?>

<?php  
//require_once '../../../tabs.php'; 
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
  <head> 
    <title>jqGrid PHP Demo</title> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="themes/redmond/jquery-ui-custom.css" /> 
    <link rel="stylesheet" type="text/css" media="screen" href="themes/ui.jqgrid.css" /> 
	<link rel="stylesheet" type="text/css" media="screen" href="style.css" /> 
    <!--<link rel="stylesheet" type="text/css" media="screen" href="themes/ui.multiselect.css" /> 
	<link rel="stylesheet" type="text/css" media="screen" href="niceforms-default.css" /> 
	 <script src="niceforms.js" type="text/javascript"></script> -->
    <style type="text"> 
        html, body { 
        margin: 0;            /* Remove body margin/padding */ 
        padding: 0; 
        overflow: hidden;    /* Remove scroll bars on browser window */ 
        font-size: 75%; 
        } 
    </style> 
    <script src="js/jquery-1.9.0.min.js" type="text/javascript"></script> 
    <script src="js/i18n/grid.locale-en.js" type="text/javascript"></script> 
    <script type="text/javascript"> 
    $.jgrid.no_legacy_api = true; 
    $.jgrid.useJSON = true; 
    </script> 
    <script src="js/jquery.jqGrid.min.js" type="text/javascript"></script> 
    <script src="js/jquery-ui-1.10.1.custom.js" type="text/javascript"></script> 
  </head> 
  <body> 
	<div class="pageWrapper">
	<header>
	</header>
  
  <?php
	$dbname = 'classicmodels';

	if (!mysql_connect('localhost', 'root', '')) {
		echo 'Could not connect to mysql';
		exit;
	}

	$sql = "SHOW TABLES FROM $dbname";
	$result = mysql_query($sql);



	if (!$result) {
		echo "DB Error, could not list tables\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
	
?>
			<form method="POST" action="query.php" class="niceform">
				<label>Select :</label>
					<div class="joins">
						<div class="join">
							<label>Table</label>
							<select name="table-1" id="table-1" class="table" join="1" SIZE=5>
								<?php
								while ($row = mysql_fetch_row($result)) {
								echo '<option name="' . $row[0] . '">' . $row[0] . '</option>';
								}					
								?>
							</select>
							<label>Columns</label>
							<SELECT name="column-1[]" id="column-1" MULTIPLE SIZE=5 >
								 
							</SELECT>
						</div>
					</div>
					<input type="hidden" id="joins" value="1" />
					
					
					<a href="#" id="addbutton">Add</a>
					<input type="submit" />
					
			</form>
			<script>
	function getTableContents(){
		//alert($(this).val());
			$join = $(this).attr('join');
			$table = $(this).val();
			$url = "/getcolumns.php?table=" + $table;
			$.ajax({
						  url: "getcolumns.php?table=" + $table,
						  dataType: "json",
						  success: function(data) {
							var options, index, select, option;

							// Get the raw DOM object for the select box
							select = document.getElementById('column-' + $join);

							// Clear the old options
							select.options.length = 0;

							// Load the new options
							options = data.options; // Or whatever source information you're working with
							for (index = 0; index < options.length; ++index) {
							  option = options[index];
							  select.options.add(new Option(option.text, option.value));
							}
						  } 
			});
	}
			
			
	
	
	$(function(){
		
	$(".table").change(getTableContents);
		
		
		
		
	
	
	
	
	
	
	    $('#addbutton').click(function(){
				count = parseInt($('#joins').val()) + 1;
				$('#joins').val( parseInt($('#joins').val()) + 1);
				
				$('.joins').append('<div class="join"><label>Table</label><select name="table-' + count + '" id="table-' + count +'" class="table" join="' + count + '" SIZE=5></select><label>Columns</label><SELECT name="column-' + count + '[]" id="column-' + count + '" MULTIPLE SIZE=5></SELECT></div>'
				);
			//$('#table1').append("<div><label>We are Repeating</label></div>");
			
				
				//$table = $(this).val();
				//$url = "/getTables.php";
				$.ajax({
							  url: "getTables.php",
							  dataType: "json",
							  success: function(data) {
								var options, index, select, option;

								// Get the raw DOM object for the select box
								select = document.getElementById('table-' + count);

								// Clear the old options
								select.options.length = 0;

								// Load the new options
								options = data.options; // Or whatever source information you're working with
								for (index = 0; index < options.length; ++index) {
								  option = options[index];
								  select.options.add(new Option(option.text, option.value));
								}
							  } 
				});
		
			$(".table").change(getTableContents);
		
		});
	});
		</script>
		
		
  
  
  
  
  
  
  
  
  
  
  
  
		  <div> 
			  <?php include ("grid.php");?> 
		  </div> 
		  <br/> 
	  </div>
      <!--<?php //tabs(array("grid.php"));?>--> 
   </body> 
</html> 