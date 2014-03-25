<?php require_once('../wp-config.php');
require_once('includes/emailTemplate.php'); 

$user = $_GET['id'];

if ($user=="admin") {
	Header("Location: /backoffice/");
exit;
}


$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);


if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(DB_NAME, $con);

$st=0;

$q = "select * from users where username ='".$user."'";
$qry = mysql_query($q);
$row = mysql_fetch_array($qry);
if ($row['_status']==0)
	$st =1;
 
$q  = "UPDATE `users` SET `_status` = '".$st."' WHERE `users`.`username` = '".$user."'";

$qry = mysql_query($q);
							
$message_activate = '<td class="w580" width="580">
                                    <h1>Ενεργοποίηση Λογαριασμού</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="w580" width="580">
                                    <div class="article-content" align="left">
                                        Ο λογαριασμός σας ενεργοποιήθηκε από τους υπεύθυνους του έργου.Μπορείτε να συνδεθείτε από <a href="http://ma.ellak.gr">εδώ</a>.
                                    </div>
									 <div class="article-content" align="left">
										Για την ολοκλήρωση της εγγραφής σας παρακαλούμε κάνετε τουλάχιστον μια φορά login στο σύστημα απο <a href="https://ma.ellak.gr/">εδώ</a>.
									</div>
                                    <div class="article-content" align="left">
                                        Μπορείτε να δηλώσετε συμμετοχή και να συμβάλλετε στο έργο των Μονάδων Αριστείας. Παράλληλα, μπορείτε ανεξάρτητα από τις Μοναδες Αριστείας 
                                        να βοηθήσετε στην διάδοση του ανοικτού λογισμικού / λογισμικού ανοικτού κώδικα , παρέχοντας σχετικό υλικό. Ενημερωθείτε για το πως μπορείτε να συμμετάσχετε ενεργά από <a href="http://ma.ellak.gr">εδώ</a>.
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
                                    
$message_deactivate =  '<td class="w580" width="580">
                                    <h1>Απενεργοποίηση Λογαριασμού</h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="w580" width="580">
                                    <div class="article-content" align="left">
                                        Ο λογαριασμός σας απενεργοποιήθηκε από τους υπεύθυνους του έργου.
                                    </div>
                                    <div class="article-content" align="left">
                                        Μπορείτε να ζητήσετε ενεργοποίηση του λογαριασμού σας αποστέλλοντας μήνυμα στο info@ma.ellak.gr.
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

if ($st==0) {
	$subject = 'Ενεργοποίηση Λογαριασμού - Μονάδες Αριστείας';
	//mail($to, $subject, $message, $headers);
	sendMaEmail($message_activate, $subject, $row['email']);
} else {
	$subject = 'Απενεργοποίηση Λογαριασμού - Μονάδες Αριστείας';
	//mail($to, $subject, $message, $headers);
	sendMaEmail($message_deactivate, $subject, $row['email']);

}

Header("Location: /backoffice/");
?>
