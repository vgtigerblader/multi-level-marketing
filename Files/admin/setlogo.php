<?php
include ('include/header.php');
if($usid[2]!=100){
redirect('home.php');
}
?>

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">


<?php
include ('include/sidebar.php');
?>

 

		
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Set Logo
                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

					<hr>





    <?php
    
if($_POST)
{

// IMAGE UPLOAD //////////////////////////////////////////////////////////
    $folder = "../member/assets/img/";
    $extention = strrchr($_FILES['bgimg']['name'], ".");
    $new_name = "logo";
    $bgimg = $new_name.'.png';
    $uploaddir = $folder . $bgimg;
    move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////


}
?>

<div class="row">
<div class="col-md-6">

<form action="logo.php" method="post" enctype="multipart/form-data" >
                 
            <div class="form-group">
                <div class="col-sm-6"><label class="control-label">Logo</label></div>
              <div class="col-sm-6"><input name="bgimg" type="file" id="bgimg" /></div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-6"><label class="control-label">Icon</label></div>
              <div class="col-sm-6"><input name="icon" type="file" id="icon" /></div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-block">UPLOAD</button>
            </div>
                
          </form>

</div>

          
                <div class="col-md-6">  
        
Current Image : <br/><br/><br/><img src="../logo.png"  alt="IMG">
</div>

        <div class="col-md-6 col-md-offset-6">  
        
Current Icon : <br/><br/><br/><img src="../icon.png"  alt="IMG">
</div></div>


<?php
include ('include/footer.php');
?>


</body>
</html>