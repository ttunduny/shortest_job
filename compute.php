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
	$smallest_arrival = 1000000;

	for ($i=0; $i <$count ; $i++) { 
		for ($j=0; $j <$count -1 ; $j++) { 
			if($burst_times[$j]>$burst_times[$j+1]){
				$temp = $burst_times[$j];
				$burst_times[$j] = $burst_times[$j+1];
				$burst_times[$j+1] = $temp;

				$temp_proc = $processes[$j];
				$processes[$j] = $processes[$j+1];
				$processes[$j+1] = $temp_proc;


				$temp_waiting = $waiting_time[$j];
				$waiting_time[$j] = $waiting_time[$j+1];
				$waiting_time[$j+1] = $temp_waiting;
				
				$temp_arrival = $arrival_times[$j];
				$arrival_times[$j] = $arrival_times[$j+1];
				$arrival_times[$j+1] = $temp_arrival;

				
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
    $n = count($processes);
    $total_tatime  = 0;
    for($i=0;$i<count($turanaround_time);$i++){
        $total_tatime+=$turanaround_time[$i];
    }
    $total_waiting_time  = 0;
    for($i=0;$i<count($waiting_time);$i++){
        $total_waiting_time+=$waiting_time[$i];
    }

    $avgwt = $total_waiting_time/$n;
    $avgtat = $total_tatime/$n;

	for ($i=0; $i < $count; $i++) { 
		$message = "Process: ".$processes[$i]." Burst Time:".$burst_times[$i]." Waiting Time :".$waiting_time[$i]." TAT: ".$turanaround_time[$i];
		// echo "$message<br/>";
	}

	$min = 1000000;
	for ($i=0; $i < count($arrival_times); $i++) { 
		if($arrival_times[$i]<$min){
			$min = $arrival_times[$i];
		}
	}
	$processes = array_reverse($processes);
	$burst_times = array_reverse($burst_times);			
	
	$series = "";
	$count = 0;
	for ($i=0; $i < count($processes); $i++) { 
		$burst_time = $min + $burst_times[$i];
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
            min: ".$min.",
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

	$results = array('chart'=>$chart,'average_wt'=>$avgwt,'avg_tat'=>$avgtat);

    echo $chart;

?>
