<?php

function defaultConfig(){
	session_start();
	require_once("./include/membersite_config.php");
	$_SESSION['fgmembersite'] = $fgmembersite = $GLOBALS['fgmembersite'];
	$host = $_SESSION["host"] = "localhost";
	$uname = $_SESSION["uname"] ="root";
	$pwd = $_SESSION["pwd"] = "vishnu312$";  // Removed password vishnu312$
	$_SESSION['site_url'] ="https://www.edsmartedu.com/hsm/";
	if(isset($_SESSION['school_page_url'])&&empty($_SESSION['school_page_url'])){

		$GLOBALS['connect'] = $_SESSION['connect'] = $connect = $fgmembersite->confiureDB($host,$uname,$pwd,$_SESSION['master_db']);

	}elseif(!isset($_SESSION['school_page_url']) || $_SESSION['user_role']=='Super Admin'){

		$GLOBALS['connect'] =  $_SESSION['connect'] = $connect = $fgmembersite->confiureDB($host,$uname,$pwd,$_SESSION['master_db']);

	}else{

		$GLOBALS['connect'] =  $_SESSION['connect'] = $connect = $fgmembersite->confiureDB($host,$uname,$pwd,'edsmart_'.$_SESSION['school_page_url']);
	}

}


function admin_way_top(){

	$connect = $GLOBALS['connect'];
	$fgmembersite = $GLOBALS['fgmembersite'];
	$site_name = $_SESSION['school_name'];
	$favicon = $GLOBALS['favicon'];
	error_reporting(0);
	if(!$fgmembersite->CheckLogin())
	{
		$fgmembersite->RedirectToURL("login.php");
		exit;
	}
	echo '<!DOCTYPE html>
		<html><head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

		<!--Start of Tawk.to Script-->
		<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src="https://embed.tawk.to/594a564ae9c6d324a4736932/default";
		s1.charset="UTF-8";
		s1.setAttribute("crossorigin","*");
		s0.parentNode.insertBefore(s1,s0);
		})();
		</script>
		<!--End of Tawk.to Script-->
		
		<!-- App Favicon -->
		<link rel="shortcut icon" href="../'.$favicon.'">

		<!-- App Title -->
        <title>'.$site_name.' | Admin Portal</title>
        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
          <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="css/custom.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/jquery.lineProgressbar.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="assets/css/breaking-news-ticker.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
		<link href="assets/css/perfect-scrollbar.css" rel="stylesheet">
    
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

		<!-- DataTables -->
		<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
		<style>
		.fa-eye,.fa-trash,.fa-ban{
			cursor: pointer;
		}.cc-btn {
			padding:0px !important;
		}
        </style>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
		<script src="assets/js/jquery.lineProgressbar.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
		<script src="assets/js/breaking-news-ticker.min.js"></script>
		<script src="assets/js/perfect-scrollbar.js"></script>';
?>		
		
		
		
<?php		
		
		
		echo'
		
		
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
		<script>
		window.addEventListener("load", function(){
		window.cookieconsent.initialise({
		  "palette": {
			"popup": {
			  "background": "#237afc"
			},
			"button": {
			  "background": "#fff",
			  "text": "#237afc"
			}
		  },
		  "showLink": false,
		  "theme": "classic"
		})});
		</script>
				
		<style>
		   #sidebar-menu ul li a.active {
				color: #000000 !important;
				font-weight: 500;
			   background-image: linear-gradient(315deg, #ffb233 0%, #eaff2a, #ffdd00 74%);
			}
		</style>
		
		
		
		
		
    </head>
