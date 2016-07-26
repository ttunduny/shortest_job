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
  	<script type="text/javascript" src="highcharts.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>

</head>
<body>
<div style="width:100%;height:800px;background-color:#e3e3e3;float:left">
	<div id="job_adds">
		<form id="jobs_form" method="post" action="compute.php">
			<br/><br/>
			<input type="button" id="addRow" value="Add Row" />
			<br/><br/><br/>
			<table id="table_id" class="display" width="80% !important">
				<thead>
					<tr>
						<th>Job Name</th>
						<th>Arrival Time</th>
						<th>Burst Time</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input type="text" name="process_name[]" class="process"></td>
						<td><input type="number" name="arrival_time[]" class="arrival"></td>
						<td><input type="number" name="time[]" class="burst"></td>												
						<td ><input size=25 type="button" class="delete" value="Remove"/></td>
					</tr>
					
				</tbody>

			</table>

			<input type="submit" name="submit" value="Submit">
		</form>
	</div>
	<div id="job_listing">
	</div>

	<div id="results_gantt">
		<div id="gannt">
		</div>
	</div>
	<div id="results_stats">
		<h5>Average Waiting Time: <span id="avgwt"></span></h5>
		<h5>Average Turn Aroung Time: <span id="avgtat"></span></h5>
	</div>

	
	
</div>
</body>
<style type="text/css">
	body{
		background-color: #cccccc;
	}
	#job_adds{
		width: 35%;
		float: left;
		height: 450px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 3%;
		background-color: #ffffff;
	}
	#job_listing{
		width: 60%;
		float: left;
		height: 450px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 3%;
		background-color: #ffffff;
	}
	#results_gantt{
		width: 55%;
		float: left;
		height: 250px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 1%;
		background-color: #e3e3e3;
	}
	#results_stats{
		width: 40%;
		float: left;
		height: 250px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 1%;
		background-color: #ffffff;
		padding: 2%;
	}
	#gannt{
		width: 100%;
		float: left;
		height: 250px;
		border: 1px ridge;
		margin: 2px;		
		background-color: #ffffff;
	}

</style>
<script type="text/javascript">
	$(document).ready( function () {
		var t = $('#table_id').DataTable();
	    var counter = 1;	 
	    $('#addRow').on( 'click', function () {
	        t.row.add( [
	        	'<input type="text" name="process_name[]" class="process">',
	        	'<input type="text" name="arrival_time[]" class="arrival">',
	        	'<input type="text" name="time[]" class="burst">',
	        	'<input size=25 type="button" class="delete" value="Remove"/>',
	        ] ).draw( false );
	 
	        counter++;
	    } );

	    $('#table_id tbody').on( 'click', '.delete', function () {
	    	t.row( $(this).parents('tr') ).remove().draw();
	    	
		} );
	    $('#jobs_form').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            type: 'post',
            url: 'compute.php',
            data: $('#jobs_form').serialize(),
            success: function (msg) {
              console.log(msg);
              $("#results_gantt").html(msg);

            }
          });

        });
        

	});
	
</script>
<script type="text/javascript">

</script>


</html>