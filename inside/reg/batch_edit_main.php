<?php 
	include("../connection.php");
	
    $batchidcaptured = $_GET['batch_idc']; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
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
  </head>

    <body class="nav-md">
    <div class="container body">
    <div class="main_container"> 
<?php
  


  
//retrieve batch information

$querycc = "select * from student_course_batch where scb_aid = '$batchidcaptured' ";
$resultcc = $con->query( $querycc );
$rowc = $resultcc->fetch_assoc();

//assign the result to certain variable so our html form will be filled up with values
//( scb_aid, scb_branch_id , scb_course_id , batch_start_date ,batch_end_date, batch_remarks, batch_state, scb_created_date)
$scb_aid= $rowc['scb_aid'];
$scb_branch_id = $rowc['scb_branch_id'];
$scb_course_id = $rowc['scb_course_id'];

$batch_start_date = $rowc['batch_start_date'];

$batch_end_date = $rowc['batch_end_date'];

$batch_remarks = $rowc['batch_remarks'];

$batch_state = $rowc['batch_state'];

$scb_created_date = $rowc['scb_created_date'];

//get current course name
$queryc2 = "select c_name from course where course_id = '$scb_course_id' ";
$resultc2 = $con->query($queryc2);
$rowc2 = $resultc2->fetch_assoc();
$selectedcoursename = $rowc2['c_name'];

//get current branch name
$queryc3 = "select name from branch where branch_id = '$scb_branch_id' ";
$resultc3 = $con->query($queryc3);
$rowc3 = $resultc3->fetch_assoc();
$selectedbranchname = $rowc3['name'];

?>
<br>


<table width="393" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="96" height="67" align="left" valign="middle"><button type="button" class="btn btn-warning" onClick="location.href='index.php?tab=batch_reg'">Back</button></td>
    <td width="297" align="left" valign="middle"><h2><ul><li> Update Batch Information</li></ul></h2></td>
  </tr>
</table>
<p>&nbsp;</p>
<hr>
  <br>
  <br>
  <br>
  <form class="form-horizontal" method="post" action="reg/batch_edit_main_q.php" >
    
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
					$select= '<select id="course_id" class="form-control" name="course_id">';
					
					 $select.='<option selected value='.$scb_course_id.'>'.$selectedcoursename.'</option>';
					
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
					$select= '<select id="branch" class="form-control" name="branch_id"  class="form-control">';
					
								$select.='<option selected value='.$scb_branch_id.'>'.$selectedbranchname.'</option>';
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
                            <input type='text' class="form-control" name="startdate" placeholder="Start Date" value='<?php echo $batch_start_date;?>' />
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
                            <input type='text' class="form-control" name="enddate" placeholder="End Date" value='<?php echo $batch_end_date;?>' />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
					  </div>
					  
					    <div class="form-group">
					 <!--batch_state-->
					    <label class="control-label col-md-3 col-sm-3 col-xs-12">Batch State</label>
                	        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select id="si_state" class="form-control" name="si_state">
													<option selected value='<?php echo $batch_state;?>'><?php echo $batch_state;?></option>
														<option value="Ongoing">Ongoing</option>
                           								<option value="Finished">Finished</option>
                                                        <option value="Hold">Hold</option>
                                     </select>
                        </div>
					    </div>
						
						         <div class="form-group">
								
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks</label>
						       <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" placeholder="Any Special Remarks" name="remarks" value='<?php echo $batch_remarks;?>'>
                        </div>
                      </div>

    <!--<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Registration Fee:</label>
      <div class="col-sm-4"> 
  <input type='text' name='regFee' class="form-control" value='<?php echo $regFee;?>' />
  </div>
    </div>-->
	
	
    	<input type='hidden' name='login_name' value='<?php echo $login_name ?>' />
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <input class="btn btn-primary" type='submit' value='Edit' />
    </div>
    </div>
  </form>
  
  <br>

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