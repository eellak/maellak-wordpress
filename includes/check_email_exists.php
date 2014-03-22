<?php

require_once('../wp-config.php'); 

$lid = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die(mysql_error());
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
mysql_select_db(DB_NAME, $lid);

/* catch the post data from ajax */
$email = $_GET['regemail'];
$query = mysql_query("SELECT `email` FROM `users` WHERE `email` = '$email'");
if(mysql_num_rows($query) == 1) { // if return 1, email exist.
	echo 'false';
} else { // else not, insert to the table
	echo 'true';
}

?>