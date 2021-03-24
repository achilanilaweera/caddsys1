<?php
include '../connection.php';
ob_start(); 
$mydate3 = $_POST['item24'];
$mydate2 = "$mydate3-01";
$mydate1 = "$mydate3-31";

$lec22 = $_POST['item83'];
$course22 = $_POST['item88'];

 $output = ''; 

if(isset($_POST["export_viewsummary"]))   
{
					
                echo "    <div class='clearfix'></div>";
               echo "   </div>";
             echo "     <div class='x_content'>";
         echo"<h2></h2>";
            echo "<h3 class='text-muted font-24 m-t-30' style='margin-top:20px;'> <b>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<u> CADD CENTER LANKA - Confirmed Lecture Payments Report</u> </b></h3>";
            echo "</br>";  
            echo "</br>";  
            
           
         
            echo "     <table id='datatable' class='table table-striped table-bordered'>";
                   echo "   <thead>";
                   echo "   <tr>"; echo "</tr>";
                   echo "   <tr>"; echo "</tr>";
                     echo "   <tr>";
                   
                     echo "     <th></th>";
                     echo "     <th>Date</th>";
                      echo "    <th>Start Time</th>";
                      echo "    <th>End Time</th>";
                      echo "    <th>Time Duration</th>";
					echo "	  <th>Lecture Coverage</th>";
                    echo "     <th></th>";
                        echo "</tr>";
                      echo "</thead>";
					 echo "<tbody>";

                     

		// $query = "select t.* , c.rate from t_time t, c_assign c where t.pay_confirm='Approved' and c.c_name=t.co_name and c.l_name=t.le_name and t.le_name like '$lec22' and t.rdate BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "'";
$query= "select t.*, c.rate from t_time t, c_assign c, lec_pay l where t.le_name like '$lec22' and t.co_name like '$course22' and t.rdate BETWEEN '" . $mydate2 . "' AND  '" . $mydate1 . "' and c.c_name=t.co_name and l.as_id=c.id and l.finalize='Approved'";


$result = $con->query( $query );


$num_results = $result->num_rows;
$remainingBal=0;
$totIns1 = 0;
$totIns2 = 0;
$totIns3 = 0;

//stylesheet to display colors accordingly
echo "<style>
		.lowerthan100{
 background-color:red;
 color:white;   
}
.higherthan100{
 background-color:white;   
 color:red;
}
 .lowert{
 background-color:blue;
 color:white;   
 }
 .fullcomplete{
 background-color:LimeGreen;
 color:black;   
 }
 .instnotstarted{
 background-color:GreenYellow;
 color:black;   
 }
 .needattention{
 background-color:OrangeRed;
 color:black;   
 }
 .pastdue{
 background-color:red;
 color:white;  
 }
 .stillpaying{
 background-color:Yellow;
 color:black;   
 }
 .installmentcomplete{
 background-color:LightGreen;
 color:black;   
 }
 
</style>";
echo "<tr>";
echo "<h4 class='text-muted font-15 m-b-15'> &nbsp; &nbsp; &nbsp; &nbsp;<b>* Lecturer Name : $lec22 </b></h4>";
echo "<h4 class='text-muted font-15 m-b-15'>  &nbsp; &nbsp; &nbsp; &nbsp;<b>* Course Name : $course22 </b></h4>";
echo "<h4 class='text-muted font-15 m-b-15'>  &nbsp; &nbsp; &nbsp; &nbsp;<b>* Month : $mydate3  </b></h4>";
echo "<h4 class='text-muted font-15 m-b-15'>  &nbsp; &nbsp; &nbsp; &nbsp;<b>----------------------------------------------------------------------------------------------------- </b></h4>";
echo "</tr>";
if( $num_results > 0)
{ 

while( $row = $result->fetch_assoc() ){
 
extract($row);
// echo "<h4 class='text-muted font-15 m-b-15'>  &nbsp; &nbsp; &nbsp; &nbsp;<b>* Month : $rate  </b></h4>";


echo "<tr>";


echo "<td></td>";
echo "<td>{$rdate}</td>";
echo "<td>{$s_time}</td>";
echo "<td>{$e_time}</td>";
echo "<td>{$to_time} hrs</td>";
echo "<td>{$coverage}</td>";
echo "<td></td>";
echo "</tr>";



}

       echo "</tbody>";
            echo "</table>";
            echo "<h4 class='text-muted font-15 m-b-15'>  &nbsp; &nbsp; &nbsp; &nbsp;<b>----------------------------------------------------------------------------------------------------- </b></h4>";
            echo "<h6> &nbsp; &nbsp; &nbsp; &nbsp;System Generated Report on " . date("d/m/Y") . "</h6>";
            
            echo "</div>";
            echo "</div>";
            echo "</div>";
		    echo " </div>";

echo "<br/> <br/>";

             echo "<div class='clearfix'></div>";
             echo "</div>";
             echo "<div class='x_content'>";
           

           header("Content-Type: application/xls");   
           header("Content-Disposition: attachment; filename=$lec22.$course22.$mydate3.Confirmed_Lecture_Payments.xls");    
           echo $output;

}

else if($lec22=='' or $course22=='' or $mydate3=='')
{

  echo "<script>alert('All the fields are required!!!'); window.location.href = '../Lecture/f_conpay.php'; </script>";
}
 else{
  echo "<script>alert('No any confirmed payments for the selected data!!!'); window.location.href = '../Lecture/f_conpay.php'; </script>";
  
 }

}

	
?>