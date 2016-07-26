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
	

	$current_time = $arrival_times[0];
	for ($i = 0; $i <count($processes); $i++) {
        $process_time = $burst_times[$i] + $current_time;
        $current_time+=$process_time;
        if(($i+1)<count($processes)){
        	$waiting_time[$i+1] = $process_time - $arrival_times[$i+1];
        }
    }

    $n = count($processes);
    $total_tatime  = 0;
    for($i=0;$i<count($turanaround_time);$i++){
    	$tat_sum = $burst_times[$i]+$waiting_time[$i];
        $total_tatime+=$tat_sum;
    }

    $total_waiting_time  = 0;
    for($i=0;$i<count($processes);$i++){
    	$wait_time = $waiting_time[$i]-$arrival_times[$i];
        $total_waiting_time+=$wait_time;
    }
    

    $avgwt = round(($total_waiting_time/$n),2);
    $avgtat = round(($total_tatime/$n),2);



	$results = array('average_wt'=>$avgwt,'avg_tat'=>$avgtat);

    echo json_encode($results);

?>
