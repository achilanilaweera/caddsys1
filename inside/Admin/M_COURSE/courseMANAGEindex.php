<?php

include("../connection.php");


if(isset($_POST['newi'])){
	
	//update course table
	
	$cn =$_POST["nc"];
	$cFEE=$_POST["nfee"];
	$cDU=$_POST["durr"];
	$TODAY =date("Y-m-d");
	
	
	$IN1=$_POST["ni1"];
	$IN2=$_POST["ni2"];
	$IN3 =$_POST["ni3"];
	
	
	
	
	//if($cn&&$cFEE&&$cDU&&$TODAY&&$IN1){

			$sqlCCC = "INSERT INTO course (course_id,c_name,course_fee,duration,state,addedDate)
					VALUES (null, '$cn','$cFEE','$cDU','T','$TODAY')";
			if ($con->query($sqlCCC) === TRUE) {
				
								//add installement
								
								
								
								 $sqlcount = "SELECT MAX(course_id) AS max FROM course";
								 $resultv = $con->query($sqlcount);
								 
								 if ($resultv->num_rows > 0) {
									
									while($row = $resultv->fetch_assoc()) {
												
												$nextID= $row["max"];
														$sqlins = "INSERT INTO course_installment(course_id,installment_01,	installment_02,	installment_03)
										VALUES ('$nextID','$IN1','$IN2','$IN3')";
										
										
										
										     
												if ($con->query($sqlins) === TRUE) {
													echo "<script>alert('New course added');</script>";
													
													
													
											  		           //---update log---===================================================/
																
																
																
																$details='New course '.$cn.'  has been added.';
																
																$sqCl = "INSERT INTO log (log_admin_id,start_time,end_time,date,log_details)
																VALUES ('".$_SESSION['username']."','".time()."','newcourse','".date("Y-m-d")."','".$details."')";
																
																if ($con->query($sqCl) === TRUE) {
																	echo "Log updated";
																} else {
																	echo "Error: " . $sqCl . "<br>" . $con->error;
																}
																															
																//====================================================================
													
												}
												
									
											}
									} else {
										echo "0 results";
									}
									
									$con->close();


				
				
			
				
				
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
	
	

}



	if(isset($_GET['manage'])){
		
		
		$mid = $_GET['manage'];
		
		
		
		
		
		$sqled = "SELECT * FROM course WHERE course_id='$mid'";
		$resulttty = $con->query($sqled);
		
		if ($resulttty->num_rows > 0) {
			
			
			
			
			
			
			
			// output data of each row
			while($row = $resulttty->fetch_assoc()) {
				
				
				
				
				
				
									$_SESSION['btns'] = "btn btn-warning disabled";
								
								//get installemnts
								
								
								$sqltwo = "SELECT * FROM course_installment WHERE course_id='$mid'";
							$result2 = $con->query($sqltwo);
							
							if ($result2->num_rows > 0) {
						
						// output data of each row
						while($row2 = $result2->fetch_assoc()) {
						
			
				
				$man= '<div class="container">
							
							 <form action="" method="post">
							
						
						  <div class="panel-group">
							
							<div class="panel panel-primary">
							  <div class="panel-heading"><h2><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Course: '.$row["c_name"].'</h2></div>
							  <div class="panel-body">
							  
							 
							  
							   <h3>Course details</h3>
							  
							  <div class="form-group">
							  <label for="cname">Course name:</label>
							  <input type="text" class="form-control" id="cname" placeholder="Coursename" name="cname" value="'.$row["c_name"].'" required>
							</div>
							<div class="form-group">
							  <label for="dur">Duration (Month):</label>
							  <input type="text" class="form-control" id="dur" placeholder="Duration (Month)" name="dur" value="'.$row["duration"].'" required>
							</div>
							<div class="form-group">
							  <label for="fee">Course fee:</label>
							  <input type="text" class="form-control" id="text" placeholder="Enter Total course fee" name="fee" onkeyup="myFunction(this.value)" value="'.$row["course_fee"].'" required>
							</div>
							
							
							  
							  
							  <hr>
							  <h3>Installemnts</h3>
							  
							  <div class="form-group">
							  <label for="i1">1st installement:</label>
							  <input type="text" class="form-control" id="i1" placeholder="1st installemen" name="i1" value="'.$row2["installment_01"].'" required>
							</div>
							<div class="form-group">
							  <label for="i2">2st installement:</label>
							  <input type="text" class="form-control" id="i2" placeholder="2nd installemen" name="i2" value="'.$row2["installment_02"].'" required>
							</div>
							<div class="form-group">
							  <label for="i3">3st installement:</label>
							  <input type="text" class="form-control" id="i3" placeholder="3rd installemen" name="i3" value="'.$row2["installment_03"].'" required>
							</div>
							  
							  
							  <center><input type="submit" value="Update changes" name="updatecourse" class="btn btn-danger btn-lg"/><input type="submit" value="Cancel" name="canc" class="btn btn-warning btn-lg"/></center>
							  
							
							  
							  </div>
							</div>
									
									 </form> <script>document.getElementById("newinser").disabled = true;</script></div>
									  ';
									  
									  
									  
									  $d="disabled";
							
				
				
				
				
						}
						
						
						
					} else {
			echo "Installements not found";
		}
				
				
				
				
				
				
				
			}
		} else {
			echo "0 results";
		}
				
		
		
		
							
		
	}else{
		
	$man="";	
	$d="";
		unset($_SESSION['btns']);
		
	}


	if(isset($_POST['canc'])){
		
		$man="";
		
		$d="";
		
		
		unset($_SESSION['btns']);
		$_SESSION['btns'] = "";
				
	}


















if(isset($_POST['updatecourse'])){
	
	unset($_SESSION['btns']);
	
	$midU = $_GET['manage'];

	
	$cn =$_POST["cname"];
	$cFEE=$_POST["fee"];
	$cDU=$_POST["dur"];
	$TODAY =date("Y-m-d");
	
	$IN1=$_POST["i1"];
	$IN2=$_POST["i2"];
	$IN3 =$_POST["i3"];
	
	
	//echo "<script>alert('".$midU."');
    
			$sd = "UPDATE course SET state='F', expdate='$TODAY' WHERE course_id='$midU'";

				if ($con->query($sd) === TRUE) {
					echo "Record updated successfully";
					
					
																//---update log---===================================================/
																
																
																$nm=$row["name"];
																$details=''.$cn.' course details has been updated.';
																
																$sqCl = "INSERT INTO log (log_admin_id,start_time,end_time,date,log_details)
																VALUES ('".$_SESSION['username']."','".time()."','upcourse','".date("Y-m-d")."','".$details."')";
																
																if ($con->query($sqCl) === TRUE) {
																	echo "log updated";
																} else {
																	echo "Error: " . $sqCl . "<br>" . $con->error;
																}
																															
																//====================================================================
				} else {
					echo "Error updating record: " . $conn->error;
				}
				
				
	
	
	

			$sqlx = "INSERT INTO course (course_id,c_name,course_fee,duration,state,addedDate)
					VALUES (null, '$cn','$cFEE','$cDU','T','$TODAY')";
			
			
if ($con->query($sqlx) === TRUE) {		
			
			
			
			
	 							$sqlcount = "SELECT MAX(course_id) AS max FROM course";
								 $resultv = $con->query($sqlcount);
								 
								 if ($resultv->num_rows > 0) {
									
									while($row = $resultv->fetch_assoc()) {
												
												$nextID= $row["max"];		
												$sqlc= "INSERT INTO course_installment (course_id, installment_01, installment_02,installment_03)
												VALUES ('$nextID', '$IN1', '$IN2','$IN3')";
												
												
												/*
												
												if ($con->query($sqlx) === TRUE) {
													echo "New record created successfully";
												} else {
													echo "Error: " . $sql . "<br>" . $conn->error;
												}
										*/
										
												if ($con->query($sqlc) === TRUE) {
													echo "New record created successfully";
													
															
							$man='<div class="alert alert-success" role="alert" id="success-alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Success!</strong> Changed successfully!
							</div>
							<script>
							$("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
								$("#success-alert").slideUp(500);
							});</script>';
							
							
							
												} else {
													echo "Error: " . $sql . "<br>" . $conn->error;
												}
										
												
												$d="";
		
	
	
									}
								 }
	
	
	
	
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
								 

//	$conn->close();
	
	
	
						


	
	
}
?>

<!DOCTYPE HTML>
<html>
<title>Ajax table - edit delete add rows with Ajax - InfoTuts</title>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="Admin/M_COURSE/style.css" />

<style>
.w3-button {width:150px;}
</style>


<style>
.frmSearch {position:relative;border: 1px solid #a8d4b1;background-color: #F3F3F3;margin: 2px 0px;padding:20px;border-radius:4px;}
#country-list{list-style:none;margin-top:-90px;padding:0;width:220px;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px; border: #a8d4b1 1px solid;border-radius:4px;}
#other-box{padding: 10px; border: #a8d4b1 1px solid;border-radius:4px;}
</style>

 </head>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 	<link rel="stylesheet" type="text/css" href="Admin/M_COURSE/css/jquery.dataTables.css">
		<script type="text/javascript" language="javascript" src="Admin/M_COURSE/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="Admin/M_COURSE/js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"Admin/M_COURSE/employee-grid-data.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
		
 
 
 
 
 
 
 
 
 
 
 
 
</head>
<body>
<div id="mhead"> Manage Courses
</div>


<div class="frmSearch">


<br>
<?php echo $msg;?>

<br>
<script>


function newaddfu(tv) {
	


var value = (tv/3).toFixed(0);

document.getElementById("ni1").value =value ;
document.getElementById("ni2").value =value ;
document.getElementById("ni3").value =value ;	
           
        }
		
		</script>

<form action="index.php?tab=all_course" method="post" enctype="multipart/form-data">

<br>
<table style="width:950px auto;" border="0" align="center" cellpadding="10" cellspacing="10">
  <tr>
    <td width="302" align="center" valign="top" bgcolor="#FFFFFF" style="padding: 10px; text-align: left;">
    
    <h2 style="color:red;">&#8226; <u>Course Details</u></h2>
    
    <div class="form-group">
                            <label>&#8227; Course Name</label>
							
                          <input type="text" name="nc" class="form-control"/ value=""  required>
                            
                        </div><br>
                  
        <div class="form-group">
                            <label>&#8227; Course fee  </label>
                            <input type="text" name="nfee" id="nfee" class="form-control" onKeyUp="newaddfu(this.value)" value="0" required/>
                        </div>
                        <br>
                         <div class="form-group">
                           
                           <label for="checkbox_row_4">&#8227; 
                           Duration (Months)</label>
                           <input type="text" name="durr" id="durr" class="form-control" required />
                            <div class="username_availability_result" id="username_availability_result"></div>
                        </div>
      </td>
    <td width="308" align="center" valign="top"  bgcolor="#FFFFFF" style="padding: 10px; text-align: left;"> 
    
    
    
    <h2 style="color:red;">&#8226; <u>Installments</u></h2>
    
      <div class="form-group">
                            <label>&#x2023; 1st Installment</label>
							
                          <input type="text" name="ni1" id="ni1" class="form-control"/ value="0"  required >
                            
        </div><br>  <div class="form-group">
                            <label>&#x2023; 2nd Installment</label>
							
                          <input type="text" name="ni2" id="ni2" class="form-control"/ value="0"  required>
                            
                        </div>
                          <br>
                            <div class="form-group">
                            <label>&#x2023; 3rd Installment</label>
							
                          <input type="text" name="ni3" id="ni3" class="form-control"/ value="0"  required>
                            
                        </div>
                      
      </td>
  </tr>
</table>
<br>
<center>
<input type="submit" class="btn btn-primary  btn-lg" name="newi"  value="Insert new course">

</center>
</form>

<div class="form-content">
  <div class="row">
  <div class="col-md-3">
 </div>
					
					
                   
					
                    
	<div class="col-md-3">
                       
    </div>
                    
    <div class="col-md-3">
                     
    </div>
      <br>
      
      
            <br><p align="center">&nbsp;</p>
            <br>
            <br>
            <hr style="border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); ">
            <br>
            
            <?php echo $man;?>
            
            
            <br>
  <div class="table-responsive" align="center" id="hhh">          

			<table border="0" align="center" cellpadding="0" cellspacing="0"  class="table" id="employee-grid"  >
					<thead>
						<tr>
							<th width="5%">course ID</th>
							<th  width="30%">Course name</th>
							<th  width="10%">Total fee</th>
                            <th  width="10%">Duration (months)</th>
                             <th  width="15%">Update date</th>
                            <th>Manage</th>
						</tr>
					</thead>
	</table>
  </div>
    <br>
    <hr class="style16">
  <div class="col-md-3"><br>


<hr>



<br>

<br><br>

</body>
</html>
