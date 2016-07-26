<?php
	$processes = $_POST['process_name'];
	$arrival_times = $_POST['arrival_time'];
	$burst_times = $_POST['time'];
	$count = count($processes);
	$waiting_time = array();
	$turanaround_time = array();

	for ($i=0; $i <$count ; $i++) { 
		array_push($waiting_time, 0);
		array_push($turanaround_time, 0);
	}
	$temp = null;
	$temp_proc = null;
	for ($i=0; $i <$count ; $i++) { 
		for ($j=0; $j <$count -1 ; $j++) { 
			if($burst_times[$j]>$burst_times[$j+1]){
				$temp = $burst_times[$j];
				$burst_times[$j] = $burst_times[$j+1];
				$burst_times[$j+1] = $temp;

				$temp_proc = $processes[$j];
				$processes[$j] = $processes[$j+1];
				$processes[$j+1] = $temp_proc;

				
			}
		}
	}

	for ($i = 0; $i <$count; $i++) {
        $turanaround_time[$i] = $burst_times[$i] + $waiting_time[$i];
        $waiting_time[$i+1] = $turanaround_time[$i];
    }
            
    $total_time  = 0;
    for($i=0;$i<count($turanaround_time);$i++){
        $total_time+=$turanaround_time[$i];
    }

	for ($i=0; $i < $count; $i++) { 
		$message = "Process: ".$processes[$i]." Burst Time:".$burst_times[$i]." Waiting Time :".$waiting_time[$i]." TAT: ".$turanaround_time[$i];
		// echo "$message<br/>";
	}

	$processes = array_reverse($processes);
	$burst_times = array_reverse($burst_times);			
	
	$series = "";
	$count = 0;
	for ($i=0; $i < count($processes); $i++) { 
		if($count==0){
	    	$series.="{name:'".$processes[$i]."',data:[".$burst_times[$i]."]}";
	    }else{
	    	$series.=",{name:'".$processes[$i]."',data:[".$burst_times[$i]."]}";	    	
	    }
	    $count++;	    
	}
	$chart = "<div id=\"gannt\">";
	$chart .= "<script>$('#gannt').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Processes Gantt'
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
        series: [";        
		$chart.=$series;		
	$chart .="]  })";
	$chart.="</script></div>";    
    echo $chart;

?>
