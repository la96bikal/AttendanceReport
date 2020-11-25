<?php 	
	require('DataAccesslayer/DAL.php');
	require('DataAccesslayer/config/db.php');

	$names = getDistinctNames(getConnectionString());	
	$dates = getDistinctDates(getConnectionString());
	$attendanceInfo = getAttendanceInfo(getConnectionString());
?>

<html>
<head>
	<title> Attendance Report </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
</head>

<body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Attendance Report for CSC2515</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="Attendance_Report" class="table table-striped table-bordered">  
                          <thead>  
                          		<tr>
                          			<td> Users </td>

	                          		<?php
	                          		foreach($dates as $date){
	                          			echo '
	                          			<td>'.$date.'</td>
	                          			';
	                          		}
	                          		?>
                               </tr>
                          </thead>                                
                          			<?php
	                          		foreach($names as $name){
	                          			echo '<tr>';	                          			
	                          			echo '<td>'.$name.'</td>';
	                          			foreach($dates as $date){
	                          				// echo $date;	                          					                          				
	                          				if(array_key_exists($date, $attendanceInfo[$name])){
	                          					echo '<td>'.$attendanceInfo[$name][$date].'</td>';
	                          				}
	                          				else{
	                          					echo '<td>'.'0'.'</td>';
	                          				}

	                          			}
	                          			echo '</tr>';
	                          		}
	                          		?>                    
                       
                     </table>  
                </div>  
           </div>  
      </body>  

</html> 

<script>  
 $(document).ready(function(){  
      $('#Attendance_Report').DataTable();  
 });  
 </script>  