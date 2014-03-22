<?php 

require_once('wp-config.php');

$newtoken = trim(strip_tags($_GET['token']));

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
mysql_set_charset('utf8',$conn);
mysql_select_db(DB_NAME, $conn);

$newtoken=html_entity_decode($newtoken);

$result = mysql_query("SELECT email FROM users WHERE _time='".$newtoken."'", $conn);

if (mysql_num_rows($result) < 1) {
	header('Location:resetemail-1.php?error=notoken');
	exit;
} else{ 
	$row = mysql_fetch_array($result);
	

include("includes/header.php");?>

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
						<input type="hidden" id="email" name="email" value="<?php echo $row['email'];?>"/>
						<input type="hidden" id="newtoken" name="newtoken" value="<?php echo $newtoken;?>"/>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
</div>

<?php 
	include("includes/footer.php");
 }?>