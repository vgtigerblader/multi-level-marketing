<?php 
$pgtitle = "Registration";
include('include-header-nuser.php');
?>

</head>
<body class="header-fixed">


<?php
include('include-navbar-nuser.php');
?>


<!--=== Breadcrumbs v4 ===-->
<div class="breadcrumbs-v4">
<div class="container">
<span class="page-name">&nbsp;</span>
<h1>Member <span class="shop-green">Registration</span></h1>
</div><!--/end container-->
</div>
<!--=== End Breadcrumbs v4 ===-->








<!--=== Registre ===-->
<div class="log-reg-v3 content-md margin-bottom-30">
<div class="container">
<div class="row">









				












		<div class="col-md-8 col-md-offset-2">
		<form id="sky-form4" class="log-reg-block sky-form" action="" method="post">
		<h2>Create New Account</h2>






<div class="row">
<div class="col-sm-12">






<?php


if($_POST)
{

$refname = mysql_real_escape_string($_POST["refname"]);
$position = mysql_real_escape_string($_POST["position"]);

$firstname = mysql_real_escape_string($_POST["firstname"]);
$lastname = mysql_real_escape_string($_POST["lastname"]);

$day = mysql_real_escape_string($_POST["day"]);
$month = mysql_real_escape_string($_POST["month"]);
$year = mysql_real_escape_string($_POST["year"]);
$dob = "$day-$month-$year";

$email = mysql_real_escape_string($_POST["email"]);
$mobile = mysql_real_escape_string($_POST["mobile"]);

$address = mysql_real_escape_string($_POST["address"]);
$city = mysql_real_escape_string($_POST["city"]);
$post = mysql_real_escape_string($_POST["post"]);
$country = mysql_real_escape_string($_POST["country"]);


//$country = ip_info("Visitor", "Country");


$username = mysql_real_escape_string($_POST["username"]);
$password = mysql_real_escape_string($_POST["password"]);
$password2 = mysql_real_escape_string($_POST["passwordConfirm"]);


$err1=0;
$err2=0;
$err3=0;
$err4=0;
$err5=0;
$err6=0;
$err7=0;
$err8=0;
$err9=0;
$err10=0;
$err11=0;
$err12=0;
$err13=0;
$err14=0;
$err15=0;
$err16=0;
$err17=0;
$err18=0;
$err19=0;
$err20=0;
$err21=0;



if(trim($firstname)==""){
$err1=1;
}

if(trim($lastname)==""){
$err2=1;
}

if(trim($day)=="")
      {
$err3=1;
}

if(trim($month)=="")
      {
$err3=1;
}

if(trim($year)=="")
      {
$err3=1;
}




$dobSec = strtotime($dob);
$nowAge = time()-$dobSec;
$agyr = floor($nowAge/(365*24*60*60));

if($agyr<18)
      {
//$err4=1;
}






if(trim($email)==""){
$err6=1;
}

$eee = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='".$email."'"));
if($eee[0]!=0){
$err7=1;
}

if(trim($mobile)==""){
$err8=1;
}

$mob = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE mobile='".$mobile."'"));
if($mob[0]!=0){
$err9=1;
}







if(trim($address)==""){
$err10=1;
}

if(trim($city)==""){
$err11=1;
}

if(trim($post)==""){
$err12=1;
}

if(trim($country)==""){
$err13=1;
}



if(trim($username)==""){
$err14=1;
}
$uuu = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE username='".$username."'"));
if($uuu[0]!=0){
$err15=1;
}



if($password!=$password2)
      {
$err16=1;
}

if(strlen($password)<="5"){
$err17=1;
}



////------------------>>>> JOINING ERROR


if(trim($refname)==""){
$err18=1;
}
$rrr = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE username='".$refname."'"));
if($rrr[0]!=1){
$err19=1;
}

if(trim($position)==""){
$err20=1;
}



$refid = mysql_fetch_array(mysql_query("SELECT mid FROM users WHERE username='".$refname."'"));
$willPosition = getLastChildOfLR($refname,$position);

$pos = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE posid='".$willPosition."' AND position='".$position."'"));
if($pos[0]!=0){
$err21=1;
}

////------------------>>>> JOINING ERROR




$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7+$err8+$err9+$err10+$err11+$err12+$err13+$err14+$err15+$err16+$err17+$err18+$err19+$err20+$err21;


if ($error == 0){

$passmd = md5($password);
//$passmd = $password;
$vercode = rand(100000,999999);


$res = mysql_query("INSERT INTO users SET refid='".$refid[0]."', posid='".$willPosition."', position='".$position."', username='".$username."', password='".$passmd."', joindate='".time()."', fname='".$firstname."', lname='".$lastname."', dob='".$dob."', address='".$address."', city='".$city."', postcode='".$post."', country='".$country."', mobile='".$mobile."', email='".$email."', status='1', paid_status='0', trxpin='0', verstat='0', vercode='".$vercode."'");

if($res){
  echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  

Registretion Completed Successfully!

</div>";


$getMid = mysql_fetch_array(mysql_query("SELECT mid FROM users WHERE username='".$username."'"));

mysql_query("INSERT INTO member_bv SET mid='".$getMid[0]."', lbv='0', rbv='0'");
mysql_query("INSERT INTO member_below SET mid='".$getMid[0]."', lpaid='0', rpaid='0', lfree='0', rfree='0'");


updateMemberBelow($getMid[0], 'FREE');

///////////////////------------------------------------->>>>>>>>>Send Email AND SMS

$txt = "Thank you for joining us.<br/><br/><br/>

<b>Your account credentials:</b><br/><br/>

Username: $username <br/>
Password: $password <br/>

<b style='color:red;'> Important: Please do not share your username and/or password with anyone!</b><br/><br/>


We are looking forward a long and mutually prosperous relationship.<br/>";

$namess = "$firstname $lastname";

abiremail($email, "Registration Completed Successfully", $namess, $txt);

$sms ="Hi $firstname, Thanks For Registration. Your Verification Code is $vercode";
abirsms($mobile, $sms);
///////////////////------------------------------------->>>>>>>>>Send Email AND SMS



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
First Name Can Not be Empty!!!
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Last Name Can Not be Empty!!!
</div>";
}   
  
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Please Provide a valid Date of Birth!!!
</div>";
}   

if ($err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
You are not 18 Years old! you have to be 18+ to join...
</div>";
}   

  




  
if ($err6 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Email Can Not be Empty!!!
</div>";
}   


  
if ($err7 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Email Already Exist in our database... Please Use another Email!!
</div>";
}   


  
if ($err8 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Mobile Can Not be Empty!!!
</div>";
}   


  
if ($err9 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Mobile Number Already Exist in our database... Please Use another Mobile Number!!
</div>";
}   
  


 
if ($err10 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Street Address Can Not be Empty!!!
</div>";
}   
   

  
if ($err11 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
City/State Can Not be Empty!!!
</div>";
}   
  
 

 
if ($err12 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Post Code Can Not be Empty!!!
</div>";
}   
  
if ($err13 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Country Can Not be Empty!!!
</div>";
}   






if ($err14 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Username Can Not be Empty!!!
</div>";
}   
 
if ($err15 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Username Already Exist in our database... Please Use another Username!!
</div>";
}   
  

 
if ($err16 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Password and Confirm Password not match!!!
</div>";
}   
   

  
if ($err17 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Password must be minimum 6 Char!!!
</div>";
}   
  
 

 
if ($err18 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Referrer ID Can not be Empty !!!
</div>";
}   
  
 
if ($err19 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Referrer ID not Found in Our Database!!!
</div>";
}   
  




 
if ($err20 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Please Select Poition!!!
</div>";
}   
  
 
if ($err21 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>  
Position already taken!!
</div>";
}   
  





}







}

?>






</div>
</div>









		<div class="login-input reg-input">


		<div class="row">
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="refname" placeholder="Referrer ID" id="refname" class="form-control">
		</label>
		</section>
		</div>
		<div class="col-sm-6">
		<select name="position" class="form-control" id="poss">
		<option value="0" selected disabled>Position</option>
		<option value="L">Left</option>
		<option value="R">Right</option>
		</select>
		</div>

		<div class="col-sm-12">
			<div id="resu"></div>
		</div>
		</div>





		<div class="row">
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="firstname" placeholder="First name" class="form-control">
		</label>
		</section>
		</div>
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="lastname" placeholder="Last name" class="form-control">
		</label>
		</section>
		</div>
		</div>



		<div class="row margin-bottom-10">
		<div class="col-xs-6">
		<label class="select">
		<select name="month" class="form-control">
		<option disabled="" selected="" value="0">Month</option>
		<option value="01">January</option>
		<option value="02">February</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">June</option>
		<option value="07">July</option>
		<option value="08">August</option>
		<option value="09">September</option>
		<option value="10">October</option>
		<option value="11">November</option>
		<option value="12">December</option>
		</select>
		</label>
		</div>

		<div class="col-xs-3">
		<section>

		<label class="select">
		<select name="day" class="form-control">
		<option disabled="" selected="" value="0">Day</option>

<option value="01">01</option>
<option value="02">02</option>
<option value="03">03</option>
<option value="04">04</option>
<option value="05">05</option>
<option value="06">06</option>
<option value="07">07</option>
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option> 


		</select>
		</label>

		</section>
		</div>
		<div class="col-xs-3">
		<section>


		<label class="select">
		<select name="year" class="form-control">
		<option disabled="" selected="" value="0">Year</option>

<option value="2016">2016</option>
<option value="2015">2015</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
<option value="1939">1939</option>
<option value="1938">1938</option>
<option value="1937">1937</option>
<option value="1936">1936</option>
<option value="1935">1935</option>
<option value="1934">1934</option>
<option value="1933">1933</option>
<option value="1932">1932</option>
<option value="1931">1931</option>
<option value="1930">1930</option>
<option value="1929">1929</option>
<option value="1928">1928</option>
<option value="1927">1927</option>
<option value="1926">1926</option>
<option value="1925">1925</option>
<option value="1924">1924</option>
<option value="1923">1923</option>
<option value="1922">1922</option>
<option value="1921">1921</option>
<option value="1920">1920</option>
<option value="1919">1919</option>
<option value="1918">1918</option>
<option value="1917">1917</option>
<option value="1916">1916</option>
<option value="1915">1915</option>
<option value="1914">1914</option>
<option value="1913">1913</option>
<option value="1912">1912</option>
<option value="1911">1911</option>
<option value="1910">1910</option>
<option value="1909">1909</option>
<option value="1908">1908</option>
<option value="1907">1907</option>
<option value="1906">1906</option>
<option value="1905">1905</option>
<option value="1904">1904</option>
<option value="1903">1903</option>
<option value="1902">1902</option>
<option value="1901">1901</option>
<option value="1900">1900</option>


		</select>
		</label>


		</section>
		</div>

		</div>


		<div class="row">
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="email" name="email" placeholder="Email address" id="email" class="form-control">
		</label>
		</section>
		<div id="emailerr"></div>
		</div>
		<div class="col-sm-6">
		<section>


<div class="row">

<div class="col-xs-12">

		<label class="input">
		<input type="text" name="mobile" placeholder="Mobile Number With Country Code" id="mobile" class="form-control">
		</label>

</div>

</div>
		
		</section>
		<div id="mobileerr"></div>
		</div>
		</div>



		<div class="row">
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="address" placeholder="Street Address" class="form-control">
		</label>
		</section>
		</div>
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="city" placeholder="City/State" class="form-control">
		</label>
		</section>
		</div>
		</div>



		<div class="row">
		<div class="col-sm-6">
		<section>
		<label class="input">
		<input type="text" name="post" placeholder="Postcode" class="form-control">
		</label>
		</section>
		</div>
		<div class="col-sm-6">
		<section>



		<label class="select">
		<select name="country" class="form-control">
		<option disabled="" selected="" value="0">Country</option>

    <option value="Afghanistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antartica">Antarctica</option>
    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
    <option value="Botswana">Botswana</option>
    <option value="Bouvet Island">Bouvet Island</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
    <option value="Brunei Darussalam">Brunei Darussalam</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Cocos Islands">Cocos (Keeling) Islands</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Congo">Congo, the Democratic Republic of the</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cota D'Ivoire">Cote d'Ivoire</option>
    <option value="Croatia">Croatia (Hrvatska)</option>
    <option value="Cuba">Cuba</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="East Timor">East Timor</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="France Metropolitan">France, Metropolitan</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Territories">French Southern Territories</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guinea-Bissau">Guinea-Bissau</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
    <option value="Holy See">Holy See (Vatican City State)</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran (Islamic Republic of)</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
    <option value="Korea">Korea, Republic of</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Lao">Lao People's Democratic Republic</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malawi">Malawi</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Micronesia">Micronesia, Federated States of</option>
    <option value="Moldova">Moldova, Republic of</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Namibia">Namibia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherlands">Netherlands</option>
    <option value="Netherlands Antilles">Netherlands Antilles</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau">Palau</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Philippines">Philippines</option>
    <option value="Pitcairn">Pitcairn</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russian Federation</option>
    <option value="Rwanda">Rwanda</option>
    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
    <option value="Saint LUCIA">Saint LUCIA</option>
    <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
    <option value="Samoa">Samoa</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia (Slovak Republic)</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
    <option value="Span">Spain</option>
    <option value="SriLanka">Sri Lanka</option>
    <option value="St. Helena">St. Helena</option>
    <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syrian Arab Republic</option>
    <option value="Taiwan">Taiwan, Province of China</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania, United Republic of</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks and Caicos">Turks and Caicos Islands</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Emirates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States">United States</option>
    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
    <option value="Uruguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Viet Nam</option>
    <option value="Virgin Islands (British)">Virgin Islands (British)</option>
    <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
    <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
    <option value="Western Sahara">Western Sahara</option>
    <option value="Yemen">Yemen</option>
    <option value="Yugoslavia">Yugoslavia</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>



		</select>
		</label>



		</section>
		</div>
		</div>




		<section>
		<label class="input">
		<input type="text" name="username" placeholder="Username" id="username" class="form-control">
		</label>
		</section>
		<div id="usernaameerr"></div>


		<section>
		<label class="input">
		<input type="password" name="password" placeholder="Password" id="password" class="form-control">
		</label>
		</section>
		<section>
		<label class="input">
		<input type="password" name="passwordConfirm" placeholder="Confirm password" class="form-control">
		</label>
		</section>
		</div>



		<label class="checkbox margin-bottom-20">
		<input type="checkbox" name="terms"/>
		<i></i>
		I have read agreed with the <a href="#">terms &amp; conditions</a>
		</label>
		<button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Create Account</button>
		</form>

		<div class="margin-bottom-20"></div>
		<p class="text-center">Already you have an account? <a href="<?php echo "$baseurl/login"; ?>">Sign In</a></p>
		</div>





</div><!--/end row-->
</div><!--/end container-->
</div>
<!--=== End Registre ===-->





<?php 
include('include-footer.php');
?>





<script type='text/javascript'>

jQuery(document).ready(function(){







$('#refname').on('input', function() {

var refname = $("#refname").val();
var poss = $("#poss").val();

        $.post( 
           "<?php echo $baseurl; ?>/jsapi-position.php",
                  { 
                     refname : refname,
                     poss : poss
          },


							function(data) {
							$("#resu").html(data);
							}
               );
});


$('#poss').on('change', function() {

var refname = $("#refname").val();
var poss = $("#poss").val();


        $.post( 
           "<?php echo $baseurl; ?>/jsapi-position.php",
                  { 
                     refname : refname,
                     poss : poss
          },


							function(data) {
							$("#resu").html(data);
							}
               );


});






$('#username').on('input', function() {

var username = $("#username").val();

        $.post( 
           "<?php echo $baseurl; ?>/jsapi-username.php",
                  { 
                     username : username
          },


							function(data) {
							$("#usernaameerr").html(data);
							}
               );
});








$('#mobile').on('input', function() {

var mobile = $("#mobile").val();

        $.post( 
           "<?php echo $baseurl; ?>/jsapi-mobile.php",
                  { 
                     mobile : mobile
          },


							function(data) {
							$("#mobileerr").html(data);
							}
               );
});



$('#email').on('input', function() {

var email = $("#email").val();

        $.post( 
           "<?php echo $baseurl; ?>/jsapi-email.php",
                  { 
                     email : email
          },


							function(data) {
							$("#emailerr").html(data);
							}
               );
});









  
});
</script>



</body>
</html>
