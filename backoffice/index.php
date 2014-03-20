<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>Ellak - aristeia</title>
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





    <link href="http://snf-131326.vm.okeanos.grnet.gr/maellak/maeelak/wp-content/themes/ma_ellak/css/main.css" rel="stylesheet">
    <link href="http://snf-131326.vm.okeanos.grnet.gr/maellak/maeelak/wp-content/themes/ma_ellak/css/datepicker.css" rel="stylesheet">

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

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-57-precomposed.png">
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
        <li><a href="http://snf-131326.vm.okeanos.grnet.gr/maellak/maeelak/">MONAΔΕΣ ΑΡΙΣΤΕΙΑΣ</a></li>
        </ul>
        <ul class="nav pull-right">
        <li class="icn"><a href="#"><i class="icon-twitter-sign"></i></a></li>
        <li class="icn"><a href="#"><i class="icon-facebook-sign"></i></a></li>
        <li class="icn"><a href="#"><i class="icon-rss"></i></a></li>
        </ul>

    </div><!--home-->
        </div>
    <div id="main1" class="main1">
      <div class="container" style="height:auto;padding-top:80px;">

<!--
	</head>
	<body id="dt_example">
		<div id="container">
-->
			<div id="demo">










<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>Όνομα</th>
			<th>Username</th>
			<th>LastUpdate</th>
			<th>Status</th>
			<th>IP</th>
		</tr>
	</thead>
	<tbody>
<?php
$con = mysql_connect('localhost', 'root', 'Takis');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("users", $con);
mysql_query("set names 'utf8';");
$qqq = "select * from users;";
$qry = mysql_query($qqq);

$qryc = mysql_query("select count(*) from users;");
$rowc = mysql_fetch_array($qryc);

while($row = mysql_fetch_array($qry)){
	$status = "Enable";
	if ($row['_status']==1)
        	$status='<b>Disable</b>';
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
			

<?php
        include("../includes/footer.php")
?>

			
		</div>
	</body>
</html>
