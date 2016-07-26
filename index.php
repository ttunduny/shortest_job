<!DOCTYPE html>
<html>
<head>
	<title>Shortest Job First</title>
	<script type="text/javascript" src="jquery.min.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
  
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>
</head>
<body>
<div style="width:100%;height:800px;background-color:#e3e3e3;float:left">
	<div id="job_adds">
		<form id="jobs_form" method="post" action="compute.php">
			<table id="table_id" class="display" border="1px" style="width:90%">
				<thead>
					<tr>
						<th>Job Name</th>
						<th>Arrival Time</th>
						<th>Burst Time</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="text" name="arrival_time[]"></td>
						<td><input type="text" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="text" name="arrival_time[]"></td>
						<td><input type="text" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="text" name="arrival_time[]"></td>
						<td><input type="text" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="text" name="arrival_time[]"></td>
						<td><input type="text" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="text" name="arrival_time[]"></td>
						<td><input type="text" name="time[]"></td>						
					</tr>
				</tbody>

			</table>

			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
	<div id="job_listing">
	</div>

	
	
</div>
</body>
<style type="text/css">
	#job_adds{
		width: 30%;
		float: left;
		height: 450px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 3%;
		background-color: #ffffff;
	}
	#job_listing{
		width: 68%;
		float: left;
		height: 450px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 3%;
		background-color: #ffffff;
	}
</style>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#table_id').DataTable();
	});
</script>

</html>