<?php 		
	
	function getDistinctNames($conn, $courseID){
		$query = "select distinct(Name) from zoomuser inner join attendancedetail on zoomuser.email = attendancedetail.Email where attendancedetail.CourseID = '{$courseID}'";
		
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

	function getDistinctDates($conn, $courseID){
		$query = "select distinct date(JoinTime) from attendancedetail where courseID = '{$courseID}'";
	

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
	
	function getCourseIDs($conn){
		$courses = [];

		$query = "select CourseID from courseinfo";

		$result = mysqli_query($conn, $query);

		$course_info = mysqli_fetch_all($result, MYSQLI_NUM);		

		foreach($course_info as $courseID){
			$courses[] = $courseID[0];
		}

		mysqli_free_result($result);

		mysqli_close($conn);
		return $courses;
	}
?>