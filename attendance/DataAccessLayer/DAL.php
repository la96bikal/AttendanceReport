<?php 		
	
	function getDistinctNames($conn){
		$query = "select Name from zoomuser";

		$result = mysqli_query($conn, $query);

		$name_list = mysqli_fetch_all($result, MYSQLI_NUM);

		$names = [];

		foreach($name_list as $name){
			$names[] = $name[0];
		}

		mysqli_free_result($result);	

		mysqli_close($conn);
		return $names;
	}

	function getDistinctDates($conn){
		$query = "select distinct date(JoinTime) from attendancedetail";

		$result = mysqli_query($conn, $query);

		$distinct_dates = mysqli_fetch_all($result, MYSQLI_NUM);

		$dates = [];

		foreach($distinct_dates as $date){
			$dates[] = $date[0];
		}

		mysqli_free_result($result);

		mysqli_close($conn);
		return $dates;
	}

	function getAttendanceInfo($conn){
		
		$rows = [];

		$query = "select * from attendance_info";

		$result = mysqli_query($conn, $query);

		$atendance_info = mysqli_fetch_all($result, MYSQLI_NUM);
		

		foreach($atendance_info as $attendance){	
			if(array_key_exists($attendance[0], $rows)){		
				$rows[$attendance[0]] += array($attendance[1] => $attendance[2]);
			}
			else{
				$rows[$attendance[0]] = array($attendance[1] => $attendance[2]);
			}
		}
				
		mysqli_free_result($result);

		mysqli_close($conn);
		return $rows;
	}
	
?>