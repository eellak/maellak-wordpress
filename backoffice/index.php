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

   <style type="text/css" title="currentStyle">
		@import "dow/data/media/css/demo_page.css";
		@import "dow/data/media/css/demo_table.css";
	</style>
	<script type="text/javascript" language="javascript" src="dow/data/media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="dow/data/media/js/jquery.dataTables.js"></script>
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

    <link href="/wp-content/themes/ma_ellak/css/main.css" rel="stylesheet">
    <link href="/wp-content/themes/ma_ellak/css/datepicker.css" rel="stylesheet">

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
		.error{color:red;}
		label{text-transform:uppercase;}
		p {color:white;}
		.footer p {color:#333333;}
    </style>

    <link rel="shortcut icon" href="/wp-content/themes/ma_ellak/images/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/ma_ellak/images/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/ma_ellak/images/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/ma_ellak/images/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/wp-content/themes/ma_ellak/images/apple-touch-icon-57-precomposed.png">
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
      <div class="container" style="height:auto;padding-top:80px;padding-bottom:80px;">
		
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
			<td class="center"><a href="ch_status.php?id=<?php echo $row['username']; ?>'><?php echo $status; ?></a></td>
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

<?php
  include("../includes/footer.php")
?>
