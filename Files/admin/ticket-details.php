<?php
include ('include/header.php');
require_once("../member/anotifier.php");
?>


</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">


<?php
include ('include/sidebar.php');

$iidd = $_GET["id"];

$tdetails = mysql_fetch_array(mysql_query("SELECT tid, subject, tm, status, btext, usid FROM ticket_main WHERE id='".$iidd."'"));
$unm = mysql_fetch_array(mysql_query("SELECT username FROM users WHERE mid='".$tdetails[5]."'"));

$dtm = date("Y-m-d H:i:s", $tdetails[2]);

if($tdetails[3]==0){
    $sts = "<b style='color:green;'> OPEN </b>";
}elseif($tdetails[3]==1){
    $sts = "<b style='color:blue;'> ANSWERED </b>";
}elseif($tdetails[3]==2){
    $sts = "<b style='color:orange;'> USER REPLY </b>";
}elseif($tdetails[3]==9){
    $sts = "<b style='color:red;'> CLOSED </b>";
}

?>

 

		
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> 





#<?php echo $tdetails[0]; ?> - <?php echo $tdetails[1]; ?> 
<span class="pull-right"><?php echo $sts; ?></span>




                        <small></small>
                    </h3>
                    <!-- END PAGE TITLE-->

					<hr>

					
					
					
					
					
			<div class="row">
			<div class="col-md-12">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                
                        

		   
<?php



if($_POST)
{

$btext = mysql_real_escape_string($_POST["btext"]);


$err1=0;




if($btext==""){
$err1=1;
}




$error = $err1;


if ($error == 0){

$res = mysql_query("INSERT INTO ticket_reply SET tid='".$iidd."', btext='".$btext."', tm='".time()."', typ='2'");


if($res){

mysql_query("UPDATE ticket_main SET status='1' WHERE id='".$iidd."'");



///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$userContact = mysql_fetch_array(mysql_query("SELECT fname, lname, mobile, email FROM users WHERE mid='".$tdetails[5]."'"));

$txt = "This is a soft notification that you Got Reply to your Support Ticket.";
abiremail($userContact[3], "SUpport Ticket Reply", "$userContact[0] $userContact[1]", $txt);

//$sms ="Hi $firstname, Welcome to XpertCash. Your Verification Code is $mvcode";
//abirsms($mobile, $sms);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS




echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Reply Added !! 
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>    
Some Problem Occurs, Please Try Again. 
</div>";
}

} else {
	
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Reply Can Not be Empty!!!

</div>";
}		
	
}


}





?>										
				

<div class="row">
<div class="col-md-10">
<div class="alert alert-info">
<b><?php echo $unm[0]; ?>:</b>
<b class="pull-right"><?php echo $dtm; ?></b><br><br>
<?php echo nl2br($tdetails[4]); ?>
</div>
</div>
</div>


<?php 

$ddaa = mysql_query("SELECT btext, tm, typ FROM ticket_reply WHERE tid='".$iidd."' ORDER BY id ASC");
echo mysql_error();
while ($data = mysql_fetch_array($ddaa))
{

$dtm = date("Y-m-d H:i:s", $data[1]);

$txt = nl2br($data[0]);

if($data[2]==1){

echo "
<div class=\"row\">
<div class=\"col-md-10\">
<div class=\"alert alert-info\">
<b>$unm[0]:</b>
<b class=\"pull-right\"> $dtm </b><br><br> $txt
</div>
</div>
</div>
";
}else{
echo "
<div class=\"row\">
<div class=\"col-md-10 col-md-offset-2\">
<div class=\"alert alert-warning\">
<b>STAFF:</b>
<b class=\"pull-right\"> $dtm </b><br><br> $txt
</div>
</div>
</div>
";

}




}

 ?>








<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">				




<div class="form-group">
<div class="col-md-12">
<textarea class="form-control" rows="2" placeholder="Your Reply" name="btext"></textarea>
</div>
</div>


<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block">ADD RESPONSE</button>
</div>
</div>

</div>
</form>
</div>




                            </div>
                        </div>		
                        </div><!---ROW-->		
					
					
					
					
					
					
			
					
					
					
					
					
					
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            
			


<?php
 include ('include/footer.php');
 ?>


</body>
</html>