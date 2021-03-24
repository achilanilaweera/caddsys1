<?php

	include("../check.php");	
	include("connection.php");

	
	if(isset($_SESSION['profileimg'])){
		
		$profileimg="<img src='Admin/M_ADMIN/users_profile_images/".$_SESSION['profileimg']."' alt='profile pic'>";	
		
	}else {
		
		
	$profileimg='<img src="img/adminn.png" alt="profile pic">';	
		
	}
	
	
	if($thisuserpass==md5("cadd")){
		

		echo '<div class="alert alert-warning" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Hello ! Welcome to CADD CENTER!</strong> First you must change your default password.. click <a href="index.php?tab=profile"> here</a>
</div>
</div>';
		
	}

	
?>
<?php

if($_GET['tab']!=''){
$t= $_GET['tab'];

}else if($_GET['tab']=NULL){
	$t='';
	
}


$msg="";

?>
<?php

if($le==1){
	
	$tabs = '  
				  	 <li><a><i class="fa fa-edit"></i>Payment Manage Panel<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=discountapr">View Approvals</a></li>
                       <li><a href="index.php?tab=alterdiscount">Alter Discounts</a></li>
					   <li><a href="index.php?tab=paymenterror">Error Correction Payment</a></li>
					   <li><a href="index.php?tab=payment_refund">Refund Payment</a></li>
					   
	
                    </ul>
                  </li>
				  
				  
				 <li><a><i class="fa fa-bar-chart-o"></i>Generate Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					   <li><a href="index.php?tab=report_gen_monthly">Get Monthly Report</a></li>
                      <li><a href="index.php?tab=report_gen_home">Report Generate Main</a></li>
					  <li><a href="index.php?tab=batch_report">Get Batch Report</a></li>
                       <li><a href="index.php?tab=report_gen_daily">Get per Day Report</a></li>
					   <li><a href="index.php?tab=report_gen_search_std">Get by Student</a></li>
				
                    </ul>
                  </li>
				  
				  		 <li><a><i class="fa fa-edit"></i>Manage<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=branch">Manage Branches</a></li>
                       <li><a href="index.php?tab=all_course">Manage Courses</a></li>
					   <li><a href="index.php?tab=manage_admin">Manage Admin</a></li>
					   <li><a href="index.php?tab=logh">Log History</a></li>
                    </ul>
									</li>
									<li><a href="../inside/Lecture/a_index.php"><i class="fa fa-desktop" ></i>Manage Lecture Coverages<span class=""></span></a></li>
									
				  
				  ';
	
	
}else if($le==2){
	//$tabs ="";	
	$tabs = '	 <li><a><i class="fa fa-edit"></i>Payment Manage Panel<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=discountapr">View Approvals</a></li>
                       <li><a href="index.php?tab=alterdiscount">Alter Discounts</a></li>
					   <li><a href="index.php?tab=paymenterror">Error Correction Payment</a></li>
						<li><a href="index.php?tab=payment_refund">Refund Payment</a></li>
						
                    </ul>
                  </li>
				  
				  	 <li><a><i class="fa fa-bar-chart-o"></i>View Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					   <li><a href="index.php?tab=report_gen_monthy_bm">Monthly Report</a></li>
					    <li><a href="index.php?tab=batch_report">View Batch Report</a></li>
 
                    </ul>
				  </li>
				  <li><a href="../inside/Lecture/index.php"><i class="fa fa-desktop" ></i>Manage Lecture Coverages<span class=""></span></a></li>
				  
				  
				  ';	
}
else if($le==3){
	$tabs ="";	
}
else if($le==4){
	//$tabs ="";	
	$tabs = '	 <li><a><i class="fa fa-edit"></i>Payment Manage Panel<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=discountapr">View Approvals</a></li>
                       <li><a href="index.php?tab=alterdiscount">Alter Discounts</a></li>
					   <li><a href="index.php?tab=paymenterror">Error Correction Payment</a></li>
						<li><a href="index.php?tab=payment_refund">Refund Payment</a></li>
						
                    </ul>
                  </li>
				  
				  	 <li><a><i class="fa fa-bar-chart-o"></i>View Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
					   <li><a href="index.php?tab=report_gen_monthy_bm">Monthly Report</a></li>
					    <li><a href="index.php?tab=batch_report">View Batch Report</a></li>
 
                    </ul>
				  </li>
				  <li><a href="../inside/Lecture/index_f.php"><i class="fa fa-desktop" ></i>Manage Lecture Coverages<span class=""></span></a></li>
				  
				  
				  ';	
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <link rel="icon" type="image/png" href="favicon.jpg">
      
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CADD</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	  <script src="report_gen/js/jquery-1.12.4.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php?tab=home" class="site_title"></i> <span><center><img src="logo/logo5.png" width="138" height="47" class="md md-album"/> </center></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                
                <ul class="nav side-menu">
                  <li><a href="index.php?tab=home"><i class="fa fa-home"></i> Home <span class=""></span></a>
                   
                  </li>
                   <li><a><i class="fa fa-edit"></i>Registration<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=regsingle">Individual</a></li>
                      <li><a href="index.php?tab=regrp">Group</a></li>
					  <li><a href="index.php?tab=batch_reg">Batch</a></li>
                       <li><a href="index.php?tab=all">Registered Student</a></li>
					     <li><a href="index.php?tab=updatestd">Update Student</a></li>
                    </ul>
                  </li>

      
				  
			     <li><a href="index.php?tab=payment_home"><i class="fa fa-table"></i> Payments <span class=""></span></a>
                   
                  </li>

				      <li><a><i class="fa fa-desktop"></i>Courses & Discounts<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.php?tab=viewcourse">View Courses</a></li>
                      <li><a href="index.php?tab=viewdiscount">Course Discounts</a></li>
           
                    </ul>
                  </li>
				  
                    
                     
                      
           
                    
                  </li>
  
				  <?php echo $tabs;?>
                  
                </ul>
              </div>
              <div class="menu_section">
               
                <ul class="nav side-menu">

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
           
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <?php echo $profileimg;?>  <?php echo $login_name;?> (<?php echo $login_user;?>)
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="index.php?tab=profile"> Profile</a></li>
                    <li><a href="index.php?tab=helpdesk"> Help</a></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
              
                 
                   
                 
					
                    <div class="clearfix">
                      <?php
					if($t=='home'){
						//Home page
					include "Admin/HOME/homeMAIN.php";
						
					}
			
			       else if(($t=='branch')&&($le==1))
				   {
						
					include "Admin/M_BRANCH/MANAGEBRANCHindex.php";
						
					} else if(($t=='logh')&&($le==1))
				   {
						
					include "Admin/USER_LOG/LogSindex.php";
						
					}else if(($t=='manage_admin')&&($le==1))
					{
						
					include "Admin/M_ADMIN/ADMINMANAGEindex.php";	
					}else if($t=='all_course'){
						
					include "Admin/M_COURSE/courseMANAGEindex.php";	
					}else if($t=='home'){
						include "Admin/HOME/homeMAIN.php";
						
					}
					//new add to batch feature
					else if($t=='batch_reg'){
						if(isset ($_GET['scb_aid'])){
							include "reg/batch_reg_list.php";
						}else{	
						include "reg/batch_reg.php";		
						}
					}
					else if($t=='batch_edit'){
						if(isset ($_GET['batch_idc'])){
							include "reg/batch_edit_main.php";
						}else{	
						include "reg/batch_reg.php";		
						}
					}
					else if($t=='batch_report'){
						include "report_gen/report_gen_by_batch.php";		
					}
	
					
					
					else if($t=='regsingle'){
						
					include "reg/single.php";
						
					}else if($t=='regrp'){
						
						
						if(isset ($_GET['ref'])&&($_GET['grpid'])){
							
							include "reg/grouplist.php";
							
						}else{
							
						include "reg/group.php";	
							
						}

					}else if($t=='all'){
						
						if(isset ($_GET['nic'])){
						
								if($_GET['nic']!=NULL){
									
									if($_GET['nic']="search"){
										
									include "reg/newReg.php";
									}

								}else{
									
									
									include "reg/all.php";	
								}
						}else{
							
							include "reg/all.php";
							
						}
					
					
					}
					else if($t=='profile'){
						include "Admin/Profile.php";
					}if($t=='updatestd'){

						if(isset ($_GET['search'])){
								if($_GET['search']=='result'){
								
								
								include "reg/update1.php";
								}
								
						}else if(isset ($_GET['edit'])){
							
								
								
								include "reg/edit.php";
								
						}else{
							
						include "reg/update.php";	
						}

						
					}
					
//report gen and payment part include by tab
//href index.php?tab=report_gen_view_sel_time_period_bcbb_day
				  else if($t=='report_gen_home'){
						include "report_gen/report_gen_home.php";
					}
					else if($t=='report_gen_monthly'){
						include "report_gen/report_gen_monthly_final.php";
					}
					else if($t=='report_gen_daily'){
						include "report_gen/report_gen_daily_final.php";
					}
					else if($t=='report_gen_search_std'){
						include "report_gen/report_gen_search_by_student.php";
					}
					
					else if($t=='report_gen_view_sel_time_period_bycourse_bybranch'){
						include "report_gen/report_gen_view_sel_time_period_bycourse_bybranch.php";
					}
					else if($t=='report_gen_view_selected_student'){
						include "report_gen/report_gen_view_selected_student.php";
					}
					
					else if($t=='report_gen_view_sel_month'){
						include "report_gen/report_gen_view_sel_month.php";
					}
					else if($t=='report_gen_view_sel_time_period_bcbb_day'){
						include "report_gen/report_gen_view_sel_time_period_bcbb_day.php";
					}
					else if($t=='report_gen_home_export'){
						include "report_gen/report_gen_home_export.php";
					}
					else if($t=='completesummary'){
							if(isset ($_GET['selmonth'])){
							include "report_gen/report_gen_complete_summary.php";
						}else{
						include "report_gen/report_gen_view_sel_month.php";
						}
					}
					else if($t=='helpdesk'){
						include "report_gen/help_desk.php";
					}
					else if($t=='report_gen_view_batch'){
						include "report_gen/report_gen_view_sel_time_period_batch.php";
					}
						else if($t=='report_gen_monthy_bm'){
						include "report_gen/report_gen_monthly_branch_mng.php";
					}
//report_gen_home_export
//payment part
//href index.php?tab=installment_first
					
					else if($t=='payment_home'){
						include "pay/pay1.php";
					}
					
					else if($t=='searchStd'){
						include "pay/searchStd.php";
					}
					/*
					else if($t=='installment_first'){
						include "pay/Instpay.php";
					}*/
			
					else if($t=='installment_first'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							
							include "pay/Instpay.php";
							
						}else{
						//include "pay/Instpay.php";
							include "pay/pay1.php";						
						}
					}
					else if($t=='installment_payment'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							include "pay/installment_payment.php";
							
						}else{
							include "pay/pay1.php";						
						}
					}
					else if($t=='fullpay'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							include "pay/fullpay1.php";
							
						}else{
							include "pay/pay1.php";						
						}
					}
						else if($t=='specialpayment'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							include "pay/special.php";
							
						}else{
							include "pay/pay1.php";						
						}
					}
					else if($t=='specialpayinstallment'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							include "pay/spc_installment_payment.php";
							
						}else{
							include "pay/pay1.php";						
						}
					}
						else if($t=='fullpaychangeddisc'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])){
							include "pay/full_payment_changed_dis.php";
							
						}else{
							include "pay/pay1.php";						
						}
					}
					else if($t=='viewdiscount'){
						include "pay/view_discount.php";
					}
					else if($t=='viewcourse'){
						include "pay/view_course.php";
					}
					else if($t=='discountapr'){
						include "pay/set_approval_state.php";
					}
					//approval for discounts
						else if($t=='approvediscount'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])&&($_GET['std_id'])){
							include "pay/set_approval_state_q.php";
							
						}else{
							include "pay/set_approval_state.php";						
						}
					}
						else if($t=='rejecteddiscount'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])&&($_GET['std_id'])){
							include "pay/set_approve_state_reject.php";
							
						}else{
							include "pay/set_approval_state.php";						
						}
					}
					else if($t=='alterdiscount'){
						include "pay/alter_discount_later.php";
					}
					else if($t=='paymenterror'){
						include "pay/paymenterror.php";
					}
					
						else if($t=='paymenterrorfix'){
						if(isset ($_GET['pr_id'])&&($_GET['pr_course_id'])&&($_GET['pr_std_id'])){
							include "pay/paymenterrorfix.php";
							
						}else{
							include "pay/paymenterror.php";						
						}
					}
					
						else if($t=='payment_refund'){
						include "pay/payment_refund_main.php";
					}
					
						else if($t=='payment_refund_in'){
						if(isset($_GET['course_id'])&&($_GET['std_id'])){
							include "pay/payment_refund_in.php";
							
						}else{
							include "pay/payment_refund_main.php";						
						}
					}
					
					else if($t=='changedisc'){
						if(isset ($_GET['nic'])&&($_GET['course_id'])&&($_GET['std_id'])){
							include "pay/alter_discount_selected.php";
							
						}else{
							include "pay/alter_discount_later.php";						
						}
					}
					
					
					
					?>
                    </div>
                    
                 
                    <br>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            CADD CENTRE LANKA (PVT) LTD. 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery 
    <script src="vendors/jquery/dist/jquery.min.js"></script>-->
	
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  
  </body>
</html>