<?php require_once('wp-config.php'); 

include("includes/header.php");
$usersemail = strip_tags($_POST["email"]);
$password =  strip_tags($_POST["password"]);
$newtoken =  strip_tags($_POST["newtoken"]);

$lid = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
mysql_select_db(DB_NAME, $lid);
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
mysql_query("SET NAMES 'utf8'",$lid);
$query = "Update users set password='".$password."', password_md5='".md5($password)."' where email='".$usersemail."'";

$result=mysql_query($query,$lid) or die(mysql_error());

if($result!=1){
	?>
	
	<div class="row-fluid">&nbsp;
        <div class="span4 offset4"><h3> Ξέχασα τον κωδικό μου </h3></div>
        </div>
        <div class="row-fluid">&nbsp;
        <div class="span4 offset4">
        <p>Κάποιο λάθος παρουσιάστηκε παρακαλώ δοκιμάστε ξανά!<a href='resetemail-1.php'>Ξέχασα τον κωδικό μου!</a></p>
		<p></p>
		<p>Σας ευχαριστούμε για την συμμετοχή σας<br/> 
		Οι υπεύθυνοι των Μονάδων Αριστείας! <br/>
		Μa.ellak.gr<br/>
		</p>
        	
        </div>
        </div>
       
	<?php 
}else{
?>

 <div class="row-fluid">&nbsp;
        <div class="span4 offset4"><h3> Ξέχασα τον κωδικό μου </h3></div>
        </div>
        <div class="row-fluid">&nbsp;
        <div class="span4 offset4">
        <p>O κωδικός σας άλλαξε με επιτυχία.!
        	Μπορείτε να επιστρέψετε στη δικτυακή πύλη των Μονάδων Αριστείας! <a href="http://ma.ellak.gr">ma.ellak.gr</a></p>
		<p></p>
		<p>Σας ευχαριστούμε για την συμμετοχή σας<br/> 
		Οι υπεύθυνοι των Μονάδων Αριστείας! <br/>
		Μa.ellak.gr<br/>
		</p>
        </div>
        </div>
       
 <?php 
}
	include("includes/footer.php")
?>
