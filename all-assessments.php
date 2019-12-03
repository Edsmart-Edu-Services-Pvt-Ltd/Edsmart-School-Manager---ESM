<head>
<meta charset="UTF-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>		
		<link href="assets/css/custom_all_assessments.css" rel="stylesheet" type="text/css" />
		<!-- jothi code 13.11.2019
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
  
  
		<script>
		$(function () {
    $("select").selectpicker();
});
		</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101424366-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-101424366-1');
</script>
</head>
<body>


<div class="loader"></div>


</body>
<?php
	ini_set('max_execution_time', 0);
   require_once("./include/membersite_config.php");
   include("./include/html_codes.php");

   	$fgmembersite = $GLOBALS['fgmembersite'];
   	$id_user=$fgmembersite->idUser();
   	$role = $_SESSION['user_role'];
    
   	if (!$fgmembersite->CheckLogin()) {
   		$fgmembersite->RedirectToURL("login.php");
   	}

	defaultConfig();
	admin_way_top();
	admin_top_bar();
	admin_left_menu();
	$connect = $GLOBALS['connect'];
	
	$conn=mysqli_connect('localhost','root','vishnu312$','edsmart_demo');
	
	if(isset($_SESSION['school_region'])){
		$sesMonth=$_SESSION['school_region'];
		$monQuery="SELECT * FROM region WHERE region='".$sesMonth."'";
        $resss=mysqli_query($conn,$monQuery);
        $mdata=mysqli_fetch_all($resss,MYSQLI_ASSOC);
    
     foreach ($mdata as $keey => $vaalue) {
     	if($vaalue['calender_month']==1){
     		$mdata[$keey]['month']='Jan';
     	}
     	if($vaalue['calender_month']==2){
     		$mdata[$keey]['month']='Feb';
     	}
     	if($vaalue['calender_month']==3){
     		$mdata[$keey]['month']='Mar';
     	}
     	if($vaalue['calender_month']==4){
     		$mdata[$keey]['month']='Apr';
     	}
     	if($vaalue['calender_month']==5){
     		$mdata[$keey]['month']='May';
     	}
     	if($vaalue['calender_month']==6){
     		$mdata[$keey]['month']='Jun';
     	}
     	if($vaalue['calender_month']==7){
     		$mdata[$keey]['month']='Jul';
     	}
     	if($vaalue['calender_month']==8){
     		$mdata[$keey]['month']='Aug';
     	}
     	if($vaalue['calender_month']==9){
     		$mdata[$keey]['month']='Sep';
     	}
     	if($vaalue['calender_month']==10){
     		$mdata[$keey]['month']='Oct';
     	}
     	if($vaalue['calender_month']==11){
     		$mdata[$keey]['month']='Nov';
     	}
     	if($vaalue['calender_month']==12){
     		$mdata[$keey]['month']='Dec';
     	}
     	if($vaalue['calender_month']==0){
     		$mdata[$keey]['month']='Holiday';
     	}


     }
      //echo "<Pre>";print_r($mdata);exit;

}

	if(isset($_POST['done'])){
		$id = $_POST['id'];
		$start_time = $_POST['start_time'];
		$end_time = time();
		$recorded_time =  gmdate("i:s",($end_time)-($start_time));
		$rating = $_POST['rating'];
		$comment = $_POST['comments'];
		mysqli_query($connect,"UPDATE edsmart_".$_SESSION['school_page_url'].".all_assessments SET rating='".$rating."',comment='".$comment."',recording_time='".$recorded_time."',status='1' WHERE id=".$id);


	}
	
	
		
	if(isset($_POST['skipped'])){   
		$id = $_POST['id'];   
		$start_time = $_POST['start_time'];
		$end_time = time();
		$recorded_time =  gmdate("i:s",($end_time)-($start_time));
		$rating = $_POST['rating'];
		$comment = $_POST['comments']; 
		mysqli_query($connect,"UPDATE edsmart_".$_SESSION['school_page_url'].".all_assessments SET rating='".$rating."',comment='".$comment."',recording_time='".$recorded_time."',status='2' WHERE id=".$id);
	}
	
	if(isset($_POST['done_bulk'])){
		$ids = explode(",",$_POST['hidden_all_checked_items']);
		$start_time = $_POST['start_time'];
		$end_time = time();
		$recorded_time =  gmdate("i:s",($end_time)-($start_time));
		$rating = $_POST['rating'];
		$comment = $_POST['comments'];
		foreach($ids as $id){
		mysqli_query($connect,"UPDATE edsmart_".$_SESSION['school_page_url'].".all_assessments SET rating='".$rating."',comment='".$comment."',recording_time='".$recorded_time."',status='1' WHERE id=".$id);
		}


	}
	if(isset($_POST['skipped_bulk'])){
		$ids = explode(",",$_POST['hidden_all_checked_items']);
		$start_time = $_POST['start_time'];
		$end_time = time();
		$recorded_time =  gmdate("i:s",($end_time)-($start_time));
		$rating = $_POST['rating'];
		$comment = $_POST['comments'];
		foreach($ids as $id){

			mysqli_query($connect,"UPDATE edsmart_".$_SESSION['school_page_url'].".all_assessments SET rating='".$rating."',comment='".$comment."',recording_time='".$recorded_time."',status='2' WHERE id=".$id);
		}
	}


	
?>


<style>




.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('loading.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}

.user-rating {
    direction: rtl;
    font-size: 20px;
    unicode-bidi: bidi-override;
    padding: 10px 30px;
    display: inline-block;
}
.user-rating input {
    opacity: 0;
    position: relative;
    left: -15px;
    z-index: 2;
    cursor: pointer;
}
.user-rating span.star:before {
    color: #777777;
    content:"ï€†";
    /*padding-right: 5px;*/
}
.user-rating span.star {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    position: relative;
    z-index: 1;
}
.user-rating span {
    margin-left: -15px;
}
.user-rating span.star:before {
    color: #777777;
    content:"\f006";
    /*padding-right: 5px;*/
}
.user-rating input:hover + span.star:before, .user-rating input:hover + span.star ~ span.star:before, .user-rating input:checked + span.star:before, .user-rating input:checked + span.star ~ span.star:before {
    color: #ffd100;
    content:"\f005";
}

.selected-rating{
    color: #ffd100;
    font-weight: bold;
    font-size: 3em;
}
.footer{
	position: fixed;
    padding-top: initial;
	padding-top:20px;
}
 .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: auto !important;
}
.btn-warning {
    background-image: linear-gradient(to bottom, #ffdf06, #ea8e15c9);
    width: 116px !important;
}
.bootstrap-select .dropdown-toggle .filter-option-inner-inner{
     color:black !important;
}
.bootstrap-select>.dropdown-toggle.bs-placeholder{
	    color: #191616 !important;
}
.filter-option-inner{
	  font-weight:500 !important;
}
.bootstrap-select .dropdown-menu.inner {
    padding: 5px !important;
    width: max-content;
}
.dropdown-menu.inner{
	max-height:200px;
}
<!--.inner .dropdown-menu ul{
	  max-height: 188.438px;
    position: fixed;
    overflow-y: auto;
    width: 10%;
} -->
.bootstrap-select>.dropdown-toggle.bs-placeholder {
    color: #191616 !important;
    min-width: min-content;
    padding-right: initial;
}
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
<!-- Start content -->

<div class="content">
   <div class="container">
      <div class="row">
	  <div id="top_fix_wrap6" class="top_fix_wrap6">
	             <div class="top_fix">
         <div class="page-title-box">
            <button class="btn btn-custom waves-effect waves-light btn-sm create_succcess"  style="display:none;">Click me</button>
            <h4 class="custom_page_title">Assessments</h4>
         </div>
		  <div class="card-box"> <?php
				echo "<form method='get'>";
				echo "<select class='custom_selectpick' data-style='btn-warning' name='activity_code' id='activity_code' style='margin-right:10px;margin-top:10px; display:none'>";
				echo "<option value=''>Class Name</option>";
				$sql = mysqli_query($connect,"SELECT * FROM temp_activity_code WHERE activity_code!='' ORDER BY activity_code ASC");
				 while($row = mysqli_fetch_array($sql)){
					 $sel = "";
					 if(($_GET['activity_code']) == $row['activity_code']){ $sel = " Selected "; }
					 if(!empty($row['activity_code'])){  echo "<option value='".$row['activity_code']."' ".$sel.">".$row['activity_code']."</option>"; }

				 }
				 echo "</select>";

// Class Name Filter  starts

         echo "<select class='selectpicker' data-style='btn-warning' name='class_name' id='class_name' style='margin-right:10px;margin-top:10px; '>";
 				echo "<option value=''>Class Name</option>";
 				$sql = mysqli_query($connect,"SELECT * FROM all_classes WHERE class_name!='' ORDER BY class_name ASC");
				
				
				
				if($role=="Teacher"){
					
						$sql_all_users = mysqli_query($connect,"SELECT * FROM  all_users WHERE user_id=".$id_user);
						while($row_all_users = mysqli_fetch_array($sql_all_users)){
							  $classess_assigned_arr = explode(",",$row_all_users['classes_assigned']);
						  }
							$classess_assigned = implode("','",$classess_assigned_arr);
					
								
												
					
					while($row = mysqli_fetch_array($sql)){
 					 $sel = "";
					 if(isset($_GET['class_name'])){
						 if(($_GET['class_name']) == $row['class_name']){ $sel = " Selected "; 

								
												
						}
					 }
					 else { 
							if(($row['class_unique_id'])== $classess_assigned){
								$sel = " Selected ";
								
						 
							}
						 }
						
 					 if(!empty($row['class_name'])){  echo "<option value='".$row['class_name']."' ".$sel.">".$row['class_name']."</option>"; }
				
 				 }
				}
				else{
					
 				 while($row = mysqli_fetch_array($sql)){
 					 $sel = "";
					 if(isset($_GET['class_name'])){
						 if(($_GET['class_name']) == $row['class_name']){ $sel = " Selected "; 

								
												
						}
					 }
					 else { $sel = " Selected ";
								
						 }
						
 					 if(!empty($row['class_name'])){  echo "<option value='".$row['class_name']."' ".$sel.">".$row['class_name']."</option>"; }
				
 				 }
				}
 				 echo "</select>";

// Class Name Filter  Ends   
				/*echo "<select name='activity_name' id='activity_name' style='margin-right:10px;margin-top:10px;display:none'>";
				echo "<option value=''>Activity name</option>";
				$sql = mysqli_query($connect,"SELECT * FROM temp_activity_name WHERE activity_name!='' ORDER BY activity_name ASC");
				 while($row = mysqli_fetch_array($sql)){
					 $sel = "";
					 if(($_GET['activity_name']) == $row['activity_name']){ $sel = " Selected "; }

					 if(!empty($row['activity_name']))
					 echo "<option value='".$row['activity_name']."' ".$sel.">".$row['activity_name']."</option>";
				 }
				 echo "</select>"; */

				echo "<select class='selectpicker' data-style='btn-warning' name='activity_type' id='activity_name' style='margin-right:10px;margin-top:10px;width: 140px;display:none'>";
				echo "<option value=''>Activity type</option>";
				$sql = mysqli_query($connect,"SELECT * FROM temp_activity_type  WHERE activity_type!=''  ORDER BY activity_type ASC");
				 while($row = mysqli_fetch_array($sql)){

					 $sel = "";
					 if(($_GET['activity_type']) == $row['activity_type']){ $sel = " Selected "; }

					 if(!empty($row['activity_type']))
					 echo "<option value='".$row['activity_type']."' ".$sel.">".$row['activity_type']."</option>";
				 }
				 echo "</select>";

			/*	echo "<select name='assessment_type' id='assessment_type' style='margin-right:10px;margin-top:10px;width: 140px;display:none'>";
				echo "<option value=''>Assessment type</option>";
				$sql = mysqli_query($connect,"SELECT * FROM temp_assessment_type  WHERE assessment_type!=''  GROUP BY assessment_type");
				 while($row = mysqli_fetch_array($sql)){

					 $sel = "";
					 if(($_GET['assessment_type']) == $row['assessment_type']){ $sel = " Selected "; }

					 if(!empty($row['assessment_type']))
					 echo "<option value='".$row['assessment_type']."' ".$sel.">".$row['assessment_type']."</option>";
				 }
				 echo "</select>"; */

				echo "<select class='selectpicker' data-style='btn-warning' name='activity_month' id='activity_month' style='margin-right:10px;margin-top:3px;width: 140px;'>";
				echo "<option value=''>Month</option>";
				foreach ($mdata as $key => $value) {
					$mmonth=$value['month'];
					$amonth=$value['academic_month'];
				     $mmval=$key+1;
					 $sel = "";
					 if(($_GET['activity_month']) == $amonth){ $sel = " Selected "; }
					 	
					 echo "<option value='".$value['academic_month']."' ".$sel.">Month ".$mmval." (".$mmonth.")</option>";
				 }
				 echo "</select>";

				echo "<select class='selectpicker' data-style='btn-warning' name='activity_week' id='activity_week' style='margin-right:10px;margin-top:10px;width: 140px;'>";
				echo "<option value=''>Week</option>";
				for($i=1;$i<5;$i++){
					 $sel = "";
					 if(($_GET['activity_week']) == $i){ $sel = " Selected "; }

					 if(!empty($i))
					 echo "<option value='".$i."' ".$sel.">Week ".$i."</option>";
				 }
				 echo "</select>";

				echo "<select class='selectpicker' data-style='btn-warning' name='activity_day' id='activity_day' style='margin-right:10px;margin-top:10px;width: 140px;'>";
				echo "<option value=''>Day</option>";
				for($i=1;$i<8;$i++){
					 $sel = "";
					 if(($_GET['activity_day']) == $i){ $sel = " Selected "; }

					 if(!empty($i))
					 echo "<option value='".$i."' ".$sel.">Day ".$i."</option>";
				 }
				 echo "</select>";


				echo "<select class='selectpicker' data-style='btn-warning' name='activity_period' id='activity_period' style='margin-right:10px;margin-top:10px;width: 140px;'>";
				echo "<option value=''>Period</option>";
				for($i=1;$i<6;$i++){
					 $sel = "";
					 if(($_GET['activity_period']) == $i){ $sel = " Selected "; }
					 echo "<option value='".$i."' ".$sel.">Period ".$i."</option>";
				 }
				 echo "</select>";


				// echo "<select class='selectpicker' data-style='btn-warning' name='activity_status' id='activity_status' style='margin-right:10px;margin-top:10px;width: 140px;'>";
				// echo "<option value=''>Status</option>";
				// if($_GET['activity_status']=='1'){ echo "<option value='1' selected>Completed</option>"; }
				// else{ echo "<option value='1' >Completed</option>"; }
				// if($_GET['activity_status']=='0'){  echo "<option value='0' selected >Pending</option>"; }else{  echo "<option value='0'>Pending</option>"; }
				// if($_GET['activity_status']=='2') { echo "<option value='2' selected>Skipped</option>"; }else{ echo "<option value='2'>Skipped</option>"; }
				// echo "</select>";



				 echo "<input type='hidden' name='page' id='' value='' />";
				 echo "<input type='text' name='search' id='search' class='all_activity_search' placeholder='search student'  value='".$_GET['search']."' />";
				 echo "<button class='btn btn-default btn-cust btn-sm' style='padding: 8px;'><i class='fa fa-search'></i></button>";
				 echo "</form>";
				// echo "<a href='' id='take_assessment_btn' style='margin-top:10px;text-decoration:underline 1important'>Click here to complete the assessment</a>";*/
			 ?>
			 <?php
			 $targetpage = "all-assessments.php?1";
			   $where =" 1 ";
			   
//if(isset($_GET['search'])){ if(!empty($_GET['search'])){ $where .=" AND students.first_name ='".$_GET['search']."'"; $targetpage .="&students.first_name=".$_GET['search']; }  }			   
			   if(isset($_GET['activity_name'])){ if(!empty($_GET['activity_name'])){ $where .=" AND activities.activity_name='".$_GET['activity_name']."'"; $targetpage .="&activity_name=".$_GET['activity_name']; }  }
			   if(isset($_GET['activity_type'])){ if(!empty($_GET['activity_type'])){ $where .=" AND activities.activity_type='".$_GET['activity_type']."'";$targetpage .="&activity_type=".$_GET['activity_type']; }  }
			   if(isset($_GET['assessment_type'])){ if(!empty($_GET['assessment_type'])){ $where .=" AND activities.assessment_type='".$_GET['assessment_type']."'";$targetpage .="&assessment_type=".$_GET['assessment_type']; }  }
			   if(isset($_GET['activity_code'])){ if(!empty($_GET['activity_code'])){ $where .=" AND activities.activity_code='".$_GET['activity_code']."'";$targetpage .="&activity_code=".$_GET['activity_code']; }  }
if(isset($_GET['class_name'])){ if(!empty($_GET['class_name'])){ $where .=" AND all_classes.class_name='".$_GET['class_name']."'";$targetpage .="&class_name=".$_GET['class_name']; }  } 


	else{
		
		if($role=="Teacher"){
			
			$sql_all_users = mysqli_query($connect,"SELECT * FROM  all_users WHERE user_id=".$id_user);

			while($row_all_users = mysqli_fetch_array($sql_all_users)){
				  $classess_assigned_arr = explode(",",$row_all_users['classes_assigned']);
			  }


		    $classess_assigned = implode("','",$classess_assigned_arr);
			
			

			
			
			$sql = mysqli_query($connect,"SELECT class_name FROM all_classes WHERE class_unique_id='".$classess_assigned."' ORDER BY class_name DESC");
			$crit_def_cls=mysqli_fetch_array($sql);		
			$where .=" AND all_classes.class_name='".$crit_def_cls['class_name']."'";
			$targetpage .="&class_name=".$crit_def_cls['class_name']; 
			
		
		}
		else{
			
				
			$sql = mysqli_query($connect,"SELECT class_name FROM all_classes WHERE class_name!='' ORDER BY class_name DESC");
			$crit_def_cls=mysqli_fetch_array($sql);		
			$where .=" AND all_classes.class_name='".$crit_def_cls['class_name']."'";
			$targetpage .="&class_name=".$crit_def_cls['class_name']; 
			

		}
		
		
	}



if(isset($_GET['activity_month'])){ 
	if(!empty($_GET['activity_month'])){ 
		$where .=" AND activities.activity_month='".$_GET['activity_month']."'";
		$targetpage .="&activity_month=".$_GET['activity_month']; 
	}
	else{
					 $months= date("n");
					   $region=$_SESSION['school_region'];
				       $sessionMonth=$_SESSION['starting_month'];
			          $sqddl = mysqli_query($conn,"SELECT academic_month FROM region WHERE calender_month='". $months."' AND region='".$region."'");
			          $rrees=mysqli_fetch_all($sqddl,MYSQLI_ASSOC);
			         // echo "<pre>";print_r($rrees);exit;
                      $month=$rrees[0]['academic_month'];
	   $where .=" AND  ( activities.activity_month='2' OR activities.activity_month='1' OR activities.activity_month='3' OR activities.activity_month='4'  OR activities.activity_month='5' OR activities.activity_month='6' OR activities.activity_month='7' OR activities.activity_month='8'  OR activities.activity_month='9' OR activities.activity_month='10'  )  ";
	   $targetpage .="&activity_month=".$month;

	}
}
			   if(isset($_GET['activity_week'])){ if(!empty($_GET['activity_week'])){ $where .=" AND activities.activity_week='".$_GET['activity_week']."'";$targetpage .="&activity_week=".$_GET['activity_week']; }  }
			   if(isset($_GET['activity_day'])){ if(!empty($_GET['activity_day'])){ $where .=" AND activities.activity_day='".$_GET['activity_day']."'";$targetpage .="&activity_day=".$_GET['activity_day']; } 
			   }
			
				if(isset($_GET['activity_status'])){ 
				//	if(!empty($_GET['activity_status'])){
					if($_GET['activity_status'] !==""){
						$where .=" AND all_assessments.status='".$_GET['activity_status']."'"; 
						$targetpage .="&activity_status=".$_GET['activity_status'];  
					}
					
				}			
	
	
			   if(isset($_GET['activity_period'])){ if(!empty($_GET['activity_period'])){ $where .=" AND activities.activity_period='".$_GET['activity_period']."'";$targetpage .="&activity_period=".$_GET['activity_period']; }  }

			   if(!isset($_GET['activity_month'])){
 
						$months= date("n");
					   $region=$_SESSION['school_region'];
				       $sessionMonth=$_SESSION['starting_month'];
			          $sqddl = mysqli_query($conn,"SELECT academic_month FROM region WHERE calender_month='". $months."' AND region='".$region."'");
			          $rrees=mysqli_fetch_all($sqddl,MYSQLI_ASSOC);
			         // echo "<pre>";print_r($rrees);exit;
                      $month=$rrees[0]['academic_month'];
					  
					   $where .=" AND activities.activity_month='".$month."'";$targetpage .="&activity_month=".$month;
					  
					   

				}

				if(isset($_GET['search'])){
					
					$search = $_GET['search'];
					$where .=" AND(";
					$where .="  activities.activity_name LIKE '%$search%'";
					$where .=" OR activities.activity_type LIKE '%$search%'";
					$where .=" OR activities.activity_code LIKE '%$search%'";
					$where .=" OR activities.activity_tags LIKE '%$search%'";
					$where .=" OR activities.assessment_type LIKE '%$search%'";
          $where .=" OR students.first_name LIKE '%$search%'"; 
					$where .=" OR all_assessments.status LIKE '%$search%')";
					 $targetpage .="' AND students.first_name LIKE '%$search%";
					 $targetpage .="' OR activities.activity_name LIKE '%$search%";
					 $targetpage .="' OR activities.activity_type LIKE '%$search%";
					 $targetpage .="' OR activities.activity_code LIKE '%$search%";
					 $targetpage .="' OR activities.activity_tags LIKE '%$search%";
					 $targetpage .="' OR activities.assessment_type LIKE '%$search%";
					 $targetpage .="' OR all_assessments.status LIKE '%$search%";
			   }
			   $targetpage_href=$targetpage;
				if(isset($_GET['sorting'])&&!empty($_GET['sorting'])){
					$sorting = " order by ".$_GET['field']." ".$_GET['sorting'];
					if($_GET['sorting']=="Asc") $sort="Desc";
					if($_GET['sorting']=="Desc") $sort="Asc";
					$targetpage .= "&sorting=".$_GET['sorting']."&field=".$_GET['field'];


				}else{
					$sort = "Asc";
				}
				//$sorting. = " , activities.activity_month,activities.activity_week,activities.activity_day,activities.activityperiod ASC";



					$sql = "SELECT *,all_assessments.status as stat,all_assessments.id as iid FROM all_assessments INNER JOIN students ON all_assessments.student_unique_id=students.student_unique_id INNER JOIN activities ON all_assessments.activity_code=activities.activity_code AND all_assessments.activity_month=activities.activity_month INNER JOIN all_classes ON students.student_class_name=all_classes.class_unique_id
					WHERE ".$where."  ORDER BY activities.activity_month ASC, activities.activity_week ASC, activities.activity_day ASC, activities.activity_period ASC ";
					if($sorting!=""){
						$sql = "SELECT *,all_assessments.status as stat,all_assessments.id as iid FROM all_assessments INNER JOIN students ON all_assessments.student_unique_id=students.student_unique_id INNER JOIN activities ON all_assessments.activity_code=activities.activity_code AND all_assessments.activity_month=activities.activity_month INNER JOIN all_classes ON students.student_class_name=all_classes.class_unique_id
						WHERE ".$where."  ".$sorting.", activities.activity_month ASC, activities.activity_week ASC, activities.activity_day ASC, activities.activity_period ASC ";
					}
					if($role=="Teacher"){
						 $sql_all_users = mysqli_query($connect,"SELECT * FROM  all_users WHERE user_id=".$id_user);
						  while($row_all_users = mysqli_fetch_array($sql_all_users)){
							  $classess_assigned_arr = explode(",",$row_all_users['classes_assigned']);
						  }


						$sql_students = mysqli_query($connect,"SELECT * FROM students ORDER BY first_name ASC");
						if($role=="Teacher"){
							$classess_assigned = implode("','",$classess_assigned_arr);
							$sql_students = mysqli_query($connect,"SELECT * FROM students WHERE student_class_name IN ('".$classess_assigned."') ORDER BY first_name ASC");

						}
 						$stat_cust ="";
						if(isset($_GET['activity_status'])){
							if($_GET['activity_status']=='0' || $_GET['activity_status']=='1' || $_GET['activity_status']=='2'){
							$stat_cust ="AND all_assessments.status='".$_GET['activity_status']."' ";
							}
//							else $stat_cust ="AND all_assessments.status='0'  AND student_class_name IN ('".$classess_assigned."') ";
						}
						
						$sql = "SELECT *,all_assessments.status as stat,all_assessments.id as iid FROM all_assessments INNER JOIN students ON all_assessments.student_unique_id=students.student_unique_id INNER JOIN activities ON all_assessments.activity_code=activities.activity_code AND all_assessments.activity_month=activities.activity_month INNER JOIN all_classes ON students.student_class_name=all_classes.class_unique_id
						WHERE ".$where." AND student_class_name IN ('".$classess_assigned."') ".$stat_cust."  ORDER BY activities.activity_month ASC, activities.activity_week ASC, activities.activity_day ASC, activities.activity_period ASC ";
						
						if($sorting!=""){
							$sql = "SELECT *,all_assessments.status as stat,all_assessments.id as iid FROM all_assessments INNER JOIN students ON all_assessments.student_unique_id=students.student_unique_id INNER JOIN activities ON all_assessments.activity_code=activities.activity_code AND all_assessments.activity_month=activities.activity_month INNER JOIN all_classes ON students.student_class_name=all_classes.class_unique_id
							WHERE ".$where." AND student_class_name IN ('".$classess_assigned."') ".$stat_cust."  ".$sorting.", activities.activity_month ASC, activities.activity_week ASC, activities.activity_day ASC, activities.activity_period ASC ";

						}
  //          echo $sql;
					}
						$tbl_name="activities";       //your table name
						$adjacents = 3;
						
  //         echo $sql;
						$query = $sql;
						$ss = mysqli_query($connect,$query);
						$ids_list = "";
						while($row = mysqli_fetch_array($ss)){
							$ids_list .=$row['iid'].",";
						}
						$total_pages = mysqli_num_rows($ss);

						
						
						
						  //your file name  (the name of this file)
						$limit = 10;                                //how many items to show per page
						$page = $_GET['page'];
						if($page)
							$start = ($page - 1) * $limit;          //first item to display on this page
						else
							$start = 0;                             //if no page var is given, set start to 0

						/* Get data. */
						$sql = $sql." LIMIT $start, $limit";
						$result = mysqli_query($connect,$sql);

						/* Setup page vars for display. */
						if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
						$prev = $page - 1;                          //previous page is page - 1
						$next = $page + 1;                          //next page is page + 1
						$lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
						$lpm1 = $lastpage - 1;                      //last page minus 1

						/*
							Now we apply our rules and draw the pagination object.
							We're actually saving the code to a variable in case we want to draw it more than once.
						*/
						$pagination = "";
						$targetpage = "all-assessments.php?".str_replace("page=","",$_SERVER['QUERY_STRING']);
						if($lastpage > 1)
						{
							$pagination .= "<div class=\"pagination dataTables_paginate paging_simple_numbers\" id=\"datatable_paginate\">";
							//previous button
							if ($page > 1)
								$pagination.= "<a href=\"$targetpage&page=$prev\" class=\"paginate_button previous\">Previous</a>";
							else
								$pagination.= "<span class=\"disabled paginate_button previous\">Previous</span>";

							//pages
							if ($lastpage < 7 + ($adjacents * 2))    //not enough pages to bother breaking it up
							{
								for ($counter = 1; $counter <= $lastpage; $counter++)
								{
									if ($counter == $page)
										$pagination.= "<span class=\"current paginate_button \">$counter</span>";
									else
										$pagination.= "<a href=\"$targetpage&page=$counter\" class=\"paginate_button \">$counter</a>";
								}
							}
							elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
							{
								//close to beginning; only hide later pages
								if($page < 1 + ($adjacents * 2))
								{
									for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
									{
										if ($counter == $page)
											$pagination.= "<span class=\"current paginate_button \">$counter</span>";
										else
											$pagination.= "<a href=\"$targetpage&page=$counter\" class=\"paginate_button \">$counter</a>";
									}
									$pagination.= "...";
									$pagination.= "<a href=\"$targetpage&page=$lpm1\" class=\"paginate_button \">$lpm1</a>";
									$pagination.= "<a href=\"$targetpage&page=$lastpage\" class=\"paginate_button \">$lastpage</a>";
								}
								//in middle; hide some front and some back
								elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
								{
									$pagination.= "<a href=\"$targetpage&page=1\" class=\"paginate_button \">1</a>";
									$pagination.= "<a href=\"$targetpage&page=2\" class=\"paginate_button \">2</a>";
									$pagination.= "...";
									for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
									{
										if ($counter == $page)
											$pagination.= "<span class=\"current paginate_button\">$counter</span>";
										else
											$pagination.= "<a href=\"$targetpage&page=$counter\" class=\"paginate_button \">$counter</a>";
									}
									$pagination.= "...";
									$pagination.= "<a href=\"$targetpage&page=$lpm1\" class=\"paginate_button \">$lpm1</a>";
									$pagination.= "<a href=\"$targetpage&page=$lastpage\" class=\"paginate_button \">$lastpage</a>";
								}
								//close to end; only hide early pages
								else
								{
									$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
									$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
									$pagination.= "...";
									for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
									{
										if ($counter == $page)
											$pagination.= "<span class=\"current paginate_button\">$counter</span>";
										else
											$pagination.= "<a href=\"$targetpage&page=$counter\" class=\"paginate_button \">$counter</a>";
									}
								}
							}

							//next button
							if ($page < $counter - 1)
								$pagination.= "<a href=\"$targetpage&page=$next\">Next</a>";
							else
								$pagination.= "<span class=\"disabled \">Next</span>";
							$pagination.= "</div>\n";
						}
					?>
			 </div>
         </div>
         </div>
      </div>
   </div>
   <div class="container" style="max-width:-webkit-fill-available;position: absolute;">
      <div class="row">

         <div class="card-box table-responsive dataTables_wrapper " style="margin-bottom:60px">
			<div class="alert alert-success" id="alert_success" style="display:none"> Assessment has been done successfully!</div>
             <script>
			 <?php if(empty($_SERVER["QUERY_STRING"])){ ?>
				$.ajax({
					  type: "POST",
					  url: "ajaxCalls.php",
					  data: {"action":"ratingSessionDestroy"} ,
					  success: function(data) {

					  }
					});
				<?php } ?>
			 </script>
		
		<div class="alert alert-success" id="alert_success" style="display:none"> Assessment has been completed successfully!</div>

            <table id="datatable2" class="table table-striped table-bordered table-responsive" style="width:100%;">
               <thead>
                  <tr>
                     <th style="display:none">id</th>
                     <!--<th style="padding-left:10px !important" >
						<input type="checkbox" id="all" class=" checkbox-primary"  name="chk[]" >
						<label for="all"></label>
					</th>-->
                     <th>Assessment</th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=students.first_name'; ?>" <?php if($_GET['field']=="students.first_name") echo "style='color:blue !important'"; ?>>Student Name</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_code'; ?>" <?php if($_GET['field']=="activities.activity_code") echo "style='color:blue !important'"; ?>>Activity Code</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_name'; ?>" <?php if($_GET['field']=="activities.activity_name") echo "style='color:blue !important'"; ?>>Activity Name</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_type'; ?>" <?php if($_GET['field']=="activities.activity_type") echo "style='color:blue !important'"; ?>>Activity Type</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.assessment_type'; ?>" <?php if($_GET['field']=="activities.assement_type") echo "style='color:blue !important'"; ?>>Assessment Type</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_month'; ?>" <?php if($_GET['field']=="activities.activity_month") echo "style='color:blue !important'"; ?>>Month</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_week'; ?>" <?php if($_GET['field']=="activities.activity_week") echo "style='color:blue !important'"; ?>>Week</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_day'; ?>" <?php if($_GET['field']=="activities.activity_day") echo "style='color:blue !important'"; ?>>Day</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=activities.activity_period'; ?>" <?php if($_GET['field']=="activities.activity_period") echo "style='color:blue !important'"; ?>>Period</a></th>
                     <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=all_assessments.status'; ?>" <?php if($_GET['field']=="all_assessments.status") echo "style='color:blue !important'"; ?>>Status</a></th>
					 <th><a class="cust_tbl_sort" href="<?php echo $targetpage_href.'&sorting='.$sort.'&field=students.first_name'; ?>" <?php if($_GET['search']=="students.first_name") echo "style='display:none;color:blue !important'"; ?>></a></th>
                  </tr>
               </thead>    
               <tbody>
                  <?php

                  /////bijay test for individual skip button///
                  	if(isset($_POST['submit_skip'])){

                  		// echo "<h1>jdsgjdf</h1>";
					  $id = $_POST['id'];   
						// $start_time = $_POST['start_time'];
						$end_time = time();
						$recorded_time =  gmdate("i:s",($end_time)-($start_time));
						// $rating = $_POST['rating'];
						$comment = $_POST['comments']; 
						mysqli_query($connect,"UPDATE edsmart_".$_SESSION['school_page_url'].".all_assessments SET rating='',comment='".$comment."',recording_time='".$recorded_time."',status='2' WHERE id=".$id);
					}
				$all_assessment_types_sql =  mysqli_query($connect,"SELECT *,count(assessment_type) as group_count FROM ".$_SESSION['master_db'].".`all_assessment_types` GROUP BY assessment_type");
					$arr = $arr_points =$arr_values = array();
					while($row_all_assessment_types = mysqli_fetch_array($all_assessment_types_sql)){
						$arr[$row_all_assessment_types['assessment_type']] = $row_all_assessment_types['group_count'] ;
						$all_assessment_types1 =  mysqli_query($connect,"SELECT * FROM ".$_SESSION['master_db'].".all_assessment_types WHERE assessment_type = '".$row_all_assessment_types['assessment_type']."'");
						$i=0;
						while($row_all_assessment_types1 = mysqli_fetch_array($all_assessment_types1)){
							$arr_points[$row_all_assessment_types1['assessment_type']][$i] = $row_all_assessment_types1['assessment_points'];
							$arr_values[$row_all_assessment_types1['assessment_type']][$i][$row_all_assessment_types1['assessment_points']] = $row_all_assessment_types1['assessment_value'];
							$i++;
						}
					}
					if($result->num_rows >0){
					while($row_ass = mysqli_fetch_array($result)){
                     	$id = $row_ass['iid'];
						//print_r($row_ass);exit;
                     	if($row_ass['stat']=='1'){ $status = "Completed"; $css_color = "green";}
                     	elseif($row_ass['stat']=='0') {$status = "Pending";$css_color = "red";}
                     	elseif($row_ass['stat']=='2') {$status = "Skipped";$css_color = "#f5c30e";}

                     	echo '<tr style="color:'.$css_color.'" id="tr_'.$id.'">';
						//echo '<td><input type="checkbox" id="'.$id.'"  class="checkbox_cust checkbox-primary"> <label for="'.$id.'"></label></td>';
                     	echo '<td style="display:none">'.$id.'</td>';
						echo '<td><select style="width:120px" onchange="ratingSession(\''.$id.'\',$(this).val())"><option value="">Select Rating</option>';

						$_SESSION["assement_id"][$id] = "";
						for($i=0;$i<$arr[$row_ass['assessment_type']];$i++){
							$sel = "";$sel = "";
							$point = $arr_points[$row_ass['assessment_type']][$i];
							if($point ==$row_ass['rating']){
								 $sel =" Selected ";
								 $_SESSION["assement_id"][$id] = $point;
							}else{
								$sel = "";
							}
							echo '<option value="'.$arr_points[$row_ass['assessment_type']][$i].'" '.$sel.'>'.$arr_values[$row_ass['assessment_type']][$i][$point].' ('.$point.')</option>';
						}
						echo '</select>  <!-- jothi code 13.11.2019 -->
<button class="btn btn-danger" style=" padding: 5px; margin:10px; width: 75px;" class="btn btn-info btn-lg" data-toggle="modal" name="skipped" data-target="#myModal'.$id.'"><i class="fas fa-share"></i> Skip</button>
				
  <div class="modal fade" id="myModal'.$id.'" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Additional Comments</h4> 
        </div>

         <form  method="post" style="display:inline-block; margin-bottom:0px" >
        		<div class="modal-body"> 
                <input type="hidden" name="skipped" class="form-control" value="skipped" >
				<input type="hidden" name="id" class="form-control" value='.$id.'>  
				<input type="text" name="comments" > 
         
        </div> 
		
        <div class="modal-footer">
         <input type="submit" name="submit_skip" class="btn btn-default">
       </div>
         </form> 
      </div>
    </div>
  </div>
</div>
</td>';

                     	echo '<td>'.$row_ass['first_name'].'</td>';
                     	echo '<td><a href="#" onclick="openAssessment('.$id.')">'.$row_ass['activity_code'].'</a></td>';
                     	echo '<td>'.$row_ass['activity_name'].'</td>';
                     	echo '<td>'.$row_ass['activity_type'].'</td>';
                     	echo '<td>'.$row_ass['assessment_type'].'</td>';
                     	echo '<td>'.$row_ass['activity_month'].'</td>';
                     	echo '<td>'.$row_ass['activity_week'].'</td>';
                     	echo '<td>'.$row_ass['activity_day'].'</td>';
                     	echo '<td>'.$row_ass['activity_period'].'</td>';
                     	echo '<td><span id="status_'.$id.'">'.$status.'</span></td>';
                     	echo '</tr>';

                     }
					  }
                 elseif(isset($_GET['activity_month'])){
                 	$month=$_GET['activity_month'];
                 	$region=$_SESSION['school_region'];
			          $sqddl = mysqli_query($conn,"SELECT calender_month FROM region WHERE academic_month='". $month."' AND region='".$region."'");
			          $rrees=mysqli_fetch_all($sqddl,MYSQLI_ASSOC);
			         //echo "<pre>";print_r($rrees);exit;
                      $month=$rrees[0]['calender_month'];
                      if($month==0){
                 	echo '<tr><td colspan=11><p style="color:red;">Holiday Month,   No assessments found!</p></td></tr>';
                 }
                 else{
                 	echo '<tr><td colspan=11><p style="color:red;">  No assessments found!</p></td></tr>';
                 }}
                     ?>
               </tbody>
            </table>

            <?php
               echo $pagination;
               ?>
         </div>
      </div>
   </div>
   <!-- content -->
</div>
<!-- End content-page -->
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- Demo Modal2 -->
<div id="custom-modal2" class="modal-demo">
   <button type="button" class="close" onclick="Custombox.close();" style="color:black">
   <span onclick="Custombox.close();">&times;</span><span class="sr-only" style="color:black" >Close</span>
   </button>
   <div class="custom-modal-text" style="text-align:center;">
      <img src="images/side1.jpg" />
   </div>
</div>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="modalOpen" style="display:none">Open Modal</button>
<!-- Modal -->
<div class="modal" id="myModal" role="dialog" style="width:100%">
   <div class="modal-dialog" >
      <!-- Modal content-->
      <div class="modal-content" >
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!--  <h4 class="modal-title">Modal Header</h4> -->
         </div>
         <div class="modal-body">
            <p>Some text in the modal.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">skip</button>
         </div>
      </div>
   </div>
</div>






<!-- Sweet Alert css -->
<link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert js -->
<script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<input type="text" id="id_activity" value="" style="display:none" />
   <script>
	jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 415) {
      $('#top_fix_wrap6').removeClass('top_fix_wrap6');
    } else if (ww >= 416) {
      $('#top_fix_wrap6').addClass('top_fix_wrap6');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  alterClass();
});
		</script>
<script>
   function openAssessment(id){
   	$.ajax({
   	  type: "POST",
   	  url: "ajaxCalls.php",
   	  data: {"action":"getAssessment","id":id} ,
   	  success: function(data) {
   		$("#myModal").html("");
   		$("#myModal").html(data);
   		$("#modalOpen").click();

   	  }
   	});

   }
   function activityOpen(id){
   	$.ajax({
   	  type: "POST",
   	  url: "ajaxCalls.php",
   	  data: {"action":"getActivity","id":id} ,
   	  success: function(data) {
   		$("#myModal").html("");
   		$("#myModal").html(data);
   		$("#modalOpen").click();

   	  }
   	});

   }
   function deletefn(id){
   	$("#id_activity").val(id);
   	swal({
   		title: "Are you sure?",
   		text: " ",
   		type: "error",
   		showCancelButton: true,
   		cancelButtonClass: 'btn-secondary waves-effect',
   		confirmButtonClass: 'btn-danger waves-effect waves-light'.id,
   		confirmButtonId: id,
   		confirmButtonText: 'Delete'
   	});
   }

   function activatefn(id){
   	$.ajax({
   		  type: "POST",
   		  url: "ajaxCalls.php",
   		  data: {"id":id,"action":"activateActivity"} ,
   		  success: function(data) {
   			$("#activitys_"+id).text("Active");
   		}
   	});
   }

   $(document).on('click','.btn-error',function () {
   	id=$("#id_activity").val();
   	
   	$.ajax({
   		  type: "POST",
   		  url: "ajaxCalls.php",
   		  data: {"id":$("#id_activity").val(),"action":"deactivateActivity"} ,
   		  success: function(data) {
   			$("#activitys_"+id).text("Deactive");
   		}
   	});
   });
   $(document).on('click','.btn-success',function () {
   	id=$("#id_activity").val();
   	
   	$.ajax({
   		  type: "POST",
   		  url: "ajaxCalls.php",
   		  data: {"id":$("#id_activity").val(),"action":"approveactivity"} ,
   		  success: function(data) {
   			$("#check_"+id).css("display","none");
   			$("#is_approev_"+id).text("Approved");
   			$("#status_"+id).text("Published");
   		}
   	});
   });


	$(document).ready(function(){
		$('.create_succcess' ).click(function () {
			swal("Status!", "Activities has been imported successfully", "success")
		});
		<?php  if(isset($_POST['done']) || isset($_POST['skipped'])){  ?>

		$('#alert_success').css('color','black');
		$('#alert_success').fadeIn(200).delay(4000).fadeOut(200);
		<?php  } ?>
		<?php  if(isset($_POST['create'])){ ?>

		swal("Status!", "Activity has been copied successfully", "success")
		<?php } ?>
		$(document).on("click", ".confirm",function(){
			window.location.href= "all-assessments.php";
		});

	   });
	   
	   
	   

	$('#user-rating-form').on('change','[name="rating"]',function(){
		$('#rating_val').val($('[name="rating"]:checked').val());
	});


	//$('#take_assessment_btn').hide();
	$('body').on('click', '#all', function (){
		$('.mark_options').css('display','block');
		$('.dt-buttons').css('padding-bottom','19px');
		$('input[type="checkbox"]').prop('checked', this.checked);
		sessionStorage.setItem("checked_all", "yes");
		$('#checked_all').val('checked');
		$('#take_assessment_btn').show();

	});
	$('body').on('click', '.checkbox_cust', function (){
		$('.mark_options').css('display','block');
		$('.dt-buttons').css('padding-bottom','19px');
		$('#all').prop('checked', false);
		sessionStorage.setItem("checked_all", "no");
		$('#take_assessment_btn').hide();
	});
	if(sessionStorage.getItem("checked_all")=="yes"){
		$('#all').click();
		$('#take_assessment_btn').show();
	}
	$('#take_assessment_btn').click(function(){
	var chkdBoxes="";
	$.ajax({
	  type: "POST",
	  url: "ajaxCalls.php",
	  data: {"action":"takeBulkAssessment","ids":"<?php echo $ids_list; ?>"} ,
	  success: function(data) {
		swal("Status!", "Assessment has been completed successfully", "success")

	  }
	});

	return false;
	//alert(chkdBoxes);
});
function ratingSession(id, point){
	$.ajax({
	  type: "POST",
	  url: "ajaxCalls.php",
	  data: {"action":"ratingSession","id":id,"point":point} ,
	  success: function(data) {
		$('#tr_'+id).css('color','green');
		$('#td_'+id).text('Completed');

	  }
	});
}
</script>
<?php   admin_footer();    ?>
