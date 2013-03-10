<!DOCTYPE html> 
<html>
	<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">
		<title>Database Application</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	</head>
	<body>
	
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
			<form method="POST" action="query.php">
				<label>Select :</label>
					<div id="table1">
						<label>Table</table>
						<select name="table-1" id="table-1">
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
					
					<div>
						<a id="addbutton" href="">Add</a>
					</div>
					<input type="submit" />
					
			</form>
			<script>
		
	$(function(){
		
	$("#table-1").change(function(){
		alert($(this).val());
		$table = $(this).val();
		$url = "/getcolumns.php?table=" + $table;
		$.ajax({
					  url: "getcolumns.php?table=" + $table,
					  dataType: "json",
					  success: function(data) {
						var options, index, select, option;

						// Get the raw DOM object for the select box
						select = document.getElementById('column-1');

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
				
		
		});
		
		
		
		
	
	
	
	
	
	
	    $('#addbutton').click(function(){
				count += 1;
			$('#table1').append("<div><label>We are Repeating</label></div>");
		});
	});
		</script>
		</body>
</html>