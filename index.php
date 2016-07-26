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
			<table id="table_id" class="display" width="80% !important">
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
						<td><input type="number" name="arrival_time[]"></td>
						<td><input type="number" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="number" name="arrival_time[]"></td>
						<td><input type="number" name="time[]"></td>						
					</tr>
					<tr>
						<td><input type="text" name="process_name[]"></td>
						<td><input type="number" name="arrival_time[]"></td>
						<td><input type="number" name="time[]"></td>						
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
		width: 95%;
		float: left;
		height: 250px;
		border: 1px ridge;
		margin: 2px;
		margin-top: 1%;
		background-color: #e3e3e3;
	}
	#gannt{
		width: 37%;
		float: left;
		height: 250px;
		border: 1px ridge;
		margin: 2px;		
		background-color: #ffffff;
	}

</style>
<script type="text/javascript">
	$(document).ready( function () {
	    $('#table_id').DataTable();
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
	
/*	$('#gannt').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Stacked bar chart'
        },
        xAxis: {
            categories: ['Processes']
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Burst Times'
            }
        },
        legend: {
            reversed: true
        },
        plotOptions: {
            series: {
                stacking: 'normal'
            }
        },
        series: [{name:'a',data:[5]},{name:'as',data:[3]},{name:'as',data:[2]}]  })*/
</script>

</html>