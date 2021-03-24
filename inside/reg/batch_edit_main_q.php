<?php
include("../connection.php");


        $scb_aid = $_POST['scb_aid'];
		$course_id = $_POST['course_id'];
		$branch_id = $_POST['branch_id'];
		$startdate = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$si_state = $_POST['si_state'];
		$remarks = $_POST['remarks'];
	    $todayis = date("Y-m-d");
		$login_name = $_POST['login_name'];
		
		
//log
$scb_other="Batch got Edited by $login_name on $todayis";


		//echo "got it $scb_other"               ;


/*
		$startdate = $_POST['startdate'];
		$enddate = $_POST['enddate'];
		$si_state = $_POST['si_state'];
		$remarks = $_POST['remarks'];
	    $todayis = date("Y-m-d");

$query1="insert into student_course_batch ( scb_aid, scb_branch_id , scb_course_id , batch_start_date ,batch_end_date, batch_remarks, batch_state, scb_created_date) values ('$scb_aid', '$branch_id', '$course_id' ,'$startdate','$enddate','$remarks','$si_state','$todayis')";
	*/
						


$query="update student_course_batch set scb_branch_id='$branch_id', scb_course_id='$course_id', batch_start_date='$startdate',batch_end_date='$enddate', batch_state='$si_state' ,batch_remarks='$remarks', scb_other='$scb_other' where scb_aid='$scb_aid' ";
$result = mysqli_query($con, $query);


if (!($result ))
  {
  	echo("SQL : " . mysqli_error($con));
  }
else
  {
	  //update all the students with the corresponding start date //new
	  
$query99 = "SELECT batch_id, bi_std_id from student_course_batch_info where batch_id='$scb_aid' "; 
$result99 = $con->query( $query99 );
$num_results99 = $result99->num_rows;
if( $num_results99 > 0)
{
while( $row99 = $result99->fetch_assoc() ){
extract($row99);
//$course_id 
		$std_id=$bi_std_id;
		
		//update sc_date so the course reg date will be referred as batch start date
		$queryupdate="update student_course set sc_date='$startdate' where std_id='$std_id' and course_id='$course_id' ";
		$resultupdate = mysqli_query($con, $queryupdate);


}
}
	  
	  
	  //

	echo "<script>alert('Batch update success'); window.location.href = '../index.php?tab=batch_reg'; </script>";

  }

?>