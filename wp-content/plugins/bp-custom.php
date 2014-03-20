<?php

function bbg_record_my_custom_post_type_posts( $post_types ) {
	global  $ma_ellak_content_types; 
	return $ma_ellak_content_types;
}
add_filter( 'bp_blogs_record_post_post_types', 'bbg_record_my_custom_post_type_posts' );

// Failed to work: http://blog.maximusbusiness.com/2013/06/buddypress-profile-custom-bp-menu/

?>