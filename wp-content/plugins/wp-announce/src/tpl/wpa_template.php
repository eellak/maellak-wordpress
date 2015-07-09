<?php
/**
 * Template Name: WP ANNOUNCE TEMPLATE
 */
?>
<?php 

$wpa_post_id = $_REQUEST['p'];
global $wpdb, $user_ID;
$posts = get_post($wpa_post_id);
$wpa_test_cookie = get_post_meta( $post->ID, 'wpa_test_cookie', true );
$wpa_header_style  = get_post_meta($posts->ID, 'wpa_header_style', true);
$wpa_body_style  = get_post_meta($posts->ID, 'wpa_body_style', true);
$wpa_thumbnail_id  = get_post_meta($posts->ID, '_thumbnail_id', true);
$wpa_thumbnail  = get_post_meta($wpa_thumbnail_id, '_wp_attached_file', true);
$upload_dir = wp_upload_dir();
$wpa_bg  = $upload_dir['baseurl'] ."/". $wpa_thumbnail;


if($wpa_header_style == ""){
    $wpa_Options = get_option('wpa_options');
	$wpa_header_style = $wpa_Options["wpa_style_body_option"];}
if($wpa_body_style == ""){
	  $wpa_body_style = $wpa_Options["wpa_style_body_option"];}
if($wpa_thumbnail_id != ""){
	$wpa_bg_style = "background:url(" . $wpa_bg . ") center center no-repeat !important;";}else{"background:#fff";}

ob_start(); ?>
 <style>

#wpa_title{
    <?php echo $wpa_header_style ?>}
#wpa_body{
      <?php echo $wpa_body_style ?>}
#cboxContent{
	   <?php echo $wpa_bg_style ?>}
</style> 
 <?php
$wpa_style = ob_get_contents();
 ob_end_clean(); ?>

<?php echo $wpa_style ?>
<div id="wpa_title">
<?php echo $posts->post_title; ?>
</div>
<div id="wpa_body">
<?php echo 	apply_filters('the_content',$posts->post_content);?>
<?php //print_r($_REQUEST['wpa_c']); ?>
</div>

<script>

function wpa_getCookie(cname)
{
var name = cname + "=";
var ca = document.cookie.split(';');
for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
     if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
return "";
}

function wpa_set_cookie_array(c_name,value,date,exhours)
{
   //Check if cookie exist;
    var wpa_cookie         = wpa_getCookie(c_name);
    var wpa_cookie_split   = wpa_cookie.split('|');

    var wpa_post_id_x      = wpa_cookie_split[0];

    var wpa_views_x        = wpa_cookie_split[1];
    if(parseInt(wpa_views_x) < 1 ){new_wpa_views  = 1;}else{new_wpa_views  = parseInt(wpa_views_x) + 1}
    var wpa_intervals_x    = wpa_cookie_split[2];

    var wpa_json = value + "|" + String(new_wpa_views) + "|" + date;

	var exdate=new Date();
	exdate.setTime(exdate.getTime() + (exhours * 3600 * 3600));
	var wpa_value=escape(wpa_json) + ((exhours==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + wpa_value + "; path=/";
}
<?php 

if($_REQUEST['wpa_c'] == "no"){ ?> <?php }else{ 

  //if tracking is date_offset_get()

    if($wpa_test_cookie <> '' and $wpa_test_cookie <> 'disabled'){?>

          wpa_set_cookie_array("wpa_<?php echo $posts->ID ?>","<?php echo $posts->ID ?>","<?php echo date('d-m-Y'); ?>", 1000);
<?php 
     }
} 
?>
</script>
<?php 

?>