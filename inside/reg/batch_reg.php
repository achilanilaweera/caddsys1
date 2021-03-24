<?php 
	include("../connection.php");
?>
<?php 
$query4="select max(scb_aid) as sys from student_course_batch";

$result = mysqli_query($con, $query4);

if ($result->num_rows > 0) {
	
while($rows=mysqli_fetch_array($result))
{
	$scb_aid=$rows['sys']+1;
}

}else{
	$scb_aid=1;
}

?>
<?php
if (isset($_POST['create_batch'])){

	
	$scb_aid= $_POST['scb_aid'];
	$course_id = $_POST['course_id'];
	
	if($_POST['branch_id']==null){
	$branch_id= $_POST['branch_id'];
	}else{	
	$branch_id= $_POST['branch_id'];	
	}
	
	//ref  grpid -- > session change sbi_id 
	
	
	
		$startdate = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$si_state = $_POST['si_state'];
		$remarks = $_POST['remarks'];
	    $todayis = date("Y-m-d");

							$query1="insert into student_course_batch ( scb_aid, scb_branch_id , scb_course_id , batch_start_date ,batch_end_date, batch_remarks, batch_state, scb_created_date) values ('$scb_aid', '$branch_id', '$course_id' ,'$startdate','$enddate','$remarks','$si_state','$todayis')";
							
							$result = mysqli_query($con, $query1);

							
							if (!($result ))
							  {
								echo("Database Error : " . mysqli_error($con));
							  }
							else
							  {
								unset($_SESSION['scb_aid']);
								unset($_SESSION['course_id']);
								unset($_SESSION['branch_id']);

								$_SESSION['scb_aid']=$_POST['scb_aid'];
								$_SESSION['course_id']= $_POST['course_id'];
								$_SESSION['branch_id']= $_POST['branch_id'];
		
							echo "<script>alert('Batch creation was Successful'); window.location.href = 'index.php?tab=batch_reg'; </script>";
							  }

					 } else {
						
					 }

	?>
<?php
/*
if (isset($_POST['editbatch'])) {
	
	$batch_id = $_POST['batch_id'];
	echo $batch_id;


	
	echo "<script>window.location.href = 'index.php?tab=batch_edit&&batch_idc=$batch_id'; </script>";
  
}
*/
?>
<!DOCTYPE html>
<html lang="en">
  <head>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

<script type="text/javascript">
function delete_allgroup(mag) 
{ 
   if (confirm("Do you really want delete?")) {

	   window.location.href='reg/delete_group_full.php?gid='+mag;
	   
	  
    }else{
    return;
    }
}
</script>

  </head>

               <h3>Create a new Batch</h3>
               <div class="x_content">
               <br/>
               <form class="form-horizontal form-label-left input_mask" action="index.php?tab=batch_reg" method="post">
        
               <div class="form-group">
					
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Batch Number </label>
								  <div class="col-md-9 col-sm-9 col-xs-12">
							
                            <input type="text" name="scb_aid" class="form-control" value="<?php echo $scb_aid; ?>"  readonly="readonly">
                       </div> 
					   </div>

                        <div class="form-group">
				
						
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Course</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
            
                            <?php   
				
					
					//query
					$sql=mysqli_query($con,"SELECT c_name,course_id FROM course where state='T' ");
					if(mysqli_num_rows($sql)){
					$select= '<select id="branch" class="form-control" name="course_id" required><option selected disabled>Please select..</option>';
					
					while($rs=mysqli_fetch_array($sql)){
						  $select.='<option value="'.$rs['course_id'].'">'.$rs['c_name'].'</option>';
					  }
					}
					$select.='</select>';
					echo $select;
								?>
                    </div>
                    </div>
					
					
					
					    <div class="form-group">
				
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Branch</label>
									<div class="col-md-9 col-sm-9 col-xs-12">
                       
						
                            <?php   

					
						//if level 2 or 3 only can register to his branch
					if(($le==2)||($le==3))
					{
						$sql=mysqli_query($con,"SELECT branch_id , name FROM branch where branch_id='$bid'");
					}
					else
					{
					$sql=mysqli_query($con,"SELECT branch_id,name FROM branch");
					}
					
					
					
					
					if(mysqli_num_rows($sql)){
					$select= '<select id="branch" class="form-control" name="branch_id"  class="form-control" required><option selected disabled>Please select..</option>';
					
					while($rs=mysqli_fetch_array($sql)){
						  $select.='<option value="'.$rs['branch_id'].'">'.$rs['name'].'</option>';
					  }
					}
					$select.='</select>';
					echo $select;
?>
                    </div>  
                    </div>
					
					   <div class="form-group">
					   <label class="control-label col-md-3 col-sm-3 col-xs-12">Start Date</label>
                	   <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class='input-group date' id='myDatepicker'>
                            <input type='text' class="form-control" name="startdate" placeholder="Start Date" value="<?php echo date("Y-m-d"); ?>" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
					  </div>

					     <div class="form-group">
						
					     <label class="control-label col-md-3 col-sm-3 col-xs-12">End Date</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                         <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" name="enddate" placeholder="End Date"  />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
					  </div>
					  
					    <div class="form-group">
					
					    <label class="control-label col-md-3 col-sm-3 col-xs-12">Batch State</label>
                	        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="si_state" class="form-control" name="si_state">
                                <option selected value="Ongoing">Ongoing</option>
                           								<option value="Finished">Finished</option>
                                                        <option value="Hold">Hold</option>
                                     </select>
                        </div>
					    </div>
						
						         <div class="form-group">
								
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks</label>
						       <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Any Special Remarks" name="remarks">
                        </div>
                      </div>
					  

                  <br>
                  <br>
				        
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<button type="submit" class="btn btn-primary" name="create_batch">Create a new Batch</button> 
						</div>
                      </div>
                </form>
                    
                   
                    
                </div>    

        <br>
  <p>&nbsp;</p>      
              
  <h3>Edit Batch</h3>
<?php

	//note: change to find all but state finished to limit results if it gets crowded
					if(($le==2)||($le==3))
					{
						$sql = "select * from student_course_batch where scb_branch_id ='$bid' order by scb_aid desc ";
					}
					else
					{
						$sql = "select * from student_course_batch order by scb_aid desc";
					}
$result = $con->query($sql);

//( scb_aid, scb_branch_id , scb_course_id , batch_start_date ,batch_end_date, batch_remarks, batch_state, scb_created_date)


if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'><tr><th>Batch ID</th><th>Branch</th><th>Course ID</th><th>Start Date</th><th>End Date</th><th>Remarks</th>
	<th>State</th></tr>";
    // output data of each row

    while($row = $result->fetch_assoc()) {
		
//capture relevant branch and course names from their id's
//get current course name
$queryc2 = "select c_name from course where course_id = '" . $row["scb_course_id"]. "' ";
$resultc2 = $con->query($queryc2);
$rowc2 = $resultc2->fetch_assoc();
$selectedcoursename = $rowc2['c_name'];

//get current branch name
$queryc3 = "select name from branch where branch_id = '". $row["scb_branch_id"]."' ";
$resultc3 = $con->query($queryc3);
$rowc3 = $resultc3->fetch_assoc();
$selectedbranchname = $rowc3['name'];

		
        echo "<tr>
		<td>" . $row["scb_aid"]. "</td><td>".$selectedbranchname."</td>
		
		<td>".$selectedcoursename."</td>
		<td>" . $row["batch_start_date"]. "</td><td>" . $row["batch_end_date"]. "</td><td>" . $row["batch_remarks"]. "</td>
		<td>" . $row["batch_state"]. "</td>
		
		<td width='100px'>
		
		<form action='index.php?tab=batch_edit&&batch_idc=".$row["scb_aid"]."' method='post'>
		
		<input type='hidden' value='" . $row["scb_aid"]. "' name='batch_id'>
		
		<input type='hidden' value='" . $row["scb_course_id"]. "' name='course_idy'>
		
		<input type='hidden' value='". $row["scb_branch_id"]."' name='branch_idy'>
		
		<button type='submit' class='btn btn-warning' name='editbatch'>Edit Batch</button>
		
		</form>
		
		</td>
		
		
		<td width='100px'>
		
		<form action='index.php?tab=batch_reg&&scb_aid=".$row["scb_aid"]."' method='post'>
		
		<input type='hidden' value='" . $row["scb_aid"]. "' name='batch_idx'>
		
		<input type='hidden' value='" . $row["scb_course_id"]. "' name='course_idx'>
		
		<input type='hidden' value='". $row["scb_branch_id"]."' name='branch_idx'>
		
		<button type='submit' class='btn btn-primary' name='addStudents'>Add Students</button>
		
		</form>
		
		</td>
		

		
		</tr>";

    }
    echo "</table>";
} else {
    echo "No Batches Found!";
}

$con->close();

/*
		<td width='100px'><a href='javascript:delete_allbatch(".$row["scb_aid"].")'>
		<button type='button' class='btn btn-danger'>Delete Batch</button></a></td>*/
?>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	
	<script>
    $('#myDatepicker').datetimepicker({
	 format: 'YYYY-MM-DD'
	
	});
    
    $('#myDatepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
	
	</script>
</body>
</html>
