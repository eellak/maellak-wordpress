<?php require_once('../wp-config.php'); ?>
<?php include('../includes/header.php'); ?>
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

<?php
  include("../includes/footer.php")
?>