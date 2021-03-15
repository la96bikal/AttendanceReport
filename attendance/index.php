<?php 	
	require('DataAccesslayer/DAL.php');
	require('DataAccesslayer/config/db.php');
	
	$courses = getCourseIDs(getConnectionString());
	
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

<script>
       
</script> 

<body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Attendance Report for 
                	 <! -- The dropdown option for Crouse IDs -->            
                	 <form action="" method="post" name = "courseForm">
				
                	 <select name = "formCourse">
                	 	<option value = ""></option>
                	<?php 
                		foreach($courses as $course){
                			echo '
                			<option value ="'.$course.'">'.$course.'</option>
                			';                			
                		}
                	?>
                	</select>

                	<input name = "submit" type = "submit" value = "Go">
                	</form>

               
                </h3>  
                <br />  

                <?php generateTable() ?>
                
           </div>  
      </body>  

</html> 

<script>  
 $(document).ready(function(){  
      $('#Attendance_Report').DataTable();  
 });  

 var auto_refresh = setInterval(function() { submitform(); }, 10000);
 	function submitform()
					{
  						document.getElementById("courseForm").submit();  									
					}         

</script>


 <?php

function generateTable(){
		$dates = [];
		if(isset($_POST['submit'])){    			
            $courseID = $_POST['formCourse'];               
            $dates = getDistinctDates(getConnectionString(), $courseID);  
        	$names = getDistinctNames(getConnectionString(), $courseID);        	
        	$attendanceInfo = getAttendanceInfo(getConnectionString());
        

		echo '
		<h1 align = "center"> Atteandace report for '.$courseID.' </h3>
		<div class="table-responsive">  
                     <table id="Attendance_Report" class="table table-striped table-bordered">  
                          <thead>  
                          		<tr>
                          			<td> Users </td>';                         		                          				
          foreach($dates as $date){
            echo '
            <td>'.$date.'</td>
            ';
            }     
                          			                          		
           echo '</tr>
                          </thead>'; 

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
	        echo '                 
                     </table>  
                </div>  
                ';
            }
	}
?>



  ?>