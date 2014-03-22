<?php include("includes/header.php");?>
<div class="row-fluid">&nbsp;
	<div class="span4 offset4"><h3>Ξέχασα τον κωδικό μου</h3></div>
</div>
	<div class="row-fluid login dropdown yamm-fullwidth open dropdown-toggle">
		<div class="span12">
			<div class="yamm-content">
				<div class="row-fluid">
<?php
if ($_GET["d"]==1) {
?>
<span class="email_val"></span>
<?php
}
?>
					<form  id="emailForm" action="newpass.php" class="form-horizontal span12" method="post">
						<fieldset class="form-vertical span4 offset4">
							<div class="control-group">
							<label> Προσοχή η ενέργεια αυτή ισχύει μόνο για τοπικούς χρήστες. Σε περίπτωση που χρησιμοποιείτε τον ακαδημαϊκό σας λογαριασμό για την σύνδεση σας στις Μονάδες Αριστείας, ΔΕΝ μπορείτε να αλλάξετε τον κωδικό σας aπό εδώ . Πρέπει να επικοινωνήσετε με τους υπεύθυνους του Φορέα σας!! </label>
							</div>
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

					</form>
				</div><!-- row-fluid" -->
			</div><!-- yamm-content -->
		</div><!--span12  -->
		</div><!-- row-fluid login dropdown yamm-fullwidth open dropdown-toggle -->

<?php include("includes/footer.php");?>
