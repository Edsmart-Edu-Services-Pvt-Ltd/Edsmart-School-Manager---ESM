<?php
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
   
   if(isset($_POST['assign_to_cls'])){
   			 $resource_val = $_POST['assign_to_cls_val'];   
   	$available_to_classes_val = implode(",",$_POST['available_to_classes']);
   	
   	$query=mysqli_query($connect,"SELECT res_path FROM `available_to_cl` WHERE res_path='".$resource_val."'   "); 
   	echo $val;
   	echo("<script>console.log('PHP: ".$resource_val."');</script>");
   	// $rrees=mysqli_fetch_all($query,MYSQLI_ASSOC);
   	// echo "<Pre>";print_r($rrees);exit;
   	if(mysqli_num_rows($query)==NULL){
   		mysqli_query($connect,"INSERT INTO `available_to_cl` (res_path,avail_to_cla) VALUES ('".$resource_val."','".$available_to_classes_val."')");		
   	}
   	else{
   		mysqli_query($connect,"UPDATE `available_to_cl` SET avail_to_cla='".$available_to_classes_val."' WHERE res_path= '".$resource_val."' ");
   	}
   }	
   
   ?>
<style>
   .label-cust {
   background-color: #c5c5c500 !important;
   color: #675858 !important;
   box-shadow: 2px 2px 2px 2px gray !important;
   }
   .label-cust .btn{
   color: #fff;
   background-color: #0167a8;
   border-color: #014e7f;
   }
   .row{
   display: inherit;
   }
   .btn-group{
   padding-bottom: 10px;
   padding-top: 10px;
   background: white;
   margin-top: 10px;
   margin-bottom: 10px;
   }
   .btn-group button {
   background-color: #4CAF50; /* Green background */
   border: 1px solid green; /* Green border */
   color: white !important; /* White text */
   padding: 8px 12px; /* Some padding */
   cursor: pointer; /* Pointer/hand icon */
   float: left; /* Float the buttons side by side */
   font-size:17px
   }
   .btn-group button a{
   color: #ffffff;
   text-decoration: none;
   }
   /* Clear floats (clearfix hack) */
   .btn-group:after {
   content: "";
   clear: both;
   display: table;
   }
   .btn-group button:not(:last-child) {
   border-right: none; /* Prevent double borders */
   }
   /* Add a background color on hover */
   .btn-group button:hover {
   background-color: #3e8e41;
   }
   .footer {
   background: #2d2d2d;
   position: fixed;
   }
   .card-box{
   background-color: #c5c5c5 !important;;	
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
   .options{
   padding-bottom:0px !important;
   h6 p{
   height: 40px !important;
   overflow: hidden !important;
   }
   .SumoSelect.open > .optWrapper {
   top: -164px;
   display: block;
   }
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
<!-- Start content -->
<div class="content">
   <?php if($role== 'School Admin') {?>
   <div class="row-fluid">
      <div class="row-fluid">
         <div id="top_fix_wrap" class="top_fix_wrap">
            <div class="top_fix">
               <div class="page-title-box">
                  <button class="btn btn-custom waves-effect waves-light btn-sm create_succcess"  style="display:none;">Click me</button>
                  <h4 class="page-title">All 
                     <?php if(isset($_GET['games'])){
                        $val = "Game" ; echo "Games"; 
                        
                        $tag_count_qry = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                         //echo $tag_count_qry; exit;
                        $tag_count_qry_nnn = mysqli_query($connect,$tag_count_qry);
                            
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu);	
                        
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";  
                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){

                        			 echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";	
                                 				
                         } 
                         echo "</div>";
                        
                        
                        
                        }
                        elseif(isset($_GET['videos']))
                        
                        {
                        $val = "Video" ;  echo "Videos";
                        
                         $tag_count_qry = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                         //echo $tag_count_qry; exit;
                        $tag_count_qry_nnn = mysqli_query($connect,$tag_count_qry);
                        
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu);	
                        
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";
                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                        			 echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";					
                         }
                         echo "</div>";
                        		}
                        elseif(isset($_GET['others'])){
                        
                        $val = "Other" ; echo "Others"; 
                        
                        $tag_count_qry = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                         //echo $tag_count_qry; exit;
                        $tag_count_qry_nnn = mysqli_query($connect,$tag_count_qry);
                        
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu);	
                        
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";
                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                        			 echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";					
                         }
                         echo "</div>";
                        
                        
                        }
                        
                        
                        
                        else echo "Resources";
                        ?>
                  </h4>
                  <input type="hidden" name="id_Class" />
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php }   $tea_name = "SELECT * FROM all_users where user_id='".$id_user."'"; 
                         $result =  mysqli_query($connect, $tea_name); 
                         $teacher_name = mysqli_fetch_array($result); 
                       // echo '<pre>'; print_r($teacher_name); exit;
                       
                     if($role =='Teacher' && $teacher_name['user_id']== $id_user ) { 
                  
                        $teach_class = "SELECT * FROM edsmart_".$_SESSION['school_page_url'].".available_to_cl WHERE avail_to_cla like '%".$teacher_name['classes_assigned']."%' "; 
                                 //    echo '<pre>'; print_r($teacher_details); exit;
                  
                               $res_teac =  mysqli_query($connect, $teach_class); 
                                 //$teacher_class = mysqli_fetch_array($res_teac); 
                               //  echo '<pre>'; print_r($teacher_class); exit;
                               
                        
                            $qury_ann1 = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0    AND url='".$teacher_class['res_path']."' "; 
                  
                        $sql_ann1 = mysqli_query($connect,$qury_ann1);  //echo '<pre>'; print_r($sql_ann1) ; exit;
                        $list_uploads = mysqli_fetch_array($sql_ann1);
                        //echo '<pre>'; print_r($list_uploads) ; exit;
                          ?> 
   <div class="row-fluid">
      <div class="row-fluid">
         <div id="top_fix_wrap" class="top_fix_wrap">
            <div class="top_fix">
               <div class="page-title-box">
                  <button class="btn btn-custom waves-effect waves-light btn-sm create_succcess"  style="display:none;">Click me</button>
                  <h4 class="page-title">All 
                     <?php if(isset($_GET['games'])) {
                        $val = "Game" ; echo "Games"; 
                        //echo '<pre>'; print_r($res_teac) ; exit;
                          
                        
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";
                         while( $teacher_class = mysqli_fetch_array($res_teac)) {  
                            
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."' AND url='".$teacher_class['res_path']."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu); 

                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                         //echo '<pre>'; print_r($tag_query_menu) ; exit;

                                  echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";               
                         }
                         
                        
                        }
                        echo "</div>";
                        }
                        elseif(isset($_GET['videos']))
                        
                        {
                        $val = "Video" ;  echo "Videos";
                       
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";
                          while( $teacher_class = mysqli_fetch_array($res_teac)) {  
                            
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."' AND url='".$teacher_class['res_path']."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu); 

                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                                  echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";               
                         } } 
                         echo "</div>";
                              }
                        elseif(isset($_GET['others'])){
                        
                        $val = "Other" ; echo "Others"; 
                       
                         echo "<div class='btn-group col-lg-12 btn-xs' style='padding-bottom:10px; padding-top:20px;'>";
                          while( $teacher_class = mysqli_fetch_array($res_teac)) {  
                            
                        $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."' AND url='".$teacher_class['res_path']."'  group by tags desc";
                        $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu); 

                         while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                                  echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";               
                         } }
                         echo "</div>";
                        
                        
                        }
                        
                        
                        
                        else echo "Resources";
                        ?>
                        
                  </h4>
                  <input type="hidden" name="id_Class" />
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php } ?>
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <?php
                  if($role =='School Admin') {  // super admin pager start here
                  				// $tag_count_qry = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                  				// $tag_count_qry_nnn = mysqli_query($connect,$tag_count_qry);
                  	
                  				// $tag_count_qry_menu = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."'  group by tags desc";
                  				// $tag_count_qry_nnn_menu = mysqli_query($connect,$tag_count_qry_menu);	
                  				
                  				// echo "<div class='btn-group col-lg-12'>";
                  				// while($tag_query_menu = mysqli_fetch_array($tag_count_qry_nnn_menu)){
                  							// echo "<button class='page-title-box' style='border-radius: 18px;margin-left: 13px;'><a href='#".str_replace(' ','',$tag_query_menu['tags'])."'>".ucwords($tag_query_menu['tags'])."</a></button>";					
                  				// }
                  				// echo "</div>";
                  				
                  	while($tag_query = mysqli_fetch_array($tag_count_qry_nnn)){	
                  		
                  		  $qury_ann = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0  AND resource_type='".ucwords($val)."' AND tags='".$tag_query['tags']."' ";
                  		$sql_ann = mysqli_query($connect,$qury_ann);
                  		echo "'<div><h2 id='".str_replace(' ','',$tag_query['tags'])."'>".ucwords($tag_query['tags'])."</h2></div>'";
                  		echo "<div class='row col-lg-12' id='".str_replace(' ','',$tag_query['tags'])."'>";
                  		while($row_ann = mysqli_fetch_array($sql_ann)){// echo "<pre>";print_r($row_ann);exit;
                  			if($val=="Game") $btn = "<a class='btn btn-warning pull-right' href='".$row_ann['url']."' target='_blank'>Play</a>";
                  			if($val=="Video") 
                  					$btn = "<a class='btn btn-warning pull-right' href='".$row_ann['url']."' target='_blank'>View</a>"; 
                  			if($val=="Other") $btn = "<a class='btn btn-warning pull-right' href='".$row_ann['url']."'target='_blank'>View</a>";
                  			
                  			// echo "<div class='col-lg-4 col-md-4' /*style='height:390px;*/'>
                  			echo "<div class='col-lg-4 col-md-4'>
                  
                  			<div class='card-box label-cust'>
                  
                  			<h3>".$row_ann['title']."</h3>
                  		    <p>".substr($row_ann['description'],0,60)."</p>
                  			".$btn."</div>";
                  		
                  		// Form Starts here
                  		
                  		
                  		
                  		echo "
                  		<form  method='POST' enctype='multipart/form-data' id='form_Assign'> ";
                  			preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $btn, $result);
                  			if (!empty($result)) {
                  					$anchor = array();
                  					$result['href'][0];
                  					$anchor_pre=$result['href'][0];
                  					$anchor['href']=$anchor_pre; 
                  			}
                  echo " <!-- jothi added id ='assign_to' 26.11.2019-->
                  			<div class='col-md-12 col-xs-6 form-group'>
                  				<div class='col-lg-12 col-xs-12' style='width:300px'>
                  					<button type='submit' style='color:black; font-weight:500' class='btn btn-warning btn-file assign_to_cls' id='assign_to' name='assign_to_cls' >Assign To</button><p></p>
                  					<input type='hidden' name='assign_to_cls_val' id='assign_to_cls' value='".$anchor['href']."'>
                  					
                  					<select class='form-control  sumoselect assign_to_cls' name='available_to_classes[]' id='available_to_classes' multiple='multiple' >";
                  
                  					$sql_cls_alr_assign = mysqli_query($connect,"SELECT * FROM edsmart_".$_SESSION['school_page_url'].".available_to_cl   WHERE res_path= '".$anchor['href']."'    ");
                  					//echo '<pre>'; print_r($sql_cls_alr_assign); exit;
                  					$row_cls_assing = mysqli_fetch_array($sql_cls_alr_assign);
                  					//echo '<pre>'; print_r($row_cls_assing); exit;
                  					//$classess_assigned = explode(",",$row_cls_assing['avail_to_cla']);
                  					$classess_assigned =$row_cls_assing['avail_to_cla'];
                  									//	echo '<pre>'; print_r($classess_assigned); exit;
                  					echo "SELECT * FROM edsmart_".$_SESSION['school_page_url'].".all_classes";
                  					$sql_cls = mysqli_query($connect,"SELECT * FROM edsmart_".$_SESSION['school_page_url'].".all_classes"); 
                  // echo '<pre>'; print_r($sql_cls); exit;
                  					while($row_cls = mysqli_fetch_array($sql_cls)){
                  						//echo "<pre>";print_r($row_cls);exit;
                  						if(strpos($classess_assigned,$row_cls['class_unique_id']) !== false){
                  							$sel = " Selected ";
                  							echo ' <option value=' .$row_cls['class_unique_id']. " " .$sel. '>'.$row_cls['class_name'] .'</option> ';
                  						}
                  						else{
                  							
                  							echo ' <option value=' .$row_cls['class_unique_id']. '>'.$row_cls['class_name'].'</option> ';
                  							
                  							
                  							
                  						}
                  											
                  					} 
                  								
                  echo" 				</select> 							
                  				</div>
                  			</div>
                  		</div>
                  		</form>";
                  		
                  		
                  		
                  		
                  		
                  		
                  		
                  		
                  		// Form should end here
                  		}
                  		echo "</div><br>";
                  
                  		
                  	}
                  
                  }// Super admin page end here
                        $tea_name = "SELECT * FROM all_users where user_id='".$id_user."'"; 
                         $result =  mysqli_query($connect, $tea_name); 
                         $teacher_name = mysqli_fetch_array($result); 
                       // echo '<pre>'; print_r($teacher_name); exit;
                       
                  	if($role =='Teacher' && $teacher_name['user_id']== $id_user ) { 
                  
                  	 	$teach_class = "SELECT * FROM edsmart_".$_SESSION['school_page_url'].".available_to_cl WHERE avail_to_cla like '%".$teacher_name['classes_assigned']."%' "; 
                  		       	//	   echo '<pre>'; print_r($teacher_details); exit;
                  
                  		       $res_teac =  mysqli_query($connect, $teach_class); 
                         		  // $teacher_class = mysqli_fetch_array($res_teac); 
                         		  // echo '<pre>'; print_r($teacher_class); exit;
                  
                  
                  					
                  						
                  					while($tag_query1 = mysqli_fetch_array($res_teac)){	
                  		
                  		    $qury_ann1 = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0    AND url='".$tag_query1['res_path']."' "; 
                  
                  		$sql_ann1 = mysqli_query($connect,$qury_ann1);  //echo '<pre>'; print_r($sql_ann1) ; exit;
                  		$list_uploads = mysqli_fetch_array($sql_ann1);
                  //echo '<pre>'; print_r($list_uploads) ; exit;
                  		echo "'<div><h2 id='".str_replace(' ','',$list_uploads['tags'])."'>".ucwords($list_uploads['tags'])."</h2></div>'";
                  		echo "<div class='row col-lg-12' id='".str_replace(' ','',$list_uploads['tags'])."'>";
                  		$qury_ann2 = "SELECT * FROM ".$_SESSION['master_db'].".list_of_uploads WHERE  find_in_set('".$_SESSION['school_page_url']."',available_to_school_urls)!=0    AND url='".$tag_query1['res_path']."' "; 
                  
                  		$sql_ann2 = mysqli_query($connect,$qury_ann2); 
                  
                  		while($row_ann1 = mysqli_fetch_array($sql_ann2)){ // echo "<pre>";print_r($row_ann1['description']);exit;
                  			if($val=="Game") $btn = "<a class='btn btn-warning pull-right' href='".$row_ann1['url']."' target='_blank'>Play</a>";
                  			if($val=="Video") 
                  					$btn = "<a class='btn btn-warning pull-right' href='".$row_ann1['url']."' target='_blank'>View</a>"; 
                  			if($val=="Other") $btn = "<a class='btn btn-warning pull-right' href='".$row_ann1['url']."'target='_blank'>View</a>";
                  			
                  			// echo "<div class='col-lg-4 col-md-4' /*style='height:390px;*/'>
                  			echo "<div class='col-lg-4 col-md-4'>
                  
                  			<div class='card-box label-cust'>
                  
                  			<h3>".$row_ann1['title']."</h3>
                  		    <p>".substr($row_ann1['description'],0,60)."</p>
                  			".$btn."</div>";
                  
                  
                  }
                  
                  					echo "</div></div><br>";
                  
                  		
                  	}
                  	}
                  
                  
                  
                  				?>
            </div>
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
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<input type="text" id="id_Class" value="" style="display:none" />
<script>
   $("#widget-existing").attr("class","active");
   function deletefn(id){
   	$("#id_Class").val(id);
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
   function approve(id){
   	$("#id_Class").val(id);
   	swal({  
   		title: "Are you sure?",
   		text: " ",
   		type: "success",
   		showCancelButton: true,
   		cancelButtonClass: 'btn-secondary waves-effect',
   		confirmButtonClass: 'btn-success waves-effect waves-light'.id,
   		confirmButtonId: id,
   		confirmButtonText: 'Approve'
   	});
   }
   $(document).on('click','.btn-error',function () {
   	id=$("#id_Class").val();
   	console.log(id);
   	$.ajax({
   		  type: "POST",
   		  url: "ajaxCalls.php",
   		  data: {"id":$("#id_Class").val(),"action":"deleteClass"} ,
   		  success: function(data) {
   			$("#Classes_"+id).css("display","none");
   		}
   	});
   });
   
   $(document).ready(function(){
   $('.create_succcess' ).click(function () {
   	swal("Status!", "Status has been updated successfully", "success")
   });
   <?php  if(isset($_POST['create'])){ ?>
   
   $('.create_succcess').click();	
   <?php } ?>
   $(document).on("click", ".confirm",function(){
   	$(".btn-warning").click();
   });
   
   });
   
   
   // $(document).ready(function(){
   // 	$("#assign_to").click(function(){  
   // 		// e.preventDefault();
   // 	alert('Successfully inserted'  ); 
   // });	   
   //   $("select.assign_to_cls").change(function(){
   //         var opti = $(this).children("option:selected").text().length;
   // 		if( opti > 0) { 
   // 		$(".assign_to_cls").click(function(){  
   // 	alert('Successfully inserted'  ); 
   // });	   
   // 		}  
   //     });	
      
   // });
   
   
   //  $('#form_Assign').submit(function (e) {
       
   //      swal('Assigned successfully');
   //     e.preventDefault();
   
   // });
</script>
<?php
   admin_footer();
   ?>