<?php include("includes/header.php");?>
<div class="row-fluid">&nbsp;
	<div class="span4 offset4"><h3>Ξέχασα τον κωδικό μου</h3></div>
</div>
<div class="row-fluid login dropdown yamm-fullwidth open dropdown-toggle">
	<div class="span12">
		<div class="yamm-content">
			<div class="row-fluid">
				<form action="resetemail-2.php" class="form-horizontal span12" method="post">
					<fieldset class="form-vertical span4 offset4">
						<div class="control-group">
							<label class="control-label span12" for="login-password">PASSWORD #1</label>
							<div class="controls">
							<input class="input-block-level" name="pass">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label span12" for="login-password">PASSWORD #2</label>
							<div class="controls">
							<input class="input-block-level" name="pass">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label span12" for="login-button"></label>
							<div class="control">
							<button id="login-button" name="login-button" class="btn btn-primary btn-block" type="submit"> ΑΛΛΑΓΗ ΚΩΔΙΚΟΥ ( PASSWORD )</button>
							</div>
						</div>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
</div>
<?php include("includes/footer.php");?>
