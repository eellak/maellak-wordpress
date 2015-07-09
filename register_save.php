<?php 
require_once('wp-config.php'); 
require_once('backoffice/includes/emailTemplate.php');
	require_once('recaptchalib.php');
        $privatekey = "6LfZFOcSAAAAAKhtX-AxGDX2grJ8t8Cl5wpmZn4T";
        $resp = null;
        $error = null;
        if ($_POST["recaptcha_response_field"]) {
                //$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
        if ($resp->is_valid || 1 ) {

                //echo "You got it!";
        } else {
		include("includes/header.php");
                # set the error code so that we can display it
                $error = $resp->error;
echo "<center><br/><br/><br/>";
?>
 <div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <strong>Error!</strong>Ο κωδικός που βάλατε για το captcha είναι λάθος. Παρακαλώ επιστρέψτε πίσω στη σελίδα και βάλτε το σωστό.  <a href="register.php">ΠΙ
ΣΩ</a>
</div>
<?php
include("includes/footer.php");
die();

        }
}else{


                include("includes/header.php");
                # set the error code so that we can display it
                $error = $resp->error;
echo "<center><br/><br/><br/>";
?>
 <div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <strong>Error!</strong>Ο κωδικός που βάλατε για το captcha είναι λάθος. Παρακαλώ επιστρέψτε πίσω στη σελίδα και βάλτε το σωστό.  <a href="register.php">ΠΙ
ΣΩ</a>
</div>
<?php
include("includes/footer.php");
die();


}


include("includes/header.php"); ?>

<?php
$_POST["regname"]   = strip_tags($_POST["regname"]);
$_POST["regemail"]  = strip_tags($_POST["regemail"]);
$_POST["regpass1"]  = strip_tags($_POST["regpass1"]);
$_POST["regpass2"]  = strip_tags($_POST["regpass2"]);
$_POST["username1"] = strip_tags($_POST["username1"]);
$_POST["username2"] = strip_tags($_POST["username2"]);
$_POST["foreas"]    = strip_tags($_POST["foreas"]);

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());

mysql_set_charset('utf8',$conn);

$cs = 0;
mysql_select_db(DB_NAME, $conn);
$s1="select * from users where username='".$_POST['regname']."' limit 1;";
//echo $q1;
$r1=mysql_query($s1,$conn) or die(mysql_error());
if (mysql_num_rows($r1)>0) {
	$cs =1 ;
        $lathos =  " ΤΟ USERNAME ΥΠΑΡΧΕΙ ΗΔΗ ΚΑΙ ΕΙΝΑΙ ΕΝΕΡΓΟ ΣΕ ΑΛΛΟ ΛΟΓΑΡΙΑΣΜΟ ";
} 

$s1="select * from users where email='".$_POST['regemail']."' limit 1;";
//echo $q1;
$r1=mysql_query($s1,$conn) or die(mysql_error());
if (mysql_num_rows($r1)>0) {
	$cs=2;
        $lathos = " ΤΟ EMAIL ΥΠΑΡΧΕΙ ΗΔΗ ΣΕ ΑΛΛΟ ΛΟΓΑΡΙΑΣΜΟ ";
}

//echo $cs;

if ($cs==0) {

$sql="insert into users (onoma, eponimo, username,foreas,idikotita,email,password,password_md5,_ip)values('$_POST[username1]','$_POST[username2]','$_POST[regname]','$_POST[foreas]','$_POST[idikotita]','$_POST[regemail]','$_POST[regpass1]','".md5($_POST[regpass1])."','$_SERVER[REMOTE_ADDR]')";
$result=mysql_query($sql,$conn) or die(mysql_error());
}

//echo "<meta http-equiv=\"refresh\" content=\"3;url=http://snf-105343.vm.okeanos.grnet.gr/\" />";
//print "<center><br/><br/><br/><h1>you have registered sucessfully</h1>";
//print "<a href='/index.php'>login</a>";
//}
//else print "passwords doesnt match";

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}

//	mysql_select_db("redmine1",$conn);
	mysql_set_charset('utf8',$conn);
	$salt = generateRandomString(30);
	$saltk = sha1($salt);
	$qq = $salt."".sha1($_POST['regpass1']);
	$qqq = sha1($qq);
//	echo $qqq;
	$ddd = date("Y-m-d g:i:01"); 
	$current_encoding = mb_detect_encoding($_POST['username1'], 'auto');
	$uu1 = iconv($current_encoding, 'UTF-8', $_POST['username1']);

        $current_encoding = mb_detect_encoding($_POST['username2'], 'auto');
        $uu2 = iconv($current_encoding, 'UTF-8', $_POST['username2']);

	$q = "INSERT INTO `redmine1`.`users` (`id`, `login`, `hashed_password`, `firstname`, `lastname`, `mail`, `admin`, `status`, `last_login_on`, `language`, `auth_source_id`, `created_on`, `updated_on`, `type`, `identity_url`, `mail_notification`, `salt`) VALUES (NULL, '".$_POST['regname']."', '".$qqq."', '".$uu1."', '".$uu2."', '".$_POST["regemail"]."', '0', '1', NULL, '', NULL, '".$ddd."', '".$ddd."', 'User', NULL, 'only_my_events', '".$salt."');";

//	if ($cs==0)
//		$result=mysql_query($q,$conn) or die(mysql_error());

//	echo $q;

	?>
 <div class="row-fluid">&nbsp;
        <div class="span4 offset4"><h3> Εγγραφή στις Μονάδες </h3></div>
        </div>
        <div class="row-fluid">&nbsp;
        <div class="span4 offset4">
<?php 
if (strlen($lathos)>5) {
?>
<p> <?php echo $lathos; ?></p>

<?php
} else {
?>
        <p>Η διαδικασία εγγραφής στη δικτυακή πύλη των Μονάδων Αριστείας ολοκληρώθηκε. Ο λογαριασμός σας είναι ενεργός και μπορείτε να συνδεθείτε απο εδώ <a href="https://ma.ellak.gr/">εδώ</a>.</p>
		 <p>Με την εγγραφή σας στη δικτυακή πύλη των Μονάδων Αριστείας αποκτάτε κατευθείαν πρόσβαση στις υπηρεσίες του έργου ενώ παράλληλα μπορείτε να δηλώσετε συμμετοχή στις Μοναδες Αριστείας και να συμβάλλετε στο έργο τους. Παράλληλα, μπορείτε ανεξάρτητα από τις Μοναδες Αριστείας να βοηθήσετε στην διάδοση του ανοικτού λογισμικού / λογισμικού ανοικτού κώδικα , παρέχοντας σχετικό υλικό. Ενημερωθείτε για το πως μπορείτε να συμμετάσχετε ενεργά από <strong><a href="https://ma.ellak.gr/">εδώ</a></strong>.
		</p>
		<p>Για την ολοκλήρωση της εγγραφής σας παρακαλούμε κάνετε τουλάχιστον μια φορά login στο σύστημα απο <a href="https://ma.ellak.gr/">εδώ</a>.</p>
		<p></p>
		<p>Σας ευχαριστούμε για την συμμετοχή σας<br/> 

<?php

$subject = 'Εγγραφή νέου χρήστη';

$messageF =  '
                                <td class="w580" width="580">
                                    <h1>Εγγραφή στις Μονάδες</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="w580" width="580">
                                    <div class="article-content" align="left">
                                        Η διαδικασία εγγραφής στη δικτυακή πύλη των Μονάδων Αριστείας ολοκληρώθηκε. 
                                        Ο λογαριασμός σας είναι ενεργός προς το παρόν και μπορείτε να συνδεθείτε από <a href="http://ma.ellak.gr">εδώ</a>
                                      </div>
									 <div class="article-content" align="left">Για την ολοκλήρωση της εγγραφής σας παρακαλούμε κάνετε τουλάχιστον μια φορά login στο σύστημα απο <a href="https://ma.ellak.gr/">εδώ</a>.</div>
                                    <div class="article-content" align="left">
                                        Με την εγγραφή σας  στη δικτυακή πύλη των Μονάδων Αριστείας αποκτάτε κατευθείαν πρόσβαση στις υπηρεσίες του έργου, ενώ παράλληλα μπορείτε να δηλώσετε συμμετοχή και να συμβάλλετε στο έργο τους. Παράλληλα, μπορείτε ανεξάρτητα από τις Μοναδες Αριστείας 
                                        να βοηθήσετε στην διάδοση του ανοικτού λογισμικού / λογισμικού ανοικτού κώδικα , παρέχοντας σχετικό υλικό. Ενημερωθείτε για το πως μπορείτε να συμμετάσχετε ενεργά από <a href="http://ma.ellak.gr">εδώ</a>.
                            		</div>
                                    <div class="article-content" align="left">
                                        <br/>
                                        Σας ευχαριστούμε για την συμμετοχή σας 
                                        <br/>
                                        Οι υπεύθυνοι των Μονάδων Αριστείας!
                                        <br/>
                                        <a href="http://ma.ellak.gr">Μa.ellak.gr</a>
                                    </div>
                                </td>
                            </tr>';
            

sendMaEmail($messageF, $subject, $_POST["regemail"]);



 } ?><br/><br/>
		Οι υπεύθυνοι των Μονάδων Αριστείας! <br/>
		Μa.ellak.gr<br/>
		</p>
        	
        </div>
        </div>

<?php 
include("includes/footer.php");?>

