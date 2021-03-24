<?php
include("../connection.php");


if(!isset($_GET['dlt'])){
	
	$man='';
	
}





if(isset($_GET['dlt'])){

//$sqlbr = "SELECT * FROM branch WHERE branch_id='".$_GET['dlt']."'";




$sqlbr = "
SELECT branch.name AS n , branch_per.percentage AS ptg ,branch.branch_id AS bidd
FROM branch
JOIN branch_per ON branch.branch_id = branch_per.branch_per_id
WHERE branch_per.branch_per_id='".$_GET['dlt']."'
;

 ";
 
 
 /*
SELECT percentage AS ptg, 	
branch_per_id AS bid
FROM branch_per
WHERE branch_per_id='".$_GET['dlt']."'

*/


$result2 = $con->query($sqlbr);
							
	if ($result2->num_rows > 0) {
						
						// output data of each row
						while($row = $result2->fetch_assoc()) {
							
						$man='<div class="container" id="c">
																		
																		 <form action="" method="post">
																		
																	
																	  <div class="panel-group">
																		
																		<div class="panel panel-primary">
																		  <div class="panel-heading"><h2><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Manage Branch: '.$_GET['dlt'].' : '.$row["n"].'</h2></div>
																		  <div class="panel-body">
																		  
																		  <div class="form-group">
																		  <label for="cname">Branch name:</label>
					 <input type="hidden" class="form-control" id="bidd" placeholder="Coursename" name="bidd" value="'.$row["bidd"].'">													  <input type="text" class="form-control" id="cname" placeholder="Branch name" name="cname" value="'.$row["n"].'">
																		</div>
																		<div class="form-group">
																		  <label for="dur">Percentage: %</label>
																		  
																		  
																		  
																		  
																		  
																		  
																		  
																		  
																		  <input type="text" class="form-control" id="dur" placeholder="Enter Percentage without Percentage mark %" name="p" value="'.$row["ptg"].'">
																		</div>
																		
																		
																		
																		
																		
																		
																		
																		  
																		  <center><input type="submit" value="Update changes" name="updatebrnc" class="btn btn-danger btn-lg"/><input type="submit" value="Cancel" name="canc" class="btn btn-warning btn-lg"/></center>
																		  
																		
																		  
																		  </div>
																		</div>
																				
																				 </form> <script>document.getElementById("newinser").disabled = true;</script></div>
																				 
																				 
																				 

																				  ';
																				  
	
	
	
						}}}
	
	
	
	
	






if(isset($_POST['subrnch'])){
	
	$branchname=$_POST['bnnn'];
	// to branch_per
	$presentage=$_POST['presnt'];
	
	
	
	$sql = "INSERT INTO branch (name)
VALUES ('$branchname')";

if ($con->query($sql) === TRUE) {
	
	
			 $sqlcount = "SELECT MAX(branch_id) AS max FROM branch";
								 $resultv = $con->query($sqlcount);
								 
								 if ($resultv->num_rows > 0) {
									
									while($row = $resultv->fetch_assoc()) {
												
												$nextID= $row["max"];
												$date=date("Y-m-d");
												$sessusr=$_SESSION['username'];
	
	
	
													$sqlins = "INSERT INTO branch_per(branch_per_id,percentage,date,editedBy)
										VALUES ('$nextID','$presentage','$date','$sessusr')";
										
										
										
										     
												if ($con->query($sqlins) === TRUE) {
													
													$msg='<div class="alert alert-success">
													  <strong>Success! New branch added successfully</strong>
													  
													  
													  
													 
													</div>';
													
													
													
													
													 				 //---update log---===================================================/
																
																
																
																$details='New branch `'.$branchname.'`  has been added.';
																
																$sqCl = "INSERT INTO log (log_admin_id,start_time,end_time,date,log_details)
																VALUES ('".$_SESSION['username']."','".time()."','newbranch','".date("Y-m-d")."','".$details."')";
																
																if ($con->query($sqCl) === TRUE) {
																	echo "Log updated";
																} else {
																	echo "Error: " . $sqCl . "<br>" . $con->error;
																}
																															
																//====================================================================
																
																
													echo ' <script>
													 self.location = "index.php?tab=branch"; 
													  </script>';
													
												}else{
													$msg='<div class="alert alert-danger">
													  <strong>ERROR! Creation of branch failed!</strong>
													</div>';
													
													echo ' <script>
													 self.location = "index.php?tab=branch"; 
													  </script>';
													
												}
													
													
	
	
					
														
									






									}
								 }






} else {

	$msg='<div class="alert alert-success">
  <strong>"Error: "' . $sql . '"<br>"' . $con->error.'"</strong>
</div>

';
}

$con->close();
}





if(isset($_POST['updatebrnc'])){
	
	
	
	
	
	
	
	$bname=$_POST['cname'];
	$p = $_POST['p'];
	$dte= date("Y-m-d");
	
	$bide = $_POST['bidd'];
	$sessn = $_SESSION['username'];
	
	
	
	if($bname&&$p){
	
	
				$sqlx = "UPDATE branch_per SET percentage='$p' ,date='$dte',editedBy='$sessn' WHERE branch_per_id='$bide'";
				
				
				if ($con->query($sqlx) === TRUE) {
					echo "Record updated successfully";
					
					echo"<script>
	
window.location = 'index.php?tab=branch';</script>";
					
				} else {
					echo "Error updating record: " . $con->error;
				}
				
				
				
				
					$sqly = "UPDATE branch SET 	name='$bname' WHERE branch_id='$bide'";
				
				
				if ($con->query($sqly) === TRUE) {
					echo "Record updated successfully";
																//---update log---===================================================/
																
																
																
																$details=''.$bname.' branch details updated.';
																
																$sqCl = "INSERT INTO log (log_admin_id,start_time,end_time,date,log_details)
																VALUES ('".$_SESSION['username']."','".time()."','edbranch','".date("Y-m-d")."','".$details."')";
																
																if ($con->query($sqCl) === TRUE) {
																	echo "Log updated";
																} else {
																	echo "Error: " . $sqCl . "<br>" . $con->error;
																}
																															
																//====================================================================
				
					
				} else {
					echo "Error updating record: " . $con->error;
				}
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				$con->close();
					
	
	}else{
		
		
	echo "fill all the fields";	
		
	}
	
	
	
}

if(isset($_POST['canc'])){
	
	echo"<script>
	


window.location = 'index.php?tab=branch';</script>";
	
	
	$msg="";
	
}
?>

<!DOCTYPE HTML>
<html>
<title>Ajax table - edit delete add rows with Ajax - InfoTuts</title>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="Admin/M_BRANCH/style.css" />
<script>


$("#alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#alert").slideUp(500);
});

 
</script>
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
#other-long-box{padding: 10px; border: #a8d4b1 1px solid;border-radius:4px; width:100%;}
</style>




</head>
<body>
<div id="mhead"> Manage Branch</div>


<div class="frmSearch">


<br>
<?php echo $msg;?>

<br>
<script>


function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(200)
                        ;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		</script>
        
        
        
        
<form action="" method="post" enctype="multipart/form-data"  >
          
  <br>
<div>
<table style="width:950px auto;" border="0" align="center" cellpadding="10" cellspacing="10">
  <tr>
    <td width="476" align="center" valign="top" bgcolor="#FFFFFF" style="padding: 10px; text-align: left;">
      
      <h2 style="color:red;">&#8226; <u>Add new branch</u></h2>
      
      <div class="form-group">
        <label>&#8227; Branch Name</label>
        
        <input type="text" name="bnnn" class="form-control"/ value=""  required>
        
        </div>
        <br>
        <div class="form-group">
        <label>&#8227; Percentage</label>
        
        <input type="text" name="presnt" class="form-control"/ value="20" required >
        
        </div>
        <br>
        <div class="form-group">
        <label>&#8227; Current user :</label>
        
        <?PHP echo $_SESSION['username']?>
        
        </div>
      <br></td>
    </tr>
</table>


            <br><p align="center"> <button type="submit" class="btn btn-primary  btn-lg" name="subrnch" id="subrnch" ><span class="glyphicon glyphicon-plus"></span> Insert new branch<br>
              
              
            </button></p>
</form>
         
            <hr style="border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); ">
         
         <?php echo $man;?>
         
         
      <div class="form-content">
  <div class="row">
	     
            
            

  <table  border="1" class="table table-striped" width="100%">
    <tr>
   <th  width="05%">Branch ID</th>
    <th  width="50%">Branch name</th>
     <th  width="50%">Percentage %</th>
  </tr>
 


<?php

$sqlccc ="SELECT branch.name AS nn , branch_per.percentage AS pp ,branch.branch_id AS biddz
FROM branch
JOIN branch_per ON branch.branch_id = branch_per.branch_per_id
ORDER BY branch.branch_id DESC";



$resultfff = $con->query($sqlccc);

if ($resultfff->num_rows > 0) {
    // output data of each row
    while($rowc = $resultfff->fetch_assoc()) {
				
				echo '<tr><td>'.$rowc["biddz"].'</td><td style="color:black; font-size:19px;"  >' . $rowc["nn"].'</td><td style="color:black; font-size:19px;"  >' . $rowc["pp"].'</td><input type="hidden" name="click" value=""><td>
											
		
    <a href="index.php?tab=branch&&dlt='.$rowc["biddz"].'" class="btn btn-warning">Edit branch
	</a><br/>
</td><br></tr>';
		
    		}
	
	
} else {
    echo "0 results";
}


?>


</table>


    <hr class="style16">



</body>
</html>
