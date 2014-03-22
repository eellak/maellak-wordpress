<?php include("includes/header.php");?>
<div class="row-fluid">&nbsp;
	<div class="span4 offset4"><h3>Ξέχασα τον κωδικό μου</h3></div>
</div>
<div class="row-fluid login dropdown yamm-fullwidth open dropdown-toggle">
	<div class="span12">
		<div class="yamm-content">
			<div class="row-fluid">
				<form id="newpass" action="resetemail-2.php" class="form-horizontal span12" method="post">
					<fieldset class="form-vertical span4 offset4">
						<div class="control-group">
								<label class="control-label span12" for="email">ΝΕΟΣ ΚΩΔΙΚΟΣ - PASSWORD</label>
								<div class="controls">
								<input type="password" class="input-block-level required" id="password" name="password">
								</div>
							</div>

						<div class="control-group">
							<label class="control-label span12" for="login-password">ΝΕΟΣ ΚΩΔΙΚΟΣ ΞΑΝΑ - PASSWORD</label>
							<div class="controls">
								<input type="password" class="input-block-level required" id="password1" name="password1">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label span12" for="login-button"></label>
							<div class="control">
							<button id="newpass" name="newpass" class="btn btn-primary btn-block" type="submit"> ΑΛΛΑΓΗ ΚΩΔΙΚΟΥ ( PASSWORD )</button>
							</div>
						</div>
						<input type="hidden" id="email" name="email" value="<?php echo $_POST['email'];?>"/>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>