';
}
function admin_top_bar(){
	include('mysqli_connect.php');
	$logo_small = $GLOBALS['logo_small'];
	$fgmembersite = $GLOBALS['fgmembersite'];
	$current_url = $_SERVER['REQUEST_URI'];
	$id_user=$fgmembersite->idUser();
	$profile_pic = "";


	if(empty($profile_pic)){
		$profile_pic = "user-default-icon.jpg";
	}
	$id_user=$fgmembersite->idUser();
	$role = $_SESSION['user_role'];
	$logo = $_SESSION['school_logo'];
	echo '
	<body class="fixed-left">

	<!-- Begin page -->
	<div id="wrapper">
	<div class="topbar">


		

	<nav class="navbar navbar-custom">
			<ul class="nav navbar-nav">
			<li class="nav-item">
				<img src="assets/images/logo.jpg" class="dashboard_new_logo">
			</li>
			<li class="nav-item custom_right">
				<button class="button-menu-mobile open-left waves-light waves-effect" onclick=>
					<i class="zmdi zmdi-menu"></i>
				</button>
			</li>

		</ul>
<!-- LOGO -->
		<div class="topbar-left logo_sec">
			<a href="dashboard.php" class="logo img-responsive" id="crit_logo_red">';
			if($role=="Super Admin"){
				echo ' <img src="./images/user_images/'.$logo.'" class="dashboard_logo">';
			}else{
				echo ' <img src="./images/user_images/'.$logo.'"  class="dashboard_logo">';
			}

			echo '</a>
		</div>
		

	</nav>

</div>';
}
function admin_left_menu(){
	$current_url = $_SERVER['REQUEST_URI'];
	$queryString = $_SERVER['QUERY_STRING'];
	$fgmembersite = $GLOBALS['fgmembersite'];
	$id_user=$fgmembersite->idUser();
	$role = $_SESSION['user_role'];

	echo '<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">

		<!--- Sidemenu -->
		<div id="sidebar-menu">
			<ul>
				';
	if($role=="Super Admin"){
		
		echo '<li class="nav-item nav-profile" style="background: #fff;margin-bottom: 7px;">
            <div class="nav-link">
              <div class="profile-image">';
            //  echo "<pre>";print_r($_SESSION);exit;
			  if(empty($_SESSION["profile_pic"])){
					//echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
					echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
				}else{
					echo '<img src="./images/user_images/'.$_SESSION["profile_pic"].'" alt="image">';
					//echo 'none';
				}
			   
              echo '</div>
             <div class="profile-name">
                <h3 class="name">
                  '.$_SESSION['person_name'].'
                </h3>
                <h4 class="designation">
                  '.$_SESSION['user_role'].'
                </h4>
              </div>
			  <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false" style="position: absolute;right: 5px;">';
				   if(!empty($_SESSION['profile_pic'])){
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }else{
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }
					$pName = $_SESSION['person_name'];

					echo '
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview" style="width:unset">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5 class="text-overflow"><small>Welcome ! '.$pName.'</small> </h5>
					</div>


					<!-- item
					<a href="edit-profile.php?id='.base64_encode($id_user).'" class="dropdown-item notify-item">
						<i class="zmdi zmdi-edit"></i> <span>My Profile</span>-->
					</a><!-- item-->
					<a href="logout.php" class="dropdown-item notify-item">
						<i class="zmdi zmdi-power"></i> <span>Logout</span>
					</a>

				</div>
            </div>
				
				
			
          </li>';
		echo '	 <li class="app-search">
                           <form role="search" class="">
                               <input type="hidden" placeholder="Search..." class="form-control">
                              <a style="display:none" class="menu_search_tag"><i class="fa fa-search"></i></a>
                           </form>
                       </li>';

	echo '<li class="has_sub">
					<a href="dashboard.php" class="waves-effect ';if((strpos($current_url, 'dashboard.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-curriculums.php" class="waves-effect ';if((strpos($current_url, 'all-curriculums.php') !== false) || (strpos($current_url, 'create-curriculum.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Curriculums </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-questions.php" class="waves-effect ';if((strpos($current_url, 'all-questions.php') !== false) || (strpos($current_url, 'all-questions.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-clipboard"></i><span> Progress Report </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-progrepo.php" class="waves-effect ';if((strpos($current_url, 'all-progrepo.php') !== false) || (strpos($current_url, 'all-progrepo.php') !== false) ){ echo 'active'; }echo '"><div><div class="col-md-2 col-sm-2 col-xs-2" style="padding:unset;"><i class="far fa-clipboard"></i></div><div class="col-md-10 col-sm-10 col-xs-10" style="overflow:hidden"> Progress Reports Assigned</div></div> </a>
				</li>';									
	echo '<li class="has_sub">
					<a href="all-activities.php" class="waves-effect ';if((strpos($current_url, 'activities') !== false) || (strpos($current_url, 'activity') !== false) ){ echo 'active'; }echo '"><i class="fas fa-clipboard-list"></i><span> Activities </span> </a>
				</li>';
     echo '<li class="has_sub">
					<a href="region_creation.php" class="waves-effect ';if((strpos($current_url, 'region_creation.php') !== false) || (strpos($current_url, 'region_creation.php') !== false) ){ echo 'active'; }echo '"><i class="fas fa-globe-americas"></i><span> Region Creation </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="curriculums-assigned-list.php" class="waves-effect ';if((strpos($current_url, 'curriculums-assigned-list.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-tasks"></i><span> Assigned Curriculums </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-users-admin.php" class="waves-effect ';if((strpos($current_url, 'all-users-admin') !== false) ){ echo 'active'; }echo '"><i class="fa fa-users"></i><span> Users </span> </a>
				</li>';
	echo '<li class="has_sub">
								<a href="all-schools.php" class="waves-effect ';if((strpos($current_url, 'all-schools.php') !== false) ){ echo 'active'; } echo '"><i class="fa fa-building"></i><span> Schools </span> </a></li>';	

	echo '<li class="has_sub">
					<a href="all-classes.php" class="waves-effect ';if((strpos($current_url, 'classes') !== false) ){ echo 'active'; }echo '"><i class="far fa-file-alt"></i><span> Classes </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-developmental-outcomes.php" class="waves-effect ';if((strpos($current_url, 'all-developmental-outcomes') !== false) ){ echo 'active'; }echo '"><i class="fas fa-search-plus"></i><span> Developmental Focus </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-materials.php" class="waves-effect ';if((strpos($current_url, 'materials') !== false) ){ echo 'active'; }echo '"><i class="fas fa-layer-group"></i><span> Materials </span> </a>
				</li>';
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'reports.php') !== false)||(strpos($current_url, 'reports.php') !== false) ){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
					echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report.php">Developmental Report</a></li> -->';
		  echo '
		  <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report-publish.php">Developmental Report Publish</a></li>';
		  echo '
		  <li ';if((strpos($current_url, 'overall-progress-report.php') !== false)){ echo 'class=active'; }echo '><a href="overall-progress-report.php">Overall Progress Report</a></li>';
		/*  echo '
		  <li ';if((strpos($current_url, 'curriculum-report.php') !== false)){ echo 'class=active'; }echo '><a href="curriculum-report.php"> Curriculum Report</a></li>'; */
		  echo '
		  <li ';if((strpos($current_url, 'trends-development-by-graph.php') !== false)){ echo 'class=active'; }echo '><a href="trends-development-by-graph.php"> Trends development by graph</a></li>';
		  echo '
		  <li ';if((strpos($current_url, 'weekly-time-table.php') !== false)){ echo 'class=active'; }echo '><a href="weekly-time-table.php"> Weekly Time Table</a></li>';
		  echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false)){ echo 'class=active'; }echo '><a href="developmental-report-publish.php"> Publish to Parent</a></li> -->';
		  echo '
		  <li ';if((strpos($current_url, 'Student_report_v3/report.php') !== false)){ echo 'class=active'; }echo '><a href="Student_report_v3/report.php" target="_blank"> Progress Report </a></li>';


						echo '
					</ul>
				</li>';
	echo '<li class="has_sub">
					<a href="all-user-query.php" class="waves-effect ';if((strpos($current_url, 'users-query') !== false) ){ echo 'active'; }echo '"><i class="fas fa-question-circle"></i><span> Queries </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="help.php" class="waves-effect ';if((strpos($current_url, 'help.php') !== false) ){ echo 'active'; }echo '"><i class="far fa-question-circle"></i><span> Help </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="list-of-uploads.php" class="waves-effect ';if((strpos($current_url, 'list-of-uploads.php') !== false) ){ echo 'active'; }echo '"><i class="fas fa-upload"></i><span> Exclusive File Upload </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="free-worksheet-upload.php" class="waves-effect ';if((strpos($current_url, 'free-worksheet-upload.php') !== false) ){ echo 'active'; }echo '"><i class="fas fa-upload"></i><span> Free Worksheet Upload </span> </a>
				</li>';
		echo '<li class="has_sub">
					<a href="menu_management.php" class="waves-effect ';if((strpos($current_url, 'menu_management.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-tasks"></i><span> Menu Management </span> </a>
				</li>';			
	echo '<li class="has_sub">
					<a href="general-notification.php" class="waves-effect ';if((strpos($current_url, 'general-notification.php') !== false) ){ echo 'active'; }echo '"><i class="far fa-bell"></i><span> General notification </span> </a>
				</li>';

	echo '<li class="has_sub">
					<a href="logs.php" class="waves-effect ';if((strpos($current_url, 'logs.php') !== false) ){ echo 'active'; }echo '"><i class="fas fa-history"></i><span> Activity Logs</span> </a>
				</li>';
	}
	
	// School Admin Left Menu
	if($role=="School Admin"){
		
	$page_url=$_SESSION['school_page_url'];
	
	$fgmembersite = new FGMembersite();
	$host = $_SESSION['host'];$uname = $_SESSION['uname']; $pwd = $_SESSION['pwd'];
	$connect1 = $fgmembersite->confiureDB($host,$uname,$pwd,'edsmart_menu');
	// echo "<pre>";print_r($_SESSION);exit;
	$scl_qry= "SELECT * FROM `school_menu` WHERE `school_name`='".$page_url."'";
	$result=mysqli_query($connect1,$scl_qry);
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$menu=explode(",",$data[0]['menu']);
	// echo "<pre>";print_r($menu);exit;
	//echo "<pre>";print_r($_SESSION);exit;
	
	
	if (in_array("scl_dashboard", $menu))
	{
echo '<li class="nav-item nav-profile" style="background: #fff;margin-bottom: 7px;">
            <div class="nav-link">
              <div class="profile-image">';
			   if(empty($_SESSION["profile_pic"])){
					//echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
					echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
				}else{
					echo '<img src="./images/user_images/'.$_SESSION["profile_pic"].'" alt="image">';
					
				}
             echo ' </div>
              <div class="profile-name">
                <h3 class="name">
                  '.$_SESSION['person_name'].'
                </h3>
                <h4 class="designation">
                  '.$_SESSION['user_role'].'
                </h4>
              </div>
			  <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false" style="position: absolute;right: 5px;">';
				   if(!empty($_SESSION['profile_pic'])){
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }else{
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }
					$pName = $_SESSION['person_name'];

					echo '
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview" style="width:unset">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5 class="text-overflow"><small>Welcome ! '.$pName.'</small> </h5>
					</div>


					<!-- item
					<a href="edit-profile.php?id='.base64_encode($id_user).'" class="dropdown-item notify-item">
						<i class="zmdi zmdi-edit"></i> <span>My Profile</span>-->
					</a><!-- item-->
					<a href="logout.php" class="dropdown-item notify-item">
						<i class="zmdi zmdi-power"></i> <span>Logout</span>
					</a>

				</div>
            </div>
				
				
			
          </li>';
		echo '	 <li class="app-search">
                           <form role="search" class="">
                               <input type="hidden" placeholder="Search..." class="form-control">
                              <a style="display:none" class="menu_search_tag"><i class="fa fa-search"></i></a>
                           </form>
                       </li>';
	echo '<li class="has_sub">
					<a href="dashboard.php" class="waves-effect ';if((strpos($current_url, 'dashboard.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
				</li>';
	}
	
	if (in_array("scl_assessment", $menu))
	{
	echo '<li class="has_sub">
				<a href="all-assessments.php" class="waves-effect ';if((strpos($current_url, 'all-assessments.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Assessment (CAP) </span> </a>
				</li>';
	}
	
	if (in_array("scl_progress", $menu))
	{
	echo '<li class="has_sub">
				<a href="assessment-list-school.php" class="waves-effect ';if((strpos($current_url, 'assessment-list-school.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Progress Report </span> </a>
				</li>';		
	}

	if (in_array("scl_curriculum", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-curriculums-school.php" class="waves-effect ';if((strpos($current_url, 'curriculum') !== false)&&(strpos($current_url, 'curriculums-assigned-list-school') == false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Curriculum </span> </a>
				</li>';
	}
	
	if (in_array("scl_activities", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-activities-school.php" class="waves-effect ';if((strpos($current_url, 'activities') !== false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Activities </span> </a>
				</li>';
	}
	
	if (in_array("scl_assigned_curri", $menu))
	{
	echo '<li class="has_sub">
					<a href="curriculums-assigned-list-school.php" class="waves-effect ';if((strpos($current_url, 'curriculums-assigned-list-school') !== false) ){ echo 'active'; }echo '"><i class="fa fa-tasks"></i><span> Assigned Curriculums </span> </a>
				</li>';
	}
	
	if (in_array("scl_assigned_progress", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-que-cls.php" class="waves-effect ';if((strpos($current_url, 'all-que-cls') !== false) ){ echo 'active'; }echo '"><i class="fa fa-tasks"></i><span> Assigned Progress Report </span> </a>
				</li>';
	}
	
	if (in_array("scl_teacher", $menu))
	{
	echo '<li class="has_sub" style="display:non">
					<a href="all-teachers.php" class="waves-effect ';if((strpos($current_url, 'teacher') !== false) ){ echo 'active'; }echo '"><i class="fa fa-user"></i><span> Teachers </span> </a>
				</li>';
	}
	
	if (in_array("scl_student", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-students.php" class="waves-effect ';if((strpos($current_url, 'student') !== false) ){ echo 'active'; }echo '"><i class="fa fa-graduation-cap"></i><span> Students </span> </a>
				</li>';
	}
	
	if (in_array("show_report_school", $menu))
	{
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'reports.php') !== false)||(strpos($current_url, 'reports.php') !== false) ){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
					echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report.php">Developmental Report</a></li> -->';
if (in_array("develop_rep_publish_scl", $menu))
{
		  echo '
		  <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report-publish.php">Developmental Report Publish</a></li>';
}
if (in_array("overall_prog_rep_scl", $menu))
{
		  echo '
		  <li ';if((strpos($current_url, 'overall-progress-report.php') !== false)){ echo 'class=active'; }echo '><a href="overall-progress-report.php">Overall Progress Report</a></li>';
}
/*if (in_array("curri_rep_scl", $menu))
{
		  echo '
		  <li ';if((strpos($current_url, 'curriculum-report.php') !== false)){ echo 'class=active'; }echo '><a href="curriculum-report.php"> Curriculum Report</a></li>'; 
}*/
if (in_array("assessment_comp_rep_scl", $menu))
{
		  echo '
		  <li ';if((strpos($current_url, 'assessment-completion-report.php') !== false)){ echo 'class=active'; }echo '><a href="assessment-completion-report.php">Assessment Completion Report</a></li>';
}
if (in_array("trends_develop_graph_scl", $menu))
{
		  echo '
		  <li ';if((strpos($current_url, 'trends-development-by-graph.php') !== false)){ echo 'class=active'; }echo '><a href="trends-development-by-graph.php"> Trends development by graph</a></li>';
}
if (in_array("weekly_time_table_scl", $menu))
{
		   echo '
		  <li ';if((strpos($current_url, 'weekly-time-table.php') !== false)){ echo 'class=active'; }echo '><a href="weekly-time-table.php"> Weekly Time Table</a></li>';
}
if (in_array("prog_rep_scl", $menu))
{
		   echo '
		  <li ';if((strpos($current_url, 'Student_report_v3/report.php') !== false)){ echo 'class=active'; }echo '><a href="Student_report_v3/report.php" target="_blank"> Progress Report </a></li>';	
}	  
		  echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false)){ echo 'class=active'; }echo '><a href="developmental-report-publish.php"> Publish to Parent</a></li> -->';
		  echo'</ul>';
	}
	
	if (in_array("scl_queries", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-user-query.php" class="waves-effect ';if((strpos($current_url, 'users-query') !== false) ){ echo 'active'; }echo '"><i class="fa fa-question"></i><span> Queries </span> </a>
				</li>';
	}
	
	if (in_array("scl_help", $menu))
	{
	echo '<li class="has_sub">
					<a href="help-view.php" class="waves-effect ';if((strpos($current_url, 'help-view.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-question"></i><span> Help </span> </a>
				</li>';
	}
	
	if (in_array("scl_resource", $menu))
	{
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'resources.php') !== false)){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Resources </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
if (in_array("games_scl", $menu))
	{
					echo '
		  <li ';if((strpos($current_url, 'tag-vew-allot.php?games') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?games">Games</a></li>';
}
if (in_array("videos_scl", $menu))
	{
		  echo '<li ';if((strpos($current_url, 'tag-vew-allot.php?video') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?videos">Videos</a></li>';
}
if (in_array("videos_scl_tags", $menu))
	{
		  echo '<li ';if((strpos($current_url, 'tag-vew-allot.php?video') !== false) ){ echo 'class=active'; }echo '><a href="tags-view-2.php?videos">Tag based Videos</a></li>';
}
if (in_array("others_scl", $menu))
	{
		  echo '<li ';if((strpos($current_url, 'tag-vew-allot.php?others') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?others">Others</a></li>

		  ';
}
						echo '
					</ul>
				</li>';
	}
	}
	
	// School Teacher Left Menu
	// <li class="app-search">
                           // <form role="search" class="">
                             //   <input type="text" placeholder="Search..." class="form-control">
                            //    <a class="menu_search_tag"><i class="fa fa-search"></i></a>
                           // </form>
                       // </li>
	
	if($role=="Teacher"){
		
		$page_url=$_SESSION['school_page_url'];
	
	$fgmembersite = new FGMembersite();
	$host = $_SESSION['host'];$uname = $_SESSION['uname']; $pwd = $_SESSION['pwd'];
	$connect1 = $fgmembersite->confiureDB($host,$uname,$pwd,'edsmart_menu');
//echo "<pre>";print_r($_SESSION);exit;
	$scl_qry= "SELECT * FROM `teacher_menu` WHERE `school_name`='".$page_url."'";
	$result=mysqli_query($connect1,$scl_qry);
	$data=mysqli_fetch_all($result,MYSQLI_ASSOC);
	$menu=explode(",",$data[0]['menu']);
	// echo "<pre>";print_r($_SESSION);exit;
	  //   echo "<pre>";print_r($_SESSION);exit;
	
	if (in_array("teacher_dashboard", $menu))
	{
		echo '<li class="nav-item nav-profile" style="background: #fff;margin-bottom: 7px;">
            <div class="nav-link">
              <div class="profile-image">';
			  
			    if(empty($_SESSION["profile_pic"])){
					//echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
					echo '<img src="./images/user_images/user-default-icon.jpg" alt="image">';
				}else{
					echo '<img src="./images/user_images/'.$_SESSION["profile_pic"].'" alt="image">';
					//echo 'none';
				}
              echo '</div>
              <div class="profile-name">
                <h3 class="name">
                  '.$_SESSION['person_name'].'
                </h3>
                <h4 class="designation">
                  '.$_SESSION['user_role'].'
                </h4>
              </div>
			  <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
				   aria-haspopup="false" aria-expanded="false" style="position: absolute;right: 5px;">';
				   if(!empty($_SESSION['profile_pic'])){
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }else{
					   echo '<img src="assets/images/down-chevron.png" alt="user" class="img-circle">';
				   }
					$pName = $_SESSION['person_name'];

					echo '
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview" style="width:unset">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5 class="text-overflow"><small>Welcome ! '.$pName.'</small> </h5>
					</div>


					<!-- item
					<a href="edit-profile.php?id='.base64_encode($id_user).'" class="dropdown-item notify-item">
						<i class="zmdi zmdi-edit"></i> <span>My Profile</span>-->
					</a><!-- item-->
					<a href="logout.php" class="dropdown-item notify-item">
						<i class="zmdi zmdi-power"></i> <span>Logout</span>
					</a>

				</div>
            </div>
				
				
			
          </li>';
		echo '	 <li class="app-search">
                           <form  role="search" class="">
                               <input type="hidden" type="text" placeholder="Search..." class="form-control">
                              <a style="display:none" class="menu_search_tag"><i class="fa fa-search"></i></a>
                           </form>
                       </li>';
	echo '<li class="has_sub">
				<a href="dashboard.php" class="waves-effect ';if((strpos($current_url, 'dashboard.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
				</li>';
	}
	
	if (in_array("teacher_activity", $menu))
	{
	echo '<li class="has_sub">
					<a href="teacher-activities.php?thismonth" class="waves-effect ';if((strpos($current_url, 'activities') !== false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Activities </span> </a>
				</li>';
	}
	
	if (in_array("teacher_progress", $menu))
	{
	echo '<li class="has_sub">
		<a href="assessment-list-teacher.php" class="waves-effect ';if((strpos($current_url, 'assessment-list-teacher.php') !== false) || (strpos($current_url, 'assessment-list-teacher.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Progress Report </span> </a>
	</li>';
	}
	
	if (in_array("teacher_assessment", $menu))
	{
	echo '<li class="has_sub">
				<a href="all-assessments.php" class="waves-effect ';if((strpos($current_url, 'all-assessments.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Assessment </span> </a>
				</li>';
	}
	
	if (in_array("teacher_student", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-students.php" class="waves-effect ';if((strpos($current_url, 'all-students.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-graduation-cap"></i><span> Students </span> </a>
				</li>';
	}
	
	if (in_array("show_report_teacher", $menu))
	{
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'reports.php') !== false)||(strpos($current_url, 'reports.php') !== false) ){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
					echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report.php">Developmental Report</a></li> -->';
if (in_array("develop_rep_publish", $menu))
	{
		  echo '
		  <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report-publish.php">Developmental Report Publish</a></li>';
		  
}
if (in_array("prog_rep", $menu))
	{
		  echo '
		  <li ';if((strpos($current_url, 'Student_report_v3/report.php') !== false)){ echo 'class=active'; }echo '><a href="Student_report_v3/report.php" target="_blank"> Progress Report </a></li>';	
}
if (in_array("overall_prog_rep", $menu))
	{		  
		  echo '
		  <li ';if((strpos($current_url, 'overall-progress-report.php') !== false)){ echo 'class=active'; }echo '><a href="overall-progress-report.php">Overall Progress Report</a></li>';
}
if (in_array("assessment_comp_rep", $menu))
	{
	  
		  echo '
		  <li ';if((strpos($current_url, 'assessment-completion-report.php') !== false)){ echo 'class=active'; }echo '><a href="assessment-completion-report.php">Assessment Completion Report</a></li>';
}
if (in_array("trends_develop_graph", $menu))
	{
		  echo '
		  <li ';if((strpos($current_url, 'trends-development-by-graph.php') !== false)){ echo 'class=active'; }echo '><a href="trends-development-by-graph.php"> Trends development by graph</a></li>';
}
if (in_array("weekly_time_table", $menu))
	{
		   echo '
		  <li ';if((strpos($current_url, 'weekly-time-table.php') !== false)){ echo 'class=active'; }echo '><a href="weekly-time-table.php"> Weekly Time Table</a></li>';
}
		  echo '
		  <!-- <li ';if((strpos($current_url, 'developmental-report-publish.php') !== false)){ echo 'class=active'; }echo '><a href="developmental-report-publish.php"> Publish to Parent</a></li> -->';
		  echo '</ul>';
	}
	
	if (in_array("teacher_queries", $menu))
	{
	echo '<li class="has_sub">
					<a href="all-user-query.php" class="waves-effect ';if((strpos($current_url, 'users-query') !== false) ){ echo 'class=active'; }echo '"><i class="fa fa-question"></i><span> Queries </span> </a>
				</li>';
	}
	
	if (in_array("teacher_help", $menu))
	{
	echo '<li class="has_sub">
					<a href="help-view.php" class="waves-effect ';if((strpos($current_url, 'help-view.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-question"></i><span> Help </span> </a>
				</li>';
	}
	
	if (in_array("teacher_resource", $menu))
	{

	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'resources.php') !== false)){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Resources </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
if (in_array("games_teacher", $menu))
	{
					echo '
		  <li ';if((strpos($current_url, 'tag-vew-allot.php?games') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?games">Games</a></li>';
}
if (in_array("videos_teacher", $menu))
	{
		 echo ' <li ';if((strpos($current_url, 'tag-vew-allot.php?video') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?videos">Videos</a></li>';
}
if (in_array("others_teacher", $menu))
	{
		  echo '<li ';if((strpos($current_url, 'tag-vew-allot.php?others') !== false) ){ echo 'class=active'; }echo '><a href="tag-vew-allot.php?others">Others</a></li>

		  ';
}
						echo '
					</ul>
				</li>';
	}
	
	}

	if($role=="Student"){
	echo '<li class="has_sub">
				<a href="dashboard.php" class="waves-effect ';if((strpos($current_url, 'dashboard.php') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span> </a>
				</li>';

	// echo '<li class="has_sub">
					// <a href="student-activities.php" class="waves-effect ';if((strpos($current_url, 'activities') !== false) ){ echo 'active'; }echo '"><i class="fa fa-book"></i><span> Activities </span> </a>
				// </li>';
	// echo '<li class="has_sub">
				// <a href="all-assessments-student.php" class="waves-effect ';if((strpos($current_url, 'assessments') !== false) ){ echo 'active'; }echo '"><i class="zmdi zmdi-view-dashboard"></i><span> Assessment </span> </a>
				// </li>';
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'reports.php') !== false)||(strpos($current_url, 'reports.php') !== false) ){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
					echo '
		  <li ';if((strpos($current_url, 'developmental-report-child.php') !== false) ){ echo 'class=active'; }echo '><a href="developmental-report-child.php">Developmental Report</a></li>
		  <li ';if((strpos($current_url, 'weekly-time-table.php') !== false) ){ echo 'class=active'; }echo '><a href="weekly-time-table.php">Weekly Time Table</a></li></ul>';
	echo '<li class="has_sub">
					<a href="help-view.php" class="waves-effect ';if((strpos($current_url, 'help-view.php') !== false) ){ echo 'active'; }echo '"><i class="fa fa-question"></i><span> Help </span> </a>
				</li>';
	echo '<li class="has_sub">
					<a href="all-user-query.php" class="waves-effect ';if((strpos($current_url, 'users-query') !== false) ){ echo 'active'; }echo '"><i class="fa fa-question"></i><span> Queries </span> </a>
				</li>';
	echo '<li class="has_sub">
				<a href="javascript:void(0);" class="waves-effect ';if((strpos($current_url, 'resources.php') !== false)){ echo 'active'; }echo ' "><i class="fa fa-clipboard"></i> <span> Resources </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">';
					echo '
		  <li ';if((strpos($current_url, 'all-resources.php?games') !== false) ){ echo 'class=active'; }echo '><a href="resources.php">Games</a></li>
		  <li ';if((strpos($current_url, 'all-resources.php?video') !== false) ){ echo 'class=active'; }echo '><a href="resources.php">Videos</a></li>
		  <li ';if((strpos($current_url, 'all-resources.php?others') !== false) ){ echo 'class=active'; }echo '><a href="resources.php">Others</a></li>

		  ';
						echo '
					</ul>
				</li>';
	}


	echo '</ul>
			<div class="clearfix"></div>
		</div>
		<!-- Sidebar -->
		<div class="clearfix"></div>

	</div>

</div>';

}
function admin_footer(){
	echo '<footer class="footer text-right">
                '.date('Y').' © Edsmart Edu Services Pvt Ltd.
		</footer>
		<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
		
		<script src="assets/js/jquery.selectric.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

		<!-- Required datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      
        <!-- Buttons examples -->
    
		<!-- Sweet Alert css -->
		<link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
		<!-- Sweet Alert js -->
		<script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
		<script src="assets/pages/jquery.sweet-alert.init.js"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>
		tinymce.init({ selector: \'.tinymce\',
		  height: 200,
		  theme: \'modern\',
		  plugins: [
			\'advlist autolink lists link image charmap print preview hr anchor pagebreak\',
			\'searchreplace wordcount visualblocks visualchars code fullscreen\',
			\'insertdatetime media nonbreaking save table contextmenu directionality\',
			\'emoticons template paste textcolor colorpicker textpattern imagetools codesample\'
		  ],
		  toolbar1: \'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image\',
		  toolbar2: \'print preview media | forecolor backcolor emoticons | codesample\',
		  image_advtab: true,
		  templates: [
			{ title: \'Test template 1\', content: \'Test 1\' },
			{ title: \'Test template 2\', content: \'Test 2\' }
		  ],
		  content_css: [
			\'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i\',
			\'//www.tinymce.com/css/codepen.min.css\'
		  ] });
		  function applyMCE() {
			   $("textarea").each(function(){
				   tinyMCE.EditorManager.execCommand(\'mceRemoveEditor\', true, $(this).attr(\'id\'));
				tinyMCE.EditorManager.execCommand(\'mceFocus\', false, $(this).attr(\'id\'));
				tinyMCE.EditorManager.execCommand(\'mceAddEditor\', true, $(this).attr(\'id\'));
			   });

		}
		</script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
		
                <script type="text/javascript">
		$(window).load(function(){
    $(document).ready(function() {
	$(\'#datatable\').DataTable( {
		"sScrollX": "100%",
        "sScrollY":  ( 0.35 * $(window).height() ),
        "scrollCollapse": true,
		"paging": true,
		"autoWidth": true,
		"order": [[ 0, "desc" ]],
		
    });
	$(\'#datatable\').DataTable().draw();
});
});
 </script>



		<style>
		.SumoSelect { width:100% !important; }
		</style>
		<!--Sumo select dropdown--->
		<script src="js/jquery.sumoselect.js"></script>
		<link href="https://hemantnegi.github.io/jquery.sumoselect/stylesheets/sumoselect.css" rel="stylesheet" />
		<script type="text/javascript">
		$(\'.sumoselect\').SumoSelect();
		</script>
		
		

    </body>

</html>';
}
function admin_footer1(){
	echo '<footer class="footer text-right">
                '.date('Y').' © Edsmart Edu Services Pvt Ltd.
		</footer>
		<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
		<script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

		<!-- Required datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        
      <script type="text/javascript">
		$(window).load(function(){
    $(document).ready(function() {
	$(\'#datatable\').DataTable( {
		"sScrollX": "100%",
        "sScrollY":  ( 0.5 * $(window).height() ),
        "scrollCollapse": true,
		"paging": true,
		"autoWidth": false,
		"order": [[ 0, "desc" ]],
		
    });
	$(\'#datatable\').DataTable().draw();
});
});
 </script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
	

        <!-- Page specific js -->
        <!-- <script src="assets/pages/jquery.dashboard.js"></script> -->

    </body>

</html>';
}



?>
