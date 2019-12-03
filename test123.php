<?php
	session_start();
	require_once("./include/membersite_config.php");
    include("./include/html_codes.php");
    include("./include/html_codes_weekly-time_table.php");
   
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
	   //echo "<pre>";print_r($_SESSION);exit;
		
		$sesMonth=$_SESSION['school_region'];
		$monQuery="SELECT * FROM region WHERE region='".$sesMonth."'";
		// echo $monQuery;exit;
        $resss=mysqli_query($conn,$monQuery);
        $mdata=mysqli_fetch_all($resss,MYSQLI_ASSOC);
    // echo "<pre>";print_r($mdata);exit;
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

?>

 <style>
   
   .table-responsive {
    display:inline-table;
        }
	
  @media only screen and (max-width: 600px){
	.table-responsive {
     display: block;
        }
	}
	.btn{
       background-image: linear-gradient(to bottom, #ffdf06, #ea8e15c9);
	   color: black;
   }
   .bootstrap-select .dropdown-toggle .filter-option-inner-inner{
     color:black !important;
     font-weight:500 !important:
   }
   .bootstrap-select>.dropdown-toggle.bs-placeholder{
	    color: #191616 !important;
   }
   .cust-form select {
    width: auto !IMPORTANT;
   }
   .cust-form{
	   background:#ffff;
   }
   font{
	   color:black;
	   font-size:14px;
	   font-weight:500;
	   padding-right: 10px 10px;
   }

   .row {
    /*display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;*/
    /* margin-right: -15px; */
    margin-left: 0px!important;
  </style>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.radixtouch.in/templates/admin/roxa/source/light/pages/tables/jquery-datatable.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 27 Jul 2019 09:47:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>e</title>
    <!-- Favicon-->
    <link rel="icon" href="reports/assets/images/favicon.ico" type="image/x-icon">

    <!-- Plugins Core Css -->
    <link href="reports/assets/css/app.min.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="reports/assets/css/style.css" rel="stylesheet">

    <!-- You can choose a theme from css/styles instead of get all themes -->
    <link href="reports/assets/css/styles/all-themes.css" rel="stylesheet" />
</head>

<body>
  

    <section class="content">
        <div class="container-fluid">
           <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                <strong>Materials</strong> Time Table</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:void(0);">Action</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Another action</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">Something else here</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                    <?php 
                    
                    $school_name_css = $class_name_css = $month_css = $week_css = "";
                    $assigned_curriculums_ids = array();
                        if($_GET['school_page_url']!=""){
                        $assigned_curriculums_ids = array();
                        $classess_assigned_arr = array();
                        if($_GET['class_name']){
                            $classess_assigned_arr = array($_GET['class_name']);
                        }
                        foreach($classess_assigned_arr as $classess_assigned){
                        //echo "SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'";
                            $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        }
                        $assigned_curriculums_ids1 = implode("','",$assigned_curriculums_ids);
               
                    }
                    if($role=="Super Admin"){
                        $_GET['school_page_url'] = $_GET['school_page_url'];
                        $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE 1");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        $classess_assigned_arr = array();
                        if($_GET['class_name']){
                            $classess_assigned_arr = array($_GET['class_name']);
                            $assigned_curriculums_ids = array();
                    
                        }
                        foreach($classess_assigned_arr as $classess_assigned){
                            $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        }
                        $assigned_curriculums_ids1 = implode("','",$assigned_curriculums_ids);
                    }
                    
                    if($role=="School Admin"){
                        $_GET['school_page_url'] = $_SESSION['school_page_url'];
                        $school_name_css = "display:none;";
                        $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE 1");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        $classess_assigned_arr = array();
                        if($_GET['class_name']){
                            $classess_assigned_arr = array($_GET['class_name']);
                            $assigned_curriculums_ids = array();
                    
                        }
                        foreach($classess_assigned_arr as $classess_assigned){

                            $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        }
                        $assigned_curriculums_ids1 = implode("','",$assigned_curriculums_ids);
                        
                        
                    }
                    if($role=="Teacher"){
                        $_GET['school_page_url'] = $_SESSION['school_page_url'];
                        $school_name_css = "display:none;";
                        
                        $sql_all_users = mysqli_query($connect,"SELECT * FROM  edsmart_".$_GET['school_page_url'].".all_users WHERE user_id=".$id_user);
                        while($row_all_users = mysqli_fetch_array($sql_all_users)){
                            $classess_assigned_arr = explode(",",$row_all_users['classes_assigned']);
                        }
                        
                        if(isset($_GET['class_name'])){
                            $classess_assigned_arr = array();
                            $classess_assigned_arr = array($_GET['class_name']);
                            $assigned_curriculums_ids = array();
                    
                        }
                        //print_r($classess_assigned_arr);
                        foreach($classess_assigned_arr as $classess_assigned){

                            $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        }
                        $assigned_curriculums_ids1 = implode("','",$assigned_curriculums_ids);
                        
                        
                    }
                    if($role=="Student"){
                        $_GET['school_page_url'] = $_SESSION['school_page_url'];
                        $school_name_css = "display:none;";
                        $class_name_css = "display:none;";
                        
                        $sql_all_users = mysqli_query($connect,"SELECT * FROM  students WHERE student_unique_id='".$_SESSION['student_unique_id']."'");
                        while($row_all_users = mysqli_fetch_array($sql_all_users)){
                            $classess_assigned_arr = explode(",",$row_all_users['student_class_name']);
                        }
                        $classess_assigned_arr = array();
                        if($_GET['class_name']){
                            $classess_assigned_arr = array($_GET['class_name']);
                        }
                        foreach($classess_assigned_arr as $classess_assigned){

                            $sql_assigned_curriculums_list = mysqli_query($connect,"SELECT * FROM edsmart_".$_GET['school_page_url'].".assigned_curriculums_list WHERE assigned_class_name='".$classess_assigned."'");
                            while($row_assigned_curriculums_list = mysqli_fetch_array($sql_assigned_curriculums_list)){
                                array_push($assigned_curriculums_ids,$row_assigned_curriculums_list['curriculum_id']);
                            }
                        }
                        $assigned_curriculums_ids1 = implode("','",$assigned_curriculums_ids);
               
                        
                    }
                    
                    if(!isset($_GET['month']) || empty($_GET['month'])){
                         $months= date("n");
                       $region=$_SESSION['school_region'];
                       $sessionMonth=$_SESSION['starting_month'];
                      $sqddl = mysqli_query($conn,"SELECT academic_month FROM region WHERE calender_month='". $months."' AND region='".$region."'");
                      $rrees=mysqli_fetch_all($sqddl,MYSQLI_ASSOC);
                     // echo "<pre>";print_r($rrees);exit;
                      $month=$rrees[0]['academic_month'];
                        
                        $_GET['month'] = $month;
                    }
                    if(!isset($_GET['week']) || empty($_GET['week'])){
                        $_GET['week'] = $currentWeek = ceil((date("d") - date("w") - 1) / 7) + 1;
                    }else{
                        $currentWeek = $_GET['week'];
                    }
                    
                    echo "<form method='get' class='cust-form'>
                    <font>Filter By: </font>
                    <select class='custom_selectpick btn btn-warning' data-style='btn-warning' name='school_page_url' id='school_page_url' style='margin-right:10px;margin-top:10px;".$school_name_css."'  required onchange='classDropdown()'>
                    <option value=''>School Name</option>
                    ";
                    
                    $sql_students = mysqli_query($connect, "SELECT * FROM ".$_SESSION['master_db'].".schools_registred WHERE role='School Admin' ORDER BY school_name ASC");
                    while($row_students = mysqli_fetch_array($sql_students)){
                        $sel ="";
                        if($row_students['school_page_url'] == $_GET['school_page_url']) $sel =" selected ";
                        echo "<option ".$sel." value='".$row_students['school_page_url']."' >".$row_students['school_name']."</option>";
                    }
                    echo "
                    </select>
                    <select class='custom_selectpick btn btn-warning' data-style='btn-warning' name='class_name' id='class_name' style='margin-right:10px;margin-top:10px;'".$class_name_css."'  required>
                    <option value=''>Class Name</option>
                    </select>
                    <select class='custom_selectpick btn btn-warning' data-style='btn-warning' name='month' id='month' style='margin-right:10px;margin-top:10px;' required>
                    <option value=''>Month</option>
                    ";
                    for($i=1;$i<13;$i++){
                        $sel = "";
                        if(($_GET['month']) == $i){ $sel = " selected "; }
                         
                        if(!empty($i))
                        echo "<option value='".$i."' ".$sel.">Month ".$i."</option>";
                     }
                    
                    echo"
                    </select>
                    <select class='custom_selectpick btn btn-warning' data-style='btn-warning' name='week' id='week' style='margin-right:10px;margin-top:10px;' required>
                    <option value=''>Week</option>
                    ";
                    for($i=1;$i<6;$i++){
                         $sel = "";
                         if(($_GET['week']) == $i){ $sel = " selected "; }
                         
                         if(!empty($i))
                         echo "<option value='".$i."' ".$sel.">Week ".$i."</option>";
                    }
                    
                echo "
                    </select>
                    <button class='btn btn-default btn-cust btn-sm' style='padding: 9px;margin-top:10px'><i class='fa fa-search'></i></button>

                      <button class='btn btn-default btn-cust btn-sm' style='padding: 9px;margin-top:10px'>Export PDF<i class='fa fa-download'></i></button>
                    </form>";
                 ?>
                    <?php 
                    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                    if(!isset($_GET['previous'])){
                        //echo '  <a class="btn btn-primary" href="'.$actual_link.'?previous" style="float:right;margin-right:5px">Previous week</a>';
                    }else{
                        //echo '  <a class="btn btn-primary" href="'.$actual_link.'" style="float:right;margin-right:5px">This week</a>';
                    }
                    $month = $_GET['month'];
                    $currentWeek = $_GET['week'];
                    ?>
                        
                
                <?php
                
                
               $where1 = " WHERE status='Active' AND activity_month='".$month."' AND activity_week='".$currentWeek."'";
               if(isset($_GET['previous'])){
                   $currentWeek = ceil((date("d") - date("w") - 1) / 7) - 1;
                   $where1 = " WHERE status='Active' AND activity_month='".$month."' AND activity_week='".$currentWeek."'";
               }
                $where2 = " AND status='Active' AND curriculum_id IN ('".$assigned_curriculums_ids1."')";
                        $tbl_name= "edsmart_".$_GET['school_page_url'].".activities";       //your table name
                        $adjacents = 3;

                        $query = "SELECT * FROM $tbl_name ".$where1;
                        $ss = mysqli_query($connect,$query);
                        //echo $query;
                ?>
                    
                    </div>
                        <div class="body">
                            <div class="table-responsive">
                                 <table  class="display table table-hover table-checkable order-column m-t-20 width-per-100 js-exportable">
                                 <thead>
                                  <tr>
                                    <th> Days</th>
                                    <th>Period 1</th>
                                    <th>Period 2</th>
                                    <th>Period 3</th>
                                    <th>Period 4</th>
                                    <th>Period 5</th>
                                    <th>Period 6</th>
                                  </tr>
                                </thead>
                                   <tbody>
                                   <?php
                                for ($x = 1; $x <= 5; $x++) {
                                echo '
                                <tr><td>';
                                if($x == 1){
                                    echo 'Monday';
                                }
                                elseif($x == 2){
                                    echo 'Tuesday';
                                }
                                elseif($x == 3){
                                    echo 'Wednesday';
                                }
                                elseif($x == 4){
                                    echo 'Thursday';
                                }
                                elseif($x == 5){
                                    echo 'Friday';
                                }
                                echo '</td><td>';
                                ?>
                                <?php
                                // echo $x;
                            // echo "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='1' ".$where2." LIMIT 1";
                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='1' ".$where2." LIMIT 1");
                                //print_r ($query):
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                // echo "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%";

                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];

                                    
                                }
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>
                                </td>
                                <td>
                                <?php
                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='2' ".$where2." LIMIT 1");
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];
                                } 
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>
                                </td>
                                <!-- <td>Tummy Time</td> -->
                                <td>
                                <?php
                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='3' ".$where2." LIMIT 1");
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];
                                }
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>
                                </td>
                                <td>
                                <?php
                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='4' ".$where2." LIMIT 1");
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];
                                }
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>  
                                </td>
                                <td>
                                <?php
                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='5' ".$where2." LIMIT 1");
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];
                                }
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>
                                
                                <td>
                                <?php

                                $query = mysqli_query($connect, "SELECT material_required FROM $tbl_name ".$where1." AND activity_day='".$x."' AND activity_period ='6' ".$where2." LIMIT 1");
                                while($row = mysqli_fetch_array($query)){
                                    $data= $row['material_required'];
                                    $query1 = mysqli_query($connect, "SELECT material_name  FROM `all_materials` WHERE `material_unique_id` LIKE '%$data%'");
                                        $row1 = mysqli_fetch_array($query1);
                                        echo $row1['material_name'];
                                }
                                //if(!mysqli_num_rows($query )) echo "Not Available";
                                ?>
                                <?php

                                echo '
                                </td></tr>';
                                }
                                ?>
                                </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
           
            <!-- #END# Add Rows -->
        </div>
    </section>




    <!-- Plugins Js -->

    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/table.min.js"></script>

    <!-- Custom Js -->
    <script src="reports/assets/js/admin.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="reports/assets/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="assets/js/demo.js"></script>
    <script type="text/javascript">
        classDropdown();
function classDropdown(){
    var jsonData1 = $.ajax({
      url: "ajaxCalls.php?action=getClassDropdown&report_school="+$('#school_page_url').val(),
      dataType:"json",
      async: false
      }).responseText;
      $('#class_name').html(jsonData1);
      $('option[value="<?php echo $_GET['class_name']; ?>"]').attr('selected','selected');
}
    </script>
</body>


<?php admin_footer(); ?>
</html>