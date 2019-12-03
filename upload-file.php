  <?php
   require_once("./include/membersite_config.php");
   include("./include/html_codes.php");
   
	$fgmembersite = $GLOBALS['fgmembersite'];
	$id_user=$fgmembersite->idUser();
	$role = $_SESSION['user_role'];
	if (!$fgmembersite->CheckLogin() || $role!="Super Admin") {
		$fgmembersite->RedirectToURL("login.php");
	}
	
   defaultConfig();
   admin_way_top();
   admin_top_bar();
   admin_left_menu();
   $connect = $GLOBALS['connect'];
	
  
   if(isset($_POST['save_post_command'])){
   	$resource_type = mysqli_real_escape_string($connect,$_POST['resource_type']);
   	$available_to_school_urls = implode(",",$_POST['available_to_school_urls']);
   	$game_url =  mysqli_real_escape_string($connect,$_POST['game_url']); 
   	$title =  mysqli_real_escape_string($connect,$_POST['title']);
	$tags = $_POST['tags'];
   	$description =  mysqli_real_escape_string($connect,$_POST['description']);
	
	$file = "";
	
	if (!isset($_FILES['file']['tmp_name'])) {
		$file = "user-default-icon.jpg";
	}
	else{
		$file=$_FILES['file']['tmp_name'];
		if($file){
			$image= addslashes(file_get_contents($_FILES['file']['tmp_name']));
			$image_name= addslashes($_FILES['file']['name']);
			$extension = pathinfo($image_name, PATHINFO_EXTENSION);
			$profileImage = rand().time().".".$extension;
			$file = $profileImage;	
			move_uploaded_file($_FILES["file"]["tmp_name"],"./uploaded-files/" . $profileImage);
		}
	}
	
	$file1 = "";
	if (!isset($_FILES['file2']['tmp_name'])) {
		$file1 = "user-default-icon.jpg";
	}
	else{
		$file1=$_FILES['file2']['tmp_name'];
		if($file1){
			$image= addslashes(file_get_contents($_FILES['file2']['tmp_name']));
			$image_name= addslashes($_FILES['file2']['name']);
			$extension = pathinfo($image_name, PATHINFO_EXTENSION);
			$profileImage = rand().time().".".$extension;
			$file1 = $profileImage;	
			move_uploaded_file($_FILES["file2"]["tmp_name"],"./uploaded-files/" . $profileImage);
		}
	}
	
	$final =  "";
	$final1 =  "";
	if($resource_type=="Game"){
		$final = $game_url ;
	}else{
		$final = "uploaded-files/".$file ;
		$final1 = "uploaded-files/".$file1;
		
	}	
	$tagarray=explode(',',$tags);
  // jothi inserted this code for url check
  $check_url = "SELECT url FROM `list_of_uploads` WHERE url like '%".$game_url."%'";
  $check_urls = mysqli_query($connect,$check_url);

//$count_url = mysqli_fetch_array($check_urls);
//echo "<pre>";print_r($check_urls);exit;
  if (mysqli_num_rows($check_urls) > 0) {  
 $url_error = "Sorry... Url already taken"; 

}
else {   
  foreach($tagarray as $key=>$value){
  //echo "INSERT INTO `list_of_uploads` (resource_type,available_to_school_urls,url,userid,title,description,thumbn,tags) VALUES ('".$resource_type."','".$available_to_school_urls."','".$final."','1','".$title."','".$description."','".$final1."','".$value."')";exit;
    $inserting = mysqli_query($connect,"INSERT INTO `list_of_uploads` (resource_type,available_to_school_urls,url,userid,title,description,thumbn,tags) VALUES ('".$resource_type."','".$available_to_school_urls."','".$final."','1','".$title."','".$description."','".$final1."','".$value."')");

} 


 }



   }
   
   ?>
   <style>
    #upld_txtbx_ac{
		display:none;
	}
	.img_gallery span{
		width: 240px;
        margin-left:2%;
	}
	 @media only screen and (max-width: 600px){
	.upldfl-d6-d2{
		top:30px;
	}	
  }
   </style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
   <!-- Start content -->
   <div class="content">
      <div class="container">
         <form method="post" action="" enctype="multipart/form-data" >
            <div class="row">
                <div id="top_fix_wrap" class="top_fix_wrap">
	            <div class="top_fix">
                  <div class="page-title-box">
				  
				    <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="col-md-8 col-sm-8 col-xs-8">
                          <h4 class="custom_page_title">Upload Resource</h4>
						</div>
					 
					 <div class="col-md-4 col-sm-4 col-xs-4 upldfl-d6-d2">
					 <div class="page_action_wrap">
                     <button type="submit" class="btn btn-primary btn-file save_post_command" name="save_post_command" >Create</button>
                     </div> </div>
				    </div>
					 
					 
                  </div>
                  </div>
                  </div>
               
            </div>
            <!-- end row -->
            <div class="col-lg-12 save_index">
               <div class="card-box clearfix">
			  
                  <div class="row">
                    <input type="hidden" id="save_post_command" name="save_post_command" />
					
						<div class="col-xs-6 form-group " >
							<div class="col-lg-12 col-xs-12">
								<label>Title*</label>
								<input type='text' name='title' id='' class="form-control" required >
							</div>
						</div>
                    <div class="col-xs-6 form-group">
						<div class="col-lg-12 col-xs-12">
								<label>Resource Type</label>
								<select class="form-control" name="resource_type" id="resource_type" required>
								<option value=''>Select a type</option>
								<option value='Game'>Game</option>
								<option value='Video'>Video</option>
								<option value='Other'>Other</option>
								</select>
							</div>
						</div>
						<div class="col-xs-6 form-group">
							<div class="col-lg-12 col-xs-12">
								<label>Available To</label>
								<select class="form-control sumoselect" name="available_to_school_urls[]" id="available_to_school_urls" multiple required>
									<?php 
										$sql_schools_registred = mysqli_query($connect,"SELECT * FROM ".$_SESSION['master_db'].".schools_registred WHERE role='School Admin'");
										while($row_schools_registred = mysqli_fetch_array($sql_schools_registred)){
											echo "<option value='".$row_schools_registred['school_page_url']."'>".$row_schools_registred['school_name']."</option>";
										}
										
									?>
								</select>
							</div>
							
						</div>
						<div class="col-xs-6 form-group " >
							<div class="col-lg-12 col-xs-12">
								<label>Tags</label>
								<input type='text' name='tags' id='tags' class="form-control" required >
							</div>
						</div>
            <?php if (isset($url_error)){ ?>
                   <div class="alert alert-warning alert-dismissible" >
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>Warning!</strong> <?php echo $url_error;?>
                    </div>
                  <?php } ?> 
						<div class="col-xs-6 form-group game_cust" >
							<div class="col-lg-12 col-xs-12">
								<label>Game URL</label>                  
								<input type='text' name='game_url' id='' class="form-control" required >
                  
							</div>
						</div>
						<div class="col-xs-6 form-group file_cust">
							<div class="col-lg-12 col-xs-12">
								<label>File Upload</label>
								<input type='file' name='file' name="image[]" id='file0' class="form-control" accept=" application/pdf, image/*, video/*" >
								<label>It supports only image, video and pdf files</label>
							</div>
						</div>
						
						<div class="col-xs-6 form-group file_cust">
							<div class="col-lg-12 col-xs-12">
								<label>Thumbnail Upload</label>
								<input type='file' name='file2' name="image[]" id='file2' class="form-control" accept=" application/pdf, image/*, video/*" >
								<label>It supports only image, video and pdf files</label>
							</div>
						</div>
						<!-- span area  -->

						  <div class="col-md-12 col-lg-12 col-xs-12" style="margin-left:10%; margin-right:10%">
						     <div class="col-md-3" style="display:contents">
						       <span class="img_gallery row"></span>
							 </div>
						  </div>
						
						<!-- end of span area -->
						
					  <div class="col-md-12 col-lg-12 col-xs-12 cust_padding">
                        <label for="description">Description</label><br />
                        <textarea name="description" id="description " type="text" class="form-control tinymce" ></textarea><br />
                        <span id="description_error" style="display:none;" class="error"></span>
                     </div>
					 
               
               <br>
               <div class="card-box clearfix" style="text-align:right;display:none">
                  <br><br>
                  <button type="submit" class="btn btn-primary btn-file save_post_command" name="save_post_command"  >Create</button>
                  <br><br>
               </div>
            </div>
         </form>
      </div>
      <button type="button" class="btn btn-custom waves-effect waves-light btn-sm create_place_succcess"  style="display:none;">Click me</button>
   </div>
   <!-- container -->
</div>
<!-- content -->
</div>
<script>
	jQuery(document).ready(function($) {
  var alterClass = function() {
    var ww = document.body.clientWidth;
    if (ww < 415) {
      $('#top_fix_wrap').removeClass('top_fix_wrap');
    } else if (ww >= 416) {
      $('#top_fix_wrap').addClass('top_fix_wrap');
    };
  };
  $(window).resize(function(){
    alterClass();
  });
  alterClass();
});
		</script> 
		
<script>
//---------------------script for  upload option--------------------------------------
  // $("#file0").change(function(event) {
   	// $("#loading_imag").show();
   	// $("#uploadIcon").css("display","none");
   	// var fd = new FormData(); 
   	// fd.append('action', 'multipleImageUpload');
   	// jQuery.each(jQuery('#file0')[0].files, function(i, file) {
   		// fd.append('image[]', file);
   	// });	
   	// var k = 100;
   	// $.ajax({
   		// url: "ajaxCalls.php", // Url to which the request is send
   		// type: "POST",             // Type of request to be send, called as method
   		// data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
   		// contentType: false,       // The content type used when sending data to the server.
   		// cache: false,             // To unable request pages to be cached
   		// processData:false,        // To send DOMDocument or non processed data file it is set to false
   		// success: function(data)   // A function to be called if request succeeds
   		// {
   			// $('.img_gallery').append(data);
   		// }
   	// });
   // });
   
  
   //function for delete icon
    function deleteFiles(id,img){
   	$('#'+id).hide();
   	$.ajax({
   		url: "ajaxCalls.php", // Url to which the request is send
   		type: "POST",             // Type of request to be send, called as method
   		data: {"imageName":img,"action":"deleteSessionImages"}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
   		success: function(data)   // A function to be called if request succeeds
   		{
   			
   		}
   	});
   	
   }
   // ----------------------------------end of ajax script-----------------------------
   </script>


<!-- End content-page -->
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
<!-- Editor -->
<!-- Sweet Alert css -->
<link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert js -->
<script src="assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script src="assets/pages/jquery.sweet-alert.init.js"></script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>


$('.save_post_command').on('click',function(e){
    var jsonData = $.ajax({
	  type: "POST",
      url: "ajaxCalls.php",
   	  data: {"action":"activityCodeUnique","activity_id":$('#activity_code').val()} ,
      dataType:"json",
      async: false
      }).responseText;
	  if(jsonData<1){
		  return true;
	  }else{
		  e.preventDefault();
		  $('.activityCodeUnique_danger').fadeIn(200).delay(8000).fadeOut(200);
		  $('html,body').animate({
			scrollTop: $('.activities_code_zone').offset().top},
			'slow');
		  return false;
	  }
   	
});


   function deleteFiles(id,img){
   	$('#'+id).hide();
   	$.ajax({
   		url: "ajaxCalls.php", // Url to which the request is send
   		type: "POST",             // Type of request to be send, called as method
   		data: {"imageName":img,"action":"deleteSessionImages"}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
   		success: function(data)   // A function to be called if request succeeds
   		{
   			
   		}
   	});
   	
   }
   $("#file0").change(function(event) {
	   
   	$("#loading_imag").show();
   	$("#uploadIcon").css("display","none");
   	var fd = new FormData(); 
   	fd.append('action', 'multipleImageUpload');
   	jQuery.each(jQuery('#file0')[0].files, function(i, file0) {
   		fd.append('image[]', file0);
   	});	
   	var k = 100;
   	$.ajax({
   		url: "ajaxCalls.php", // Url to which the request is send
   		type: "POST",             // Type of request to be send, called as method
   		data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
   		contentType: false,       // The content type used when sending data to the server.
   		cache: false,             // To unable request pages to be cached
   		processData:false,        // To send DOMDocument or non processed data file it is set to false
   		success: function(data)   // A function to be called if request succeeds
   		{
   			$('.img_gallery').append(data);
			
   		}
   	});
   });
   
   $("#file2").change(function(event) {
	   
   	$("#loading_imag").show();
   	$("#uploadIcon").css("display","none");
   	var fd = new FormData(); 
   	fd.append('action', 'multipleImageUpload');
   	jQuery.each(jQuery('#file2')[0].files, function(i, file2) {
   		fd.append('image[]', file2);
   	});	
   	var k = 100;
   	$.ajax({
   		url: "ajaxCalls.php", // Url to which the request is send
   		type: "POST",             // Type of request to be send, called as method
   		data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
   		contentType: false,       // The content type used when sending data to the server.
   		cache: false,             // To unable request pages to be cached
   		processData:false,        // To send DOMDocument or non processed data file it is set to false
   		success: function(data)   // A function to be called if request succeeds
   		{
   			$('.img_gallery').append(data);
			
   		}
   	});
   });
   
   $('#start_date').change(function(){
   	$('#end_date').attr('min',$('#start_date').val());
   	
   });
   $('input[name="title"]').on('input', function() {
   	var urlstruct=$('input[name="title"]').val().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
   	$("#url_structure").val(urlstruct);
   });


   $(document).ready(function(){
	$('.file_cust,.game_cust').hide();
	$('#resource_type').change(function(){ 
		if($(this).val()=="Game"){
			$('#game_url').attr('required','required');
			$('input[type="file"]').removeAttr('required');
			$('.file_cust').hide();
			$('.game_cust').show();
			
		}else{
			$('input[type="file"]').attr('required','required');
			$('#game_url').removeAttr('required');
			$('.game_cust').hide();
			$('.file_cust').show();
			
		}
		if($(this).val()=="Video"){
			$('input[type="file"]').attr('accept','video/*|image/*');
			
		}if($(this).val()=="Other"){
			$('input[type="file"]').attr('accept','audio/*|image/*|media_type');
			
		}
	});   

	
   	// $('.create_place_succcess' ).click(function () {
   	// swal("Status!", "New resource has been uploaded successfully", "success")
   	// });
  //  	<?php  if(isset($_POST['save_post_command'])){ ?>
		// $('.create_place_succcess' ).click();
  //  	<?php } ?>

   	// $(document).on("click", ".confirm",function(){
   	// window.location.href = "list-of-uploads.php";
   	// });


   });
   var _URL = window.URL || window.webkitURL;
   function readURL(input) {
   
       if (input.files && input.files[0]) {
           var reader = new FileReader();
   
           reader.onload = function (e) {
               var file = input.files[0];
               var img = new Image();
               img.onload = function() {
                   if( img.width<750 || img.height<430){
                        $('#size_error').css('display','block');
                        $("input[name=image]").val('');
                   }
                   else
                   {
                       $('#size_error').css('display','none'); 
                       $('#uploaded_image').attr('src', e.target.result);
                       $('#uploaded_image').css('display', 'block');
                   }
               }
               img.src = _URL.createObjectURL(file);
              
           }
   
           reader.readAsDataURL(input.files[0]);
       }
   }
   
   $("input[name=image]").change(function(){
       readURL(this);
   });
</script>

<?php

 if($inserting) {
  // echo '<script>  swal("Status!", "New resource has been uploaded successfully", "success"); 
  // </script>';
        echo '<script>alert ("New resource has been uploaded successfully"); 
        window.location.href = "list-of-uploads.php";
        </script>';}
 admin_footer(); ?>	