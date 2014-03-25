<?php 
include("includes/header.php");
require_once('wp-config.php'); 
require_once('backoffice/includes/emailTemplate.php');


$error = false;
$sent = false;

if(isset($_GET['error']))
	$error = true;

if(isset($_POST['email']) and isset($_POST['resetemail'])){
	
	$email = trim(strip_tags($_POST['email']));
	
	$lid = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
	mysql_select_db(DB_NAME, $lid);
	
	$query = mysql_query("SELECT `_time` FROM `users` WHERE `email` = '$email'");
	
	if(mysql_num_rows($query) == 1) { 
		$row = mysql_fetch_array($query);
		
	 $subject = 'Επανορισμός συνθηματικού - Μονάδες Αριστείας';
                                    
$message_reset =  '<td class="w580" width="580">
                                    <h1>Επανορισμός συνθηματικού.</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="w580" width="580">
                                    <div class="article-content" align="left">
                                        Για να επανορίσετε το συνθηματικό σας παρακαλούμε ακολουθήστε τον παρακάτω σύνδεσμο:
                                    </div>
                                    <div class="article-content" align="left">
                                        <a href="https://ma.ellak.gr/newpass.php?token='.$row['_time'].'">https://ma.ellak.gr/newpass.php?token='.$row['_time'].'</a>
                            		</div>
                            		<div class="article-content" align="left">
                                        <br/><br/>
                                        Σας ευχαριστούμε για την συμμετοχή σας<br/>
                                        Οι υπεύθυνοι των Μονάδων Αριστείας!
                                        <br/>
										<br/>
                                        <a href="http://ma.ellak.gr">ma.ellak.gr</a>
                                    </div>
                                </td>
                            </tr>';
                            

	
		sendMaEmail($message_reset, $subject, $email);
		
		$sent = true;
		
	} else {
		$error = true;
	}
}
?>
<div class="row-fluid">&nbsp;
	<div class="span4 offset4"><h3>Ξέχασα τον κωδικό μου</h3></div>
</div>
	<div class="row-fluid login dropdown yamm-fullwidth open dropdown-toggle">
		<div class="span12">
			<div class="yamm-content">
			
					<?php if($error){ ?>
						<div class="row-fluid"> <div class="span4 offset4 alert alert-error">Προέκυψε σφάλμα κατά τη διαδικασία. Παρακαλώ ελέγξτε ξανά το email σας ή επαναλάβετε τη διαδικασία εκ νέου.</div>	</div>				
					<?php } ?>
					
					<div class="row-fluid"><div class="span4 offset4"> Προσοχή η ενέργεια αυτή ισχύει μόνο για τοπικούς χρήστες. Σε περίπτωση που χρησιμοποιείτε τον ακαδημαϊκό σας λογαριασμό για την σύνδεση σας στις Μονάδες Αριστείας, ΔΕΝ μπορείτε να αλλάξετε τον κωδικό σας aπό εδώ . Πρέπει να επικοινωνήσετε με τους υπεύθυνους του Φορέα σας!! </div></div>
					
					<?php if($sent){ ?>
						<br />
						<div class="row-fluid"><div class="span4 offset4 alert alert-info">Ένα μήνυμα εχει αποσταλεί στο email σας περιέχοντας τον σύνδεσμο αλλαγής του προσωπικού σας κωδικού.</div></div>					
						
					<?php } else { ?>
					<div class="row-fluid">
						<form  id="emailForm" action="resetemail-1.php" class="form-horizontal span12" method="post">
							<fieldset class="form-vertical span4 offset4">
							<div class="control-group">
									<label class="control-label span12" for="email">EMAIL</label>
									<div class="controls">
									<input type="text" class="input-block-level required" id="email" name="email">
									</div>
									
								</div>
								<div class="control-group">
									<label class="control-label span12" for="login-button"></label>
									<div class="control">
									<button id="resetemail" name="resetemail" class="btn btn-primary btn-block" type="submit">ΑΠΟΣΤΟΛΗ EMAIL</button>
									</div>
								</div>
							</fieldset>
						</form></div><!-- row-fluid" -->
					<?php } ?>
				
			</div><!-- yamm-content -->
		</div><!--span12  -->
		</div><!-- row-fluid login dropdown yamm-fullwidth open dropdown-toggle -->

<?php include("includes/footer.php");?>
