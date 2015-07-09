<?php
/*
Plugin Name: WP Announce
Plugin URI:  http://wordpress.org/extend/plugins/wp-announce
Description: Clean and neat announcement popup plugin for users to view when they visit your site. You can set who sees the announcement and when to display it. You can set a background image , specify the dimension of your pop up window and even set in seconds when the pop up should appear. This can be used for timed announcements, adverts or reminders.
Author: Sprint Experts Team
Version: 3.0.0
Author URI: https://www.sprintexperts.com
License: GPLv2 or later
*/

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' );
}
    
require_once ('src/wp-announce.php');