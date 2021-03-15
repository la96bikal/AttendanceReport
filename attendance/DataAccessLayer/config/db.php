<?php	
	function getConnectionString(){
		$conn = mysqli_connect('localhost', 'root', '', 'zoomattendancedb');
		return $conn;
	}
	if(mysqli_connect_errno()){
		echo 'Failed to connect to MySQL '. mysqli_connect_errono();
	}

?>