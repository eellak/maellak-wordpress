<?php 
	include("includes/header.php")
?>
 	<div class="row-fluid">
 		<div class="span4 offset4"><h3> Εγγραφή </h3></div>
    </div>
        <div class="row-fluid login dropdown yamm-fullwidth open dropdown-toggle">
    		<div class="span12">
                <div class="yamm-content">
                
                  <div class="row-fluid">
      <form class="form-horizontal span12" id="myform" ACTION="register_save.php" METHOD=post>
	      <fieldset class="form-vertical span4 offset4">

		<label for="username1">Ονομα (*)</label>
		<input name="username1" id="username1" type="text" class="input-block-level required" ><span id="username1Info"></span><br/>
		<label for="username2">Επωνυμο (*)</label>
		<input name="username2" id="username2" type="text" class="input-block-level"><span id="username2Info"></span><br/>
		<label for="regname">Ονομα Χρηστη (*)</label>
		<input name="regname" id="regname" type="text" class="input-block-level"><span id="regnameInfo"></span><br/>
		<label for="regemail">Ηλεκτρονικο ταχυδρομιο - email (*)</label>
		<input name="regemail" id="regemail" type="text" class="input-block-level"><span id="regemailInfo"></span><br/>
		<label for="foreas">Φορεας (*)</label>
		<select name="foreas" id="foreas">
		<option value="" selected>-- -- --</option>
		<optgroup label="Πανεπιστήμια">
			<option value="https://idp.asfa.gr/idp/shibboleth">Ανωτάτη Σχολή Καλών Τεχνών</option>
			<option value="https://login-idp.auth.gr/idp/shibboleth">Αριστοτέλειο Πανεπιστήμιο Θεσσαλονίκης</option>
			<option value="https://idp.aua.gr/idp/shibboleth">Γεωπονικό Πανεπιστήμιο Αθηνών</option>
			<option value="https://grnetbox.duth.gr/idp/shibboleth">Δημοκρίτειο Πανεπιστήμιο Θράκης</option>
			<option value="https://idp.ihu.gr/idp/shibboleth" >Διεθνές Πανεπιστήμιο της Ελλάδος</option>
			<option value="https://idp.uoa.gr/idp/shibboleth">Εθνικό Καποδιστριακό Πανεπιστήμιο Αθηνών</option>
			<option value="https://login.ntua.gr/idp/shibboleth">Εθνικό Μετσόβιο Πολυτεχνείο</option>
			<option value="https://login.eap.gr/idp/shibboleth">Ελληνικό Ανοικτό Πανεπιστήμιο</option>
			<option value="https://idp.ionio.gr/idp/shibboleth">Ιόνιο Πανεπιστήμιο</option>
			<option value="https://idp.aueb.gr/idp/shibboleth">Οικονομικό Πανεπιστήμιο Αθηνών</option>
			<option value="https://idp.panteion.gr/idp/shibboleth">Πάντειο Πανεπιστήμιο</option>
			<option value="https://idp.aegean.gr/idp/shibboleth">Πανεπιστήμιο Αιγαίου</option>
			<option value="https://idp.uwg.edu.gr/idp/shibboleth">Πανεπιστήμιο Δυτικής Ελλάδας</option>
			<option value="https://idp.uowm.gr/idp/shibboleth">Πανεπιστήμιο Δυτικής Μακεδονίας</option>
			<option value="https://idp.uth.gr/idp/shibboleth">Πανεπιστήμιο Θεσσαλίας</option>
			<option value="https://idp.uoi.gr/idp/shibboleth">Πανεπιστήμιο Ιωαννίνων</option>
			<option value="https://login.uoc.gr/idp/shibboleth">Πανεπιστήμιο Κρήτης</option>
			<option value="https://idp.uom.gr/idp/shibboleth">Πανεπιστήμιο Μακεδονίας</option>
			<option value="https://idp.upatras.gr/shibboleth-idp/">Πανεπιστήμιο Πάτρας</option>
			<option value="https://idp.unipi.gr/idp/shibboleth">Πανεπιστήμιο Πειραιά</option>
			<option value="https://idp2.uop.gr/idp/shibboleth">Πανεπιστήμιο Πελοποννήσου</option>
			<option value="https://idp.ucg.gr/idp/shibboleth">Πανεπιστήμιο Στερεάς Ελλάδας</option>
			<option value="https://idp.tuc.gr/idp/shibboleth">Πολυτεχνείο Κρήτης</option>
			<option value="https://idp2.hua.gr/idp/shibboleth">Χαροκόπειο Πανεπιστήμιο</option>
		</optgroup>
	
		<optgroup label="Τεχνολογικά εκπαιδευτικά ιδρύματα">
			<option value="https://idp.teithe.gr/idp/shibboleth">Αλεξάνδρειο Τεχνολογικό Εκπαιδευτικό Ίδρυμα Θεσσαλονίκης</option>
			<option value="https://idp.aspete.gr/idp/shibboleth">Ανώτατη Σχολή Παιδαγωγικής και Τεχνολογικής Εκπαίδευσης</option>
			<option value="https://idp.teiath.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Αθήνας</option>
			<option value="https://idp.teikoz.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Δυτικής Μακεδονίας</option>
			<option value="https://idp.teiep.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Ηπείρου</option>
			<option value="https://idp.teiion.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Ιονίων Νήσων</option>
			<option value="https://idp.teikav.edu.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Καβάλας</option>
			<option value="https://idp.teikal.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Καλαμάτας</option>
			<option value="https://idp.teicrete.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Κρήτης</option>
			<option value="https://idp.teilar.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Λάρισας</option>
			<option value="https://idp.teilam.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Λαμίας</option>
			<option value="https://idp.teimes.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Μεσολογγίου</option>
			<option value="https://idp.teipat.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Πατρών</option>
			<option value="https://idp.teipir.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Πειραιά</option>
			<option value="https://idp.teiser.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Σερρών</option>
			<option value="https://idp.teihal.gr/idp/shibboleth">Τεχνολογικό Εκπαιδευτικό Ίδρυμα Χαλκίδας</option>
			
		
		</optgroup>
	
		<optgroup label="Άλλα ανώτατα εκπαιδευτικά ιδρύματα">
			<option value="https://idp.aenmak.edu.gr/idp/shibboleth">Ακαδημία Εμπορικού Ναυτικού Μακεδονίας</option>
			<option value="https://idp.aeaa.gr/idp/shibboleth">Ανώτατη Εκκλησιαστική Ακαδημία Αθήνας</option>
			<option value="https://idp.aeavellas.gr/idp/shibboleth">Ανώτατη Εκκλησιαστική Ακαδημία Βελλάς Ιωαννίνων</option>
			<option value="https://idp.aeahk.gr/idp/shibboleth">Ανώτατη Εκκλησιαστική Ακαδημία Ηρακλείου Κρήτης</option>
			<option value="https://idp.aeath.gr/idp/shibboleth">Ανώτατη Εκκλησιαστική Ακαδημία Θεσσαλονίκης</option>
			<option value="https://login.sse.gr/idp/shibboleth">Στρατιωτική Σχολή Ευελπίδων</option>
		</optgroup>
	
		<optgroup label="Ερευνητικά ινστιτούτα">
			<option value="https://shibboleth-idp.ics.forth.gr/idp/shibboleth/">'Ιδρυμα Τεχνολογίας και 'Ερευνας</option>
			<option value="https://login.athena-innovation.gr/idp/shibboleth">Αθηνά - Ερευνητικό Κέντρο Καινοτομίας</option>
			<option value="https://idp.ariadne-t.gr/idp/shibboleth">ΕΚΕΦΕ Δημόκριτος</option>
			<option value="https://login.noa.gr/idp/shibboleth">Εθνικό Αστεροσκοπείο Αθηνών</option>
			<option value="https://aai.certh.gr/idp/shibboleth">Εθνικό Κέντρο 'Ερευνας και Τεχνολογικής Ανάπτυξης</option>
			<option value="https://idp.ekt.gr/idp/shibboleth">Εθνικό Κέντρο Τεκμηρίωσης</option>
			<option value="https://aai-logon.hcmr.gr/idp/shibboleth">Ελληνικό Κέντρο Θαλασσίων Ερευνών</option>
			<option value="https://grnetbox.cti.gr/idp/shibboleth">Ινστιτούτο Τεχνολογίας Υπολογιστών - Ερευνητική Μονάδα 6</option>
		</optgroup>
	
		<optgroup label="Άλλοι φορείς">
			<option value="https://idp.admin.grnet.gr/idp/shibboleth">Εθνικό Δίκτυο Έρευνας και Τεχνολογίας</option>
			<option value="https://vho.grnet.gr/idp/shibboleth">Εικονικός Οικείος Φορέας (VHO)</option>
		</optgroup>
	
		<optgroup label="Δοκιμαστικοί φορείς">
			<option value="https://eap-idp.mousmoulas.gr/idp/shibboleth">Ελληνικό Ανοικτό Πανεπιστήμιο (test IdP)</option>
		</optgroup>
		</select>
		<label for="foreas1"> ** Αλλος Φορεας <br/>( Εάν δεν υπάρχει στη λίστα )</label>
		<input name="foreas1" id="foreas1" type="text" size="20" class="input-block-level">
<br/>
        <label for="regname">Eιδικoτητα</label>
        <input name="idikotita" id="regidikotita" type="text" class="input-block-level"><span id="regidikotitaInfo"></span><br/>

		<label for="regpass1">Κωδικος χρηστη (*)</label>
		<input name="regpass1" id="regpass1" type="password" size="20" class="input-block-level"><span id="regpass1Info"></span><br/>
		<label for="regpass2">Κωδικος χρηστη - ξανα (*)</label>
		<input name="regpass2" id="regpass2" type="password" size="20" class="input-block-level"><span id="regpass2Info"></span><br/>
		<br/>
<?php
require_once('recaptchalib.php');
$publickey = "6LfZFOcSAAAAAECZPSPNxKVLOIHcLa4SLY4hsFpG";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
echo recaptcha_get_html($publickey);
?>
	<br/>
		
                	<button id="login-button" name="login-button" class="btn btn-primary btn-block" type="submit">ΔΗΜΙΟΥΡΓΙΑ</button>
           
			</fieldset>
        </form>    
       </div>
       </div>
       </div>
               
		<div style='clear:both'></div><br/>


       
	<script type="text/javascript" src="js/jquery.js"></script>
	<!-- <script type="text/javascript" src="js/val.js"></script> -->
               

  <?php 
  	include("includes/footer.php");
  ?>
