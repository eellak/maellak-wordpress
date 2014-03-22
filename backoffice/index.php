<?php require_once('../wp-config.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ΜΟΝΑΔΕΣ ΑΡΙΣΤΕΙΑΣ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic&amp;subset=latin,greek-ext,greek' rel='stylesheet' type='text/css'>

    <link href="wp-content/themes/ma_ellak/css/main.css" rel="stylesheet">
    <link href="wp-content/themes/ma_ellak/css/datepicker.css" rel="stylesheet">

		<style type="text/css" title="currentStyle">
			@import "js/demo_page.css";
			@import "js/demo_table.css";
		</style>


		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.validate.min.js"></script>
		<script type="text/javascript" language="javascript" src="js/validateforms.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>

    <style>
		.main1{background: #00C697;}
		label {color:white;}
		.btn {padding: 4px 10px 4px;font-weight: normal; }
		login .btn-link {
		padding: 0;
		text-align: left;
		border-color: transparent;
		cursor: pointer;
		color: #FAED4B;
		}
		h3{color:white;}
		.main .btn-link, .main .btn-link:active, .main .btn-link[disabled],
		.main .btn-link,
		a.btn , .btn-link, .dropdown.login .btn-link:active, .login .btn-link[disabled] {
		background-color: none !important;
		background-image: none !important;
		}
		.error{color:#C0392B;display:inline-block;padding:5px;}
		input.error{border: 2px solid #C0392B; }
		p {color:white;}
		.footer p {color:#333333;}
		.icon-twitter-sign:before{content:"\f081";}
		.icon-facebook-sign:before{content:"\f082";}
    </style>
	
	<style type="text/css" title="currentStyle">
		@import "dow/data/media/css/demo_page.css";
		@import "dow/data/media/css/demo_table.css";
	</style>
	<script type="text/javascript" charset="utf-8">
		/* Define two custom functions (asc and desc) for string sorting */
		jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
			return ((x < y) ? -1 : ((x > y) ?  1 : 0));
		};
		
		jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
			return ((x < y) ?  1 : ((x > y) ? -1 : 0));
		};
		
		$(document).ready(function() {
			/* Build the DataTable with third column using our custom sort functions */
			$('#example').dataTable( {
				"aaSorting": [ [0,'asc'], [1,'asc'] ],
				"aoColumnDefs": [
					{ "sType": 'string-case', "aTargets": [ 2 ] }
				]
			} );
		} );
	</script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="wp-content/themes/ma_ellak/images/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="wp-content/themes/ma_ellak/images/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="wp-content/themes/ma_ellak/images/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="wp-content/themes/ma_ellak/images/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="wp-content/themes/ma_ellak/images/apple-touch-icon-57-precomposed.png">
  </head>

  <body class="home">
    <div class="yamm navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <ul class="nav">
        <li>&nbsp;</li>
        <li><a href="http://ma.ellak.gr/">MONAΔΕΣ ΑΡΙΣΤΕΙΑΣ</a></li>
        </ul>
        <ul class="nav pull-right">
          <li class="icn"><a target="_blank" href="http://www.facebook.com/ma.elllak">
          	<i class="icon-facebook-sign"></i></a></li>
          	<li class="icn"><a target="_blank" href="http://www.twitter.com/ma_ellak"><i class="icon-twitter-sign"></i></a></li>
          	<li class="icn"><a href="http://ma.ellak.gr/listfeeds/"><i class="icon-rss"></i></a></li>            
			           </ul>
       
    </div><!--home-->
	</div>
    <div id="main1" class="main1">
      <div class="container">
		
<div id="demo">

<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Όνομα</th>
			<th>Username</th>
			<th>Last Update</th>
			<th>Status</th>
			<th>IP</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		if (!$con)
		{
		die('Could not connect: ' . mysql_error());
		}
		mysql_select_db(DB_NAME, $con);
		mysql_query("set names 'utf8';");
		$qqq = "select * from users;";
		$qry = mysql_query($qqq);

		$qryc = mysql_query("select count(*) from users;");
		$rowc = mysql_fetch_array($qryc);

		while($row = mysql_fetch_array($qry)){
		$status = "Enabled";
		if ($row['_status']==1)
				$status='<b>Disabled</b>';
		?>
		<tr class="gradeA">
			<td><?php echo $row['eponimo']." ".$row['onoma']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row["_time"]; ?></td>
			<td class="center"><a href='ch_status.php?id=<?php echo $row['username']; ?>'><?php echo $status; ?></a></td>
			<td class="center"><?php echo $row["_ip"]; ?></td>
		</tr>
<?php
}
?>
	</tbody>
	<tfoot>
		<tr>
			<th>Όνομα</th>
			<th>Username</th>
			<th>LastUpdate</th>
			<th>Status</th>
			<th>IP</th>
		</tr>
	</tfoot>
</table>
			</div>
			<div class="spacer"></div>
 </div><!--container-->
 </div><!main1-->
    <div class="footer">
      <div class="container">
        <div class="row-fluid logos relative">
         <div id="theI"></div>
          <div class="cols clearfix">
            <div class="sponsor col span4 espa">
                <a href="#"><img src="/wp-content/themes/ma_ellak/images/logo-espa.png" alt="" width="347" height="51" /></a>
            </div>
            <div class="sponsor col span2 grnet bordered">
                <a href="https://www.grnet.gr/"><img src="/wp-content/themes/ma_ellak/images/logo-grnet.png" alt="" width="89" height="43" /></a>
            </div>
            <div class="sponsor col span2 ministryofeducation bordered">
                <a href="http://www.minedu.gov.gr/"><img src="/wp-content/themes/ma_ellak/images/logo-ministryofeducation.png" alt="" width="171" height="31" /></a>
            </div>
            <div class="colophon col span4 gray bordered">
                <p>Η <strong><u>Διαδικτυακή Πύλη των Μονάδων Αριστείας</u></strong> είναι υπο-έργο της πράξης <strong><u>"Ηλεκτρονικές Υπηρεσίες για την Ανάπτυξη και Διάδοση του Ανοιχτού Λογισμικού"</u></strong> που υλοποιείται από το Εθνικό Δίκτυο Έρευνας και Τεχνολογίας. Η πράξη εντάσσεται στο Επιχειρησιακό Πρόγραμμα <strong><u>"Ψηφιακή Σύγκλιση" του ΕΣΠΑ</u></strong> (με τη συγχρηματοδότηση της Ελλάδας και της Ευρωπαϊκής Ένωσης - Ευρωπαϊκό Ταμείο Περιφερειακής Ανάπτυξης).</p>
            </div>
          </div>
        </div>
        <div class="row-fluid bottomline">
          <div class="licence pull-left">
            <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a>
          </div>
          <div class="pull-left">
            <ul class="inline">
              <li class="theYear"><strong><?php echo date('Y'); ?></strong></li>
              <li>ΥΠΛΟΠΟΙΗΘΗΚΕ ΜΕ ΤΗ ΧΡΗΣΗ ΤΟΥ <a href="http://www.ellak.gr" class="underlined">ΕΛ/ΛΑΚ</a> ΛΟΓΙΣΜΙΚΟΥ <a href="http://el.wordpress.org/" class="underlined">WORDPRESS</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-1.10.2.min.js"></script>
  </body>
</html>
