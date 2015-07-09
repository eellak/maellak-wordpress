<?php

if ( !function_exists( 'add_action' ) )
   {
    header( 'HTTP/0.9 403 Forbidden' );
    header( 'HTTP/1.0 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    header( 'Status: 403 Forbidden' );
    header( 'Connection: Close' );
    exit();
  }

define( 'PLUGIN_NAME', 'WP Announce');
define( 'WPA_FILE', __FILE__ );
if ( !defined( 'WPA_UPLOAD' ) ){
  define( 'WPA_PLUGIN_URL', plugin_dir_url( __FILE__ ) );}
if ( !defined( 'WPA_PATH' ) ){
  define( 'WPA_PATH', plugin_dir_path( __FILE__ ) );}
if ( !defined( 'WPA_BASENAME' ) ){
  define( 'WPA_BASENAME', plugin_basename( __FILE__ ) );}
   
function wpann_option_init(){
  set_all_page_post_options();
  }
add_action("init","wpann_option_init");



function wpann_check_if_post_existed($post_type){
  global $wpdb;
  $s = "select * from ".$wpdb->prefix."posts where post_type='$post_type' AND post_status='publish'";
  $r = $wpdb->get_results($s);    
  if(count($r) > 0) return true;
    return false;   
  }

function wpa_insert_post($page_ids, $page_title, $page_tag, $parent_pg = 0, $post_type = "post" ){
           
  $post = array(
  'post_title'       => $page_title, 
  'post_content'     => $page_tag, 
  'post_status'      => 'publish', 
  'post_type'        => $post_type,
  'post_author'      => 1,
  'ping_status'      => 'closed', 
  'post_parent'      => $parent_pg,
  'comment_status'   => 'closed'
  );
  $post_id =   wp_insert_post($post);
  return $post_id;
}
                
            //update_post_meta($post_id, '_wp_page_template', 'project-special-page-template.php');
            //update_option($page_ids, $post_id);

function wpa_setup_options($post_id){

  $wpa_Options = array();
  $wpa_Options["wpa_style_header_option"]     = "background-color:#3B5998; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; padding:10px; font-size:20px; color:#eee;";    
  $wpa_Options["wpa_style_body_option"]       = "padding:2px; color:#3B5998; font-size:14px;"; 
  $wpa_Options["wpa_bgcolor"]                 = "#eeeeee";
  $wpa_Options["wpa_test_cookie"]             = "disabled";

  $wpa_Options["wpa_width"]       = "600"; 
  $wpa_Options["wpa_height"]      = "300"; 
  $wpa_Options["wpa_delay"]       = 1;

  update_option("wpa_options",$wpa_Options);
  update_option("wpa_post_id",$post_id); 
            

  update_post_meta( $post_id, 'wpa_access', 'all' );
  update_post_meta( $post_id, 'wpa_frequency', 'once' );
  update_post_meta( $post_id, 'wpa_status', 'active' );
  update_post_meta( $post_id, 'wpa_header_style', $wpa_Options["wpa_style_header_option"] );
  update_post_meta( $post_id, 'wpa_body_style', $wpa_Options["wpa_style_body_option"] ); 
}

//register_activation_hook( __FILE__ , 'wpa_option_init' );

function set_all_page_post_options(){
  
  if(!wpann_check_if_post_existed('announce')){
    $wpa_post_id = wpa_insert_post('wpa_post_id', 'Announcement Example', 'Welcome to SprintExperts.com', 0, 'announce');
    wpa_setup_options($wpa_post_id);
  }   
}



function wpa_admin(){
      //add_submenu_page('edit.php?post_type=announce', 'Help and FAQ', 'Help and FAQ', 'edit_posts', basename(__FILE__), 'wpa_option_page');
     //add_options_page('WP Announce Options', 'WP Announce','announce', __FILE__, 'wpa_options_page');
    } 
//add_action('admin_menu', 'wpa_admin', 10, 1); 

function wpa_option_page(){  ?>
    <div class="wrap">
      <?php screen_icon(); ?>    
      <h2><?php _e(PLUGIN_NAME); ?></h2>
      <?php //print_r($wpfuploads); ?>
      <style>
          td p {color:#999;}
      </style>
      <div id="poststuff">
        <div id="post-body">
          <div class="postbox">
               <h3><label for="title">Help and FAQ</label></h3>
               <div class="inside"></div>
          </div>
        </div>
      </div>
    </div>
<?php   } 



function wpa_create_post_type() {

    $icn = plugins_url('wp-announce/src/images/announce-icon.png');
    
    register_post_type( 'announce',
    array(
    'labels' => array(
    'name'      => __( 'Announcements',      '' ),
    'singular_name' => __( 'Announcement',     '' ),
    'add_new'     => __('Add Announcement',  ''),
    'new_item'    => __('New Announcement',    ''),
    'edit_item'   => __('Edit Announcement',   ''),
    'add_new_item'  => __('Add Announcement',  ''),
    'search_items'  => __('Search Announcements',  '')
    ),
    'public' => true,
    'has_archive' => 'announce-list',
    'menu_position' => 5,
    'register_meta_box_cb' => 'wpann_set_metaboxes',
    'has_archive' => "project-list",
    'rewrite' => array('slug'=> "announce",'with_front'=>false), 
    'supports' => array('title','editor','thumbnail'),
        //'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
    '_builtin' => false,
    'menu_icon' => $icn,
    'publicly_queryable' => true,
    'hierarchical' => false 

    )
  );
 
}


function wpann_set_metaboxes()
{ 
    add_meta_box( 'wpa_announce',  'Announcement Setting',  'wpa_metabox_announce_setting', 'announce', 'normal','high' ); 
    add_meta_box( 'wpa_announce_banner',  'Next Update',  'wpann_metabox_announce_banner', 'announce', 'side','low' );
}


function wpann_metabox_announce_banner()
{
  global $post, $wpdb;
    $pid = $post->ID; 
?>
    <table width="100%">
    <input type="hidden" value="1" name="fromadmin" />
 <script>
    $ = jQuery;  
      $(document).bind('ready',function(){
      var hh = $('#postimagediv .inside ').html();
      var addMsg = 'Choosing a featured image will create a background for your announcement';
       $('#postimagediv .inside ').html(hh + addMsg);    

      }) 
    </script> 
<tr>
<td>
  

  <?php
  echo file_get_contents('http://www.sprintexperts.com/wp-plugins/wp-announce/frame/');
  ?> 
    
     </td>
 </tr></table>
    <?php 
}

function wpann_admin_preview() {
?>
<script type="text/javascript" >
  function wpann_pop_announcement(url, w, h){
      $.colorbox({href:url, innerWidth:w, innerHeight:h });
    }

    var $ = jQuery;
    $(document).bind('ready',function(){      

    });
</script>
<?php
}
add_action( 'admin_footer', 'wpann_admin_preview' );


function wpa_metabox_announce_setting($post)
{
   wp_nonce_field( 'wpa_metabox_announce_setting', 'wpa_metabox_announce_setting_nonce' );
   

   $option_post_id = get_option('wpa_post_id');
   $wpa_Options = get_option('wpa_options');


   $wpa_frequency = get_post_meta( $post->ID, 'wpa_frequency', true );
   $wpa_access = get_post_meta( $post->ID, 'wpa_access', true );



   $wpa_width  = (get_post_meta( $post->ID, 'wpa_width', true )== "") ? $wpa_Options["wpa_width"] : get_post_meta( $post->ID, 'wpa_width', true );
   $wpa_height = (get_post_meta( $post->ID, 'wpa_height', true ) == "") ? $wpa_Options["wpa_height"] : get_post_meta( $post->ID, 'wpa_height', true );
   $wpa_delay  = (get_post_meta( $post->ID, 'wpa_delay', true ) == "") ? $wpa_Options["wpa_delay"] : get_post_meta( $post->ID, 'wpa_delay', true );

  $wpa_header_style = (get_post_meta( $post->ID, 'wpa_header_style', true )== "") ? $wpa_Options["wpa_style_header_option"] : get_post_meta( $post->ID, 'wpa_header_style', true );
  $wpa_body_style  = (get_post_meta( $post->ID, 'wpa_body_style', true ) == "") ? $wpa_Options["wpa_style_body_option"] : get_post_meta( $post->ID, 'wpa_body_style', true );
  $wpa_bgcolor  = (get_post_meta( $post->ID, 'wpa_bgcolor', true ) == "") ? $wpa_Options["wpa_bgcolor"] : get_post_meta( $post->ID, 'wpa_bgcolor', true );
  $wpa_test_cookie  = (get_post_meta( $post->ID, 'wpa_test_cookie', true ) == "") ? $wpa_Options["wpa_test_cookie"] : get_post_meta( $post->ID, 'wpa_test_cookie', true );

   if($option_post_id ==  $post->ID) {$wpa_status = "active"; }else{ $wpa_status = "inactive";}

   $wpa_option_header = $wpa_Options["wpa_style_header_option"];
   $wpa_option_body = $wpa_Options["wpa_style_body_option"];

   $wpa_test_cookie = get_post_meta( $post->ID, 'wpa_test_cookie', true );

    $url = plugins_url( 'wp-announce/src/wp-announce-ajax.php'); 
    $wpa_post_id = get_option('wpa_post_id');
    $alert_active = "Note: only One announcement campaign can be active at anyone time. Setting an announcement to active will activate others.";
    ?>
    <table width="100%" cellpadding=2 cellspacing=2>
    <input type="hidden" value="1" name="fromadmin" />

   <script>
    $ = jQuery;  
      $(document).bind('ready',function(){
       $('#wpa_default_style').click( function () { 
        var defaultOption_header = '<?php echo $wpa_option_header ?>';
        var defaultOption_body = '<?php echo $wpa_option_body ?>';
        var defaultOption_bgcolor = '<?php echo $wpa_bgcolor ?>';
        var sure = confirm("Are you sure, this will overwrite any changes you have done earlier.");         
          if(sure){
          $('#wpa_header_style').val(defaultOption_header);
          $('#wpa_body_style').val(defaultOption_body);
          $('#wpa_bgcolor').val(defaultOption_bgcolor);

          }else{return false;}
        });
       }) 
 </script>  



  <?php

          echo '<tr>';
          echo '<td width=33%>';
          echo '<label for="wpa_access">';
           _e( "Who can see it", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<select id='wpa_access' name='wpa_access' style='width:100%'>
          <option value='all' ".isSelected('all',$wpa_access)." >All Users</option>
          <option value='registered' ".isSelected('registered', $wpa_access).">Registered Users</option>
          <option value='visitors' ".isSelected('visitors', $wpa_access).">Visitors Only</option>
          </select>
          </td>";
          
          echo '<td width=33%>';
          echo '<label for="wpa_frequency">';
           _e( "How often to show announcement", 'wp_announce_textdomain' );
          echo '</label> ';

          echo "<select style='width:100%'  id='wpa_frequency'   name='wpa_frequency'>
          <option value='once'".isSelected('once',$wpa_frequency).">Only Once</option>
          <option value='everyday' ".isSelected('everyday',$wpa_frequency)." disabled=disabled>Every Day</option>
          <option value='everyweek' ".isSelected('everyweek',$wpa_frequency)."  disabled=disabled>Every Week</option></select>";

          echo '</td>';

          echo '<td width=33%>';

          echo '<label for="wpa_status">';
           _e( "Set Status", 'wp_announce_textdomain' );
          // echo '<span style="cursor:pointer" onclick=javascript:alert("'. $alert_active .'")> Help</span>';
          echo '</label> ';
          echo "<select style='width:100%' id='wpa_status' name='wpa_status'>";
          echo "<option value='active' ".isSelected('active',$wpa_status)." >Active</option>";
          echo "<option value='' ".isSelected('inactive',$wpa_status)." >Inactive</option></select>";

          echo '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td   colspan="3" height=20>';
          echo '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td width=33%>';

          echo '<label for="wpa_width">';
           _e( "Popup Width (px)", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<input type='number' class='range' name='wpa_width' min='200' max='1000'  value='$wpa_width'>";
          echo '</td>';
          
          echo '<td width=33%>';
          echo '<label for="wpa_height">';
           _e( "Popup Height (px)", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<input type='number' class='range' name='wpa_height' min='100' max='800' value='$wpa_height' />";
          echo '</td>';

          echo '<td width=33%>';
          echo '<label for="wpa_delay">';
           _e( "Launch after (Sec): ", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<input type='number'  class='range' name='wpa_delay' min='0' max='60' value='$wpa_delay' />";
          echo '</td>';

          echo '</tr>';

          echo '<tr>';
          echo '<td   colspan="3" height=20>';
          echo '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td width=33%>';

          echo '<label for="wpa_width">';
           _e( "Background (Hex Value)", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<input type='text' class='range' name='wpa_bgcolor' id='wpa_bgcolor'   value='$wpa_bgcolor'>";
         // echo "<input type='text' value='#eeeeee' class='wp-color-picker-field' data-default-color='#ffffff' />";
          echo '</td>';
          
          echo '<td width=33%>';
          echo '<label for="wpa_height">';
           _e( "Cookie Tracking(Disable while testing)", 'wp_announce_textdomain' );
          echo '</label> ';
          echo "<select style='width:100%' id='wpa_test_cookie' name='wpa_test_cookie'>";
          echo "<option value='enable' ".isSelected('enabled',$wpa_test_cookie)." >Enable</option>";
          echo "<option value='disabled' ".isSelected('disabled',$wpa_test_cookie)." >Disabled</option></select>";
          echo '</td>';

          echo '<td width=33%>';

          echo '</td>';

          echo '</tr>';


          echo '<tr>';
          echo '<td   colspan="3" height=20>';
          echo '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td   colspan="3">
          <label for="wpa_header_style">Title Style</label>
           <textarea name="wpa_header_style" id="wpa_header_style" style="width:100%;height:60px;font-size:12px;color:#999;margin-top:5px">'.$wpa_header_style.'</textarea>

            <label for="wpa_body_style">Content Style</label>
           <textarea name="wpa_body_style"  id="wpa_body_style"  style="width:100%;height:60px;font-size:12px;color:#999;margin-top:5px">'.$wpa_body_style.'</textarea>
                </td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td colspan="3" style="text-align:right;height:30px"><hr />';

          if($post->ID){           
           } ?>
<script>
function wpa_set_cookie(c_name,value,exhours)
{
  var exdate=new Date();
  exdate.setTime(exdate.getTime() + (exhours * 3600 * 1000));
  var c_value=escape(value) + ((exhours==null) ? "" : "; expires="+exdate.toUTCString());
  document.cookie=c_name + "=" + c_value + "; path=/";
}

function wpa_getCookie(cname)
{
var name = cname + "=";
var ca = document.cookie.split('|');
for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
     if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
return "";
}


function wpa_set_cookie_set(c_name,value,exhours)
{
    var check = confirm('This will reset your cookie so the popup can be viewed again. \n\nNOTE\nDisable Tracking so you can refresh and test your popup aon the front end. Do not forget to enable it once you ready to go live');
   if(check){wpa_set_cookie(c_name,value,exhours);}
}

</script>

  <?php  $wpa_url = get_bloginfo('url') . "?p=" . $post->ID . "&wpa_c=no"; ?>
  <!--&nbsp;&nbsp;<span class="preview button" onclick="javascript:wpann_pop_announcement('<?php echo $wpa_url ?>', '<?php echo $wpa_width ?>', '<?php echo $wpa_height ?>');"  id="wpa_preview_pop" style="height:30px;line-height:30px">Preview</span>&nbsp;&nbsp;-->
  &nbsp;&nbsp;<a class="preview button" onclick="javascript:wpa_set_cookie_set('wpa_<?php echo $post->ID ?>', '<?php echo $post->ID ?>', '-100');"  id="wpa_default_reset" style="height:30px;line-height:30px">Reset Visibility</a>&nbsp;&nbsp; 
  &nbsp;&nbsp;<a class="preview button"  id="wpa_default_style" style="height:30px;line-height:30px">Load Default Style</a>&nbsp;&nbsp; 
  &nbsp;&nbsp;<input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Update">&nbsp;&nbsp;
  <?php //} ?>
  <?php
          echo '</td>';
          echo '</tr>';
  
  ?>     
    </table>

  <script>
    //$(":range").rangeinput(); 
        $(document).bind('ready',function(){
      // // $('#preview-action a').attr('style', 'display:none'); 
      //  $('#wpseo_meta').attr('style', 'display:none'); //hide seo      
      //  $("#preview-action").append("<span class='preview button'>Preview Changes</span>");
      //  $('#preview-action span').attr('onclick', "wpann_pop_announcement('<?php echo $wpa_url ?>', '<?php echo $wpa_width ?>', '<?php echo $wpa_height ?>')"); 
       }) ;

  </script>


    <?php 
}

function wpa_save_postdata( $post_id ) {


  // Check if our nonce is set.
  if ( ! isset( $_POST['wpa_metabox_announce_setting_nonce'] ) )
    return $post_id;

  $nonce = $_POST['wpa_metabox_announce_setting_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'wpa_metabox_announce_setting' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */
  // Sanitize user input.
  $wpa_access = sanitize_text_field( $_POST['wpa_access'] );
  $wpa_frequency = sanitize_text_field( $_POST['wpa_frequency'] );
  $wpa_status = sanitize_text_field( $_POST['wpa_status'] );
  $wpa_header_style = sanitize_text_field( $_POST['wpa_header_style'] );
  $wpa_body_style = sanitize_text_field( $_POST['wpa_body_style'] );

  $wpa_delay = sanitize_text_field( $_POST['wpa_delay'] );
  $wpa_height = sanitize_text_field( $_POST['wpa_height'] );
  $wpa_width = sanitize_text_field( $_POST['wpa_width'] );
  $wpa_bgcolor = sanitize_text_field( $_POST['wpa_bgcolor'] );
  $wpa_test_cookie = sanitize_text_field( $_POST['wpa_test_cookie'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, 'wpa_access', $wpa_access );
  update_post_meta( $post_id, 'wpa_frequency', $wpa_frequency );
  if( $wpa_status != ''){
     update_post_meta( $post_id, 'wpa_status', $wpa_status );
  }
  update_post_meta( $post_id, 'wpa_header_style', $wpa_header_style );
  update_post_meta( $post_id, 'wpa_body_style', $wpa_body_style );

  update_post_meta( $post_id, 'wpa_width', $wpa_width );
  update_post_meta( $post_id, 'wpa_height', $wpa_height );
  update_post_meta( $post_id, 'wpa_delay', $wpa_delay );
  update_post_meta( $post_id, 'wpa_bgcolor', $wpa_bgcolor );
  update_post_meta( $post_id, 'wpa_test_cookie', $wpa_test_cookie );

  //Now set an announcement to be active
  if($wpa_status == "active"){
  update_option("wpa_post_id", $post_id);
  }

}
add_action( 'save_post', 'wpa_save_postdata');

function isSelected($a, $b){
  if($b == $a){
    return 'selected="selected"';
  }
}

add_action('wp_footer', 'wpa_announce_js');
function wpa_announce_js($post_id) {

   $wpa_page_id = get_option('wpa_page_id');
   $wpa_post_id = get_option('wpa_post_id');
   $url = get_bloginfo('url'); 
   //Preview state
   if($_REQUEST['preview'] != "" || $_REQUEST['preview_id'] != ""){
    $hide_cookie = "&wpa_c=no";
  }


  if ( get_post_status ( $wpa_post_id ) == 'publish' ) {
    
   if($wpa_post_id != ""){

      $wpa_Options = get_option('wpa_options');

     $wpa_width  = (get_post_meta($wpa_post_id, 'wpa_width', true )== "") ? $wpa_Options["wpa_width"] : get_post_meta( $wpa_post_id, 'wpa_width', true );
     $wpa_height = (get_post_meta($wpa_post_id, 'wpa_height', true ) == "") ? $wpa_Options["wpa_height"] : get_post_meta( $wpa_post_id, 'wpa_height', true );
     $wpa_delay  = (get_post_meta($wpa_post_id, 'wpa_delay', true ) == "") ? $wpa_Options["wpa_delay"] : get_post_meta( $wpa_post_id, 'wpa_delay', true );
     $wpa_bgcolor  = (get_post_meta($wpa_post_id, 'wpa_bgcolor', true ) == "") ? $wpa_Options["wpa_bgcolor"] : get_post_meta( $wpa_post_id, 'wpa_bgcolor', true );



     // $wpa_header_style  = get_post_meta($wpa_post_id, 'wpa_header_style', true);
     // $wpa_body_style  = get_post_meta($wpa_post_id, 'wpa_body_style', true);
     $wpa_thumbnail_id  = get_post_meta($wpa_post_id, '_thumbnail_id', true);
     $wpa_thumbnail  = get_post_meta($wpa_thumbnail_id, '_wp_attached_file', true);
     $upload_dir = wp_upload_dir();
     $wpa_bg  = $upload_dir['baseurl'] ."/". $wpa_thumbnail;

     // if($wpa_header_style == ""){
     //    $wpa_Options = get_option('wpa_options');
     //    $wpa_header_style = $wpa_Options["wpa_style_body_option"];}
     // if($wpa_body_style == ""){
     $wpa_body_style = $wpa_Options["wpa_bg_color"];
     if($wpa_thumbnail_id != ""){
        $wpa_bg_style = "background:url(" . $wpa_bg . ") center center no-repeat !important; background-size:100% !important";
       }else{$wpa_bg_style = "background:". $wpa_bgcolor . ";";}




$pop_win = 
"<style>
  .overlay-content {
     $wpa_bg_style;
  }
</style>
<script>
$ = jQuery;
$(document).ready(function(){
  //$(document).bind('ready',function(){
    $('#close_div').click(function(){
        $('.overlay-bg').hide(); // hide the overlay
    });
 
    $('.overlay-bg').click(function(){
        $('.overlay-bg').hide();
    })
    $('.overlay-content').click(function(){
        return false;
    });
   if( document.cookie.indexOf('wpa_$wpa_post_id') == -1 ){   
   setTimeout(function(){ // disable normal link function so that it doesn't refresh the page
        var docHeight = $(document).height(); //grab the height of the page
        var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
        $('.overlay-bg').fadeIn('slow').css({'height' : docHeight}); //display your popup and set height to the page height
        $('.overlay-content').css({'top': scrollTop+100+'px'})}, 1000 * $wpa_delay );
   }
 
});
</script>";

$wpa_width_a = ($wpa_width + 30) . 'px';
$close_right = ($wpa_width ) . 'px';

$pop_win .= "
<div class='overlay-bg'>
  <div class='overlay-content' style='width:$wpa_width_a;'>
  <div id='close_div'style='top:-5px;left:$close_right'></div>
    <iframe src='$url?p=$wpa_post_id$hide_cookie' height=$wpa_height width=$wpa_width frameborder=0 border=0></iframe>
  </div>
</div>";


     if(get_post_meta($wpa_post_id, 'wpa_access', true) == "registered"){

         if(is_user_logged_in()){
          //if cookie fail set usermeta
        echo $pop_win;
        } 

  } else if(get_post_meta($wpa_post_id, 'wpa_access', true) == "visitors"){
        //set and check cookie
        if(!is_user_logged_in()){
        echo $pop_win;
         }
 
 } else if(get_post_meta($wpa_post_id, 'wpa_access', true) == "all" || 
           get_post_meta($wpa_post_id, 'wpa_access', true) == "" ){
          //get set cookie
        echo $pop_win;;

     }

   }
 }

}

function wpann_wp_enqueue() {      
  // wp_register_style('wpann-colorbox-css', plugins_url('wp-announce/src/css/colorbox/colorbox.css'));
  // wp_register_script('wpann-colorbox-js', plugins_url('wp-announce/src/js/colorbox/jquery.colorbox-min.js'),array('jquery'));
  //wp_enqueue_style('wpann-colorbox-css');
  //wp_enqueue_script('wpann-colorbox-js');

  //wp_register_script('wpa-custom-js', plugins_url('wp-announce/src/js/custom.js'),array('jquery'));
  wp_register_style('wpa-custom-css', plugins_url('wp-announce/src/css/custom.css'));
  wp_enqueue_style('wpa-custom-css');
  //wp_enqueue_script('wpa-custom-js');



}
add_action('wp_enqueue_scripts', 'wpann_wp_enqueue');
   // ADD NEW COLUMN
function dwa_columns_head_frequency($defaults) {
    //unset($defaults['dwa_column_frequency']);
    $defaults['dwa_column_frequency'] = 'Frequency';
    $defaults['dwa_column_access'] = 'Access';
    $defaults['dwa_column_status'] = 'Status';
    return $defaults;
}
 
function dwa_columns_content_frequency($column_name, $post_ID) {
    if ($column_name == 'dwa_column_frequency') {
           $wpa_frequency = get_post_meta( $post_ID, 'wpa_frequency', true );
           echo $wpa_frequency;
    }

    if ($column_name == 'dwa_column_access') {
           $wpa_access = get_post_meta( $post_ID, 'wpa_access', true );
           echo $wpa_access;
    }

    if ($column_name == 'dwa_column_status') {
           $wpa_status = get_post_meta( $post_ID, 'wpa_status', true );
           if($post_ID == get_option('wpa_post_id')){
           }else{
           $wpa_status = "Inactive";
           }
          echo $wpa_status;
    }



}


add_action("init","wpa_create_post_type");


if($_REQUEST['post_type'] == "announce"){
   if ( function_exists( 'add_theme_support' ) ) {
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size();   
    }
add_filter('manage_posts_columns', 'dwa_columns_head_frequency');
add_action('manage_posts_custom_column', 'dwa_columns_content_frequency', 10, 2);
}



add_filter( 'wpseo_metabox_prio', function() { return 'low';});

function wpann_template($incFile) {
  global $wp,$wp_query, $wpdb;

  if($wp->query_vars['post_type'] == 'announce'){
          $file = plugin_dir_path( __FILE__ ) . 'tpl/wpa_template.php';
         }

    if (have_posts()) {

       if (file_exists($file)) {
           $incFile = $file;
        }else {
           //$wp_query->is_404 = true;
      }
  }

  return $incFile;
}
add_filter('template_include', 'wpann_template');


function posttype_admin_css() {
     global $post_type;
     $post_types = array( 'announce');
     if(in_array($post_type, $post_types))
     echo '<style type="text/css">#post-preview, #view-post-btn{display: none;}</style>';
 }
add_action( 'admin_head-post-new.php', 'posttype_admin_css' );
add_action( 'admin_head-post.php', 'posttype_admin_css' );

function wpa_after_body(){

  $wpa_page_id = get_option('wpa_page_id');
  $wpa_post_id = get_option('wpa_post_id');
  $url = get_bloginfo('url'); 
  //Preview state
  if($_REQUEST['preview'] != "" || $_REQUEST['preview_id'] != ""){
    $hide_cookie = "&wpa_c=no";
  }

  $wpa_Options = get_option('wpa_options');
  $wpa_width  = (get_post_meta($wpa_post_id, 'wpa_width', true )== "") ? $wpa_Options["wpa_width"] : get_post_meta( $wpa_post_id, 'wpa_width', true );
  $wpa_height = (get_post_meta($wpa_post_id, 'wpa_height', true ) == "") ? $wpa_Options["wpa_height"] : get_post_meta( $wpa_post_id, 'wpa_height', true );
  $wpa_delay  = (get_post_meta($wpa_post_id, 'wpa_delay', true ) == "") ? $wpa_Options["wpa_delay"] : get_post_meta( $wpa_post_id, 'wpa_delay', true );
  
$wpa_width_a = ($wpa_width + 30) . 'px';
$close_right = ($wpa_width ) . 'px';

$data = "
<div class='overlay-bg'>
  <div class='overlay-content' style='width:$wpa_width_a;'>
  <div id='close_div'style='top:-5px;left:$close_right'></div>
    <iframe src='$url?p=$wpa_post_id$hide_cookie' height=$wpa_height width=$wpa_width frameborder=0 border=0></iframe>
  </div>
</div>";

echo  $data;

}
 function iris_cpdemo_admin_enqueue_scripts($hook) {
        // bail early if this is not the plugin option screen
        if( 'settings_page_iris-color-picker-demo/cp-demo' !== $hook ) {
            return;
        }
}

function wpann_admin_enqueue($hook) {
    //if( 'edit.php' != $hook || 'post.php' != $hook)
  // wp_register_style('wpa-slider-css', plugins_url('wp-announce/src/css/admin/slider.css'));
  // wp_enqueue_style( 'wpa-slider-css');
    wp_register_style('wpa-custom-css', plugins_url('wp-announce/src/css/custom.css'));
  wp_enqueue_style('wpa-custom-css');


}
add_action( 'admin_enqueue_scripts', 'wpann_admin_enqueue' );
add_filter( 'wpseo_use_page_analysis', '__return_false' );
?>