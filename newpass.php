<?php 
$newtoken = $_GET['token'];
echo $newtoken;
require_once('wp-config.php');

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
mysql_set_charset('utf8',$conn);
mysql_select_db(DB_NAME, $conn);
$newtoken=html_entity_decode($newtoken);
$query ="SELECT * FROM users WHERE _time='".$newtoken."'";
echo $query;
$result = mysql_query($query, $conn);
$num_rows = mysql_num_rows($result);
echo "$num_rows Rows\n";
$exists=1;
if ($num_rows>0) {
	$exists=1;
}

if ($exists==1){?>
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
						<input type="hidden" id="email" name="email" value="<?php echo $email;?>"/>
						<input type="hidden" id="newtoken" name="newtoken" value="<?php echo $newtoken;?>"/>
					</fieldset>

				</form>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php");?>
<?php }else{
	header('Location:resetemail-1.php?error=notoken');
	exit;
 }?>