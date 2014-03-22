<?php require_once('../wp-config.php'); 

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

$message_header = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head><title></title><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
/* Mobile-specific Styles */
@media only screen and (max-width: 660px) { 
table[class=w0], td[class=w0] { width: 0 !important; }
table[class=w10], td[class=w10], img[class=w10] { width:10px !important; }
table[class=w15], td[class=w15], img[class=w15] { width:5px !important; }
table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
table[class=w60], td[class=w60], img[class=w60] { width:10px !important; }
table[class=w125], td[class=w125], img[class=w125] { width:80px !important; }
table[class=w130], td[class=w130], img[class=w130] { width:55px !important; }
table[class=w140], td[class=w140], img[class=w140] { width:90px !important; }
table[class=w160], td[class=w160], img[class=w160] { width:180px !important; }
table[class=w170], td[class=w170], img[class=w170] { width:100px !important; }
table[class=w180], td[class=w180], img[class=w180] { width:80px !important; }
table[class=w195], td[class=w195], img[class=w195] { width:80px !important; }
table[class=w220], td[class=w220], img[class=w220] { width:80px !important; }
table[class=w240], td[class=w240], img[class=w240] { width:180px !important; }
table[class=w255], td[class=w255], img[class=w255] { width:185px !important; }
table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
table[class=w280], td[class=w280], img[class=w280] { width:135px !important; }
table[class=w300], td[class=w300], img[class=w300] { width:140px !important; }
table[class=w325], td[class=w325], img[class=w325] { width:95px !important; }
table[class=w360], td[class=w360], img[class=w360] { width:140px !important; }
table[class=w410], td[class=w410], img[class=w410] { width:180px !important; }
table[class=w470], td[class=w470], img[class=w470] { width:200px !important; }
table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }
table[class=h0], td[class=h0] { height: 0 !important; }
p[class=footer-content-left] { text-align: center !important; }
#headline p { font-size: 30px !important; }
.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }
.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}
img { height: auto; line-height: 100%;}
 } 
/* Client-specific Styles */
#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */
body { width: 100% !important; }
.ReadMsgBody { width: 100%; }
.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
/* Reset Styles */
/* Add 100px so mobile switch bar doesnt cover street address. */
body { background-color: #ececec; margin: 0; padding: 0; }
img { outline: none; text-decoration: none; display: block;}
br, strong br, b br, em br, i br { line-height:100%; }
h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }
/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
table td, table tr { border-collapse: collapse; }
.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
}	/* Body text color for the New Yahoo.  This example sets the font of Yahoos Shortcuts to black. */
/* This most probably wont work in all email clients. Dont include code blocks in email. */
code {
  white-space: normal;
  word-break: break-all;
}
#background-table { background-color: #ececec; }
/* Webkit Elements */
#top-bar { border-radius:6px 6px 0px 0px; -moz-border-radius: 6px 6px 0px 0px; -webkit-border-radius:6px 6px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #57294C; color: #b2a78c; }
#top-bar a { font-weight: bold; color: #b2a78c; text-decoration: none;}
#footer { border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; -webkit-font-smoothing: antialiased; }
/* Fonts and Content */
body, td { font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */
.header-content { font-size: 12px; color: #b2a78c; }
.header-content a { font-weight: bold; color: #b2a78c; text-decoration: none; }
#headline p { color: #f2e9a8; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; font-size: 36px; text-align: center; margin-top:0px; margin-bottom:30px; }
#headline p a { color: #f2e9a8; text-decoration: none; }
.article-title { font-size: 18px; line-height:24px; color: #b2a78c; font-weight:bold; margin-top:0px; margin-bottom:18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
.article-title a { color: #b2a78c; text-decoration: none; }
.article-title.with-meta {margin-bottom: 0;}
.article-meta { font-size: 13px; line-height: 20px; color: #ccc; font-weight: bold; margin-top: 0;}
.article-content { font-size: 13px; line-height: 18px; color: #444444; margin-top: 0px; margin-bottom: 18px; font-family: Helvetica Neue, Arial, Helvetica, Geneva, sans-serif; }
.article-content a { color: #57294C; font-weight:bold; text-decoration:none; }
.article-content img { max-width: 100% }
.article-content ol, .article-content ul { margin-top:0px; margin-bottom:18px; margin-left:19px; padding:0; }
.article-content li { font-size: 13px; line-height: 18px; color: #444444; }
.article-content li a { color: #57294C; text-decoration:underline; }
.article-content p {margin-bottom: 15px;}
.footer-content-left { font-size: 12px; line-height: 15px; color: white; margin-top: 0px; margin-bottom: 15px; }
.footer-content-left a { color: white; font-weight: bold; text-decoration: none; }
.footer-content-right { font-size: 11px; line-height: 16px; color: #b2a78c; margin-top: 0px; margin-bottom: 15px; }
.footer-content-right a { color: #f2e9a8; font-weight: bold; text-decoration: none; }
#footer { background-color: #57294C; color: white; }
#footer a { color: #white; text-decoration: none; font-weight: bold; }
#permission-reminder { white-space: normal; }
#street-address { color: #f2e9a8; white-space: normal; }
h1{
    font: 300 16px/22px Roboto,arial,sans-serif;
    color: inherit;
text-rendering: optimizelegibility;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="146" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px;
   padding: 0;
   list-style-position: inside;
}
</style>
<![endif]--><script type="text/javascript">var NREUMQ=NREUMQ||[];NREUMQ.push(["mark","firstbyte",new Date().getTime()]);</script></head><body><table id="background-table" width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody><tr>
		<td align="center" bgcolor="#ececec">
        	<table class="w640" style="margin:0 10px;" width="640" border="0" cellpadding="0" cellspacing="0">
            	<tbody><tr><td class="w640" height="20" width="640"></td></tr>
                
            	<tr>
                	<td class="w640" width="640">
                        <table id="top-bar" class="w640" width="640" bgcolor="#57294C" border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
        <td class="w15" width="15"></td>
        <td class="w325" valign="middle" width="350" align="left">
            <table class="w325" width="350" border="0" cellpadding="0" cellspacing="0">
                <tbody><tr><td class="w325" height="8" width="350"></td></tr>
            </tbody></table>
            <table class="w325" width="350" border="0" cellpadding="0" cellspacing="0">
                <tbody><tr><td class="w325" height="8" width="350"></td></tr>
            </tbody></table>
        </td>
        <td class="w30" width="30"></td>
        <td class="w255" valign="middle" width="255" align="right">
            <table class="w255" width="255" border="0" cellpadding="0" cellspacing="0">
                <tbody><tr><td class="w255" height="8" width="255"></td></tr>
            </tbody></table>
            <table border="0" cellpadding="0" cellspacing="0">
    <tbody><tr>
        
        <td valign="middle"><a href="http://www.facebook.com/ma_ellak" rel="cs_facebox"><img src="http://ma.ellak.gr/js/like-glyph.png" alt="Facebook icon" ="" height="14" width="8" border="0"></a></td>
        <td width="3"></td>
        <td valign="middle"><div class="header-content"><a href="http://www.facebook.com/ma_ellak" rel="cs_facebox" style="color:#fff;text-transform:uppercase;text-decoration:none;">Like</a></div></td>
        
        
        <td class="w10" width="10"></td>
        <td valign="middle"><a href="http://www.twitter.com/ma_ellak"><img src="http://ma.ellak.gr/js/tweet-glyph.png" alt="Twitter icon" ="" height="13" width="17" border="0"></a></td>
        <td width="3"></td>
        <td valign="middle"><div class="header-content"><a href="http://www.twitter.com/ma_ellak" style="color:#fff;text-transform:uppercase;text-decoration:none;">Tweet</a></div></td>
        
        <td class="w10" width="10"></td>
        <td valign="middle"></td>
        <td width="3"></td>
        <td valign="middle"></td>
        
    </tr>
</tbody></table>
            <table class="w255" width="255" border="0" cellpadding="0" cellspacing="0">
                <tbody><tr><td class="w255" height="8" width="255"></td></tr>
            </tbody></table>
        </td>
        <td class="w15" width="15"></td>
    </tr>
</tbody></table>
                        
                    </td>
                </tr>
                <tr>
                <td id="header" class="w640" width="640" align="center" bgcolor="#57294C">
    
    <table class="w640" width="640" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="w30" width="30"></td><td class="w580" height="30" width="580"></td><td class="w30" width="30"></td></tr>
        <tr>
            <td class="w30" width="30"></td>
            <td class="w580" width="580"></td>
            <td class="w30" width="30"></td>
        </tr>
    </tbody></table>
    
    
</td>
                </tr>
                
                <tr><td class="w640" height="30" width="640" bgcolor="#ffffff">
                
                
                </td></tr>
                <tr id="simple-content-row"><td class="w640" width="640" bgcolor="#ffffff">
    <table class="w640" width="640" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
            <td class="w30" width="30"></td>
            <td class="w580" width="580">
                <repeater>
                     <layout label="Text with full-width image">
                        <table class="w580" width="580" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td class="w580" width="580"><center><img label="Image"  border="0" src="http://ma.ellak.gr/wp-content/themes/ma_ellak/images/logo_normal.png" align="center" style="display: block;
width: auto;
max-width: none;vertical-align:center;"></center></td>

                            </tr>
                            <tr><td class="w580" height="15" width="580"></td></tr>
                            <tr>';
							
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
                                        Μπορείτε να δηλώσετε συμμετοχή και να συμβάλλετε στο έργο των Μονάδων Αριστείας. Παράλληλα, μπορείτε ανεξάρτητα από τις Μοναδες Αριστείας 
                                        να βοηθήσετε στην διάδοση του ανοικτού λογισμικού / λογισμικού ανοικτού κώδικα , παρέχοντας σχετικό υλικό. Ενημερωθείτε για το πως μπορείτε να συμμετάσχετε ενεργά από <a href="http://ma.ellak.gr">εδώ</a>.
                            		</div>';
                                    
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
                            		</div>';
										
$message_footer = 
                                        '<div class="article-content" align="left">
                                        <br/><br/>
                                        Σας ευχαριστούμε για την συμμετοχή σας<br/>
                                        Οι υπεύθυνοι των Μονάδων Αριστείας!
                                        <br/>
										<br/>
                                        <a href="http://ma.ellak.gr">ma.ellak.gr</a>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td class="w580" width="580">
                                    <div class="article-content" align="left">
                           				<small>Το υποέργο «Διαδικτυακή Πύλη»  εντάσσεται στο έργο «Ηλεκτρονικές Υπηρεσίες για την Ανάπτυξη και Διάδοση του Ανοιχτού Λογισμικού». Στόχος της διαδικτυακής πύλης ειναι να λειτουργεί ως κεντρικό σημείο δημοσιοποίησης και υποστήριξης του έργου που υλοποιούν οι Μονάδες Αριστείας, ώστε να αποτελέσει μια δυναμική και ανανεούμενη πηγή πληροφόρησης της Ακαδημαϊκής Κοινότητας, των πολιτών, του Δημόσιου Τομέα και των επιχειρήσεων, για τις τάσεις και τις εξελίξεις, στην Ελλάδα και διεθνλως, για θέματα ανοικτού λογισμικού, από οποιοδήποτε μέσο.   Η επίτευξη του στόχου αυτού γίνεται μέσα από την παροχή μιας σειράς από εργαλεία και υπηρεσίες προς τους χρήστες που εξυπηρετούν τη δημοσιοποίηση και την οργάνωση του περιεχομένου  που παράγεται από τις Μονάδες Αριστείας αλλά και όλους τους χρήστες της πύλης.
                                </small>
                                </div>
                                </td>
                            </tr>
                            <tr><td class="w580" height="10" width="580"></td></tr>
                        </tbody></table>
                    </layout>
                     
                 </repeater>
            </td>
            <td class="w30" width="30"></td>
            
        </tr>
    </tbody></table>
</td></tr>
                <tr><td class="w640" height="15" width="640" bgcolor="#ffffff"></td></tr>
                
                <tr>
                <td class="w640" width="640">
    <table id="footer" class="w640" width="640" bgcolor="#57294C" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr><td class="w30" width="30"></td><td class="w580 h0" height="30" width="360"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
        <tr>
            <td class="w30" width="30"></td>
            <td class="w580" valign="top" width="500">
            <span class="hide"><p id="permission-reminder" class="footer-content-left" align="left">
            	<span>Λαμβάνετε αυτό το μήνυμα γιατί έχετε εγγραφεί στις Μονάδες Αριστείας. </span>
            </span>
            </td>
            <td class="hide w0" width="60"></td>
            <td class="hide w0" valign="top" width="160">
            <p id="street-address" class="footer-content-right" align="right"></p>
            </td>
            <td class="w30" width="30"></td>
        </tr>
        <tr><td class="w30" width="30"></td><td class="w580 h0" height="15" width="360"></td><td class="w0" width="60"></td><td class="w0" width="160"></td><td class="w30" width="30"></td></tr>
    </tbody></table>
</td>
                </tr>
                <tr><td class="w640" height="60" width="640"></td></tr>
            </tbody></table>
        </td>
	</tr>
</tbody></table>
</body></html>
';

$to      = $row['email'];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: ' .$to. "\r\n";
$headers .= 'From: Μονάδες Αριστείας ΕΛΛ/ΛΑΚ <no-reply@ma.ellak.gr>' . "\r\n";

if ($st==1) {
	$subject = 'Ενεργοποίηση Λογαριασμού - Μονάδες Αριστείας';
	$message = $message_header . $message_activate  . $message_footer ;
	mail($to, $subject, $message, $headers);
} else {
	$subject = 'Απενεργοποίηση Λογαριασμού - Μονάδες Αριστείας';
	$message = $message_header . $message_deactivate  . $message_footer ;
	mail($to, $subject, $message, $headers);
}

Header("Location: /backoffice/");
?>
