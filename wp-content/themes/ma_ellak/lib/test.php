<?php
/*
Template Name: Event - Participation
*/

	 if (! is_user_logged_in()) // Μόνο εγγεγραμμένοι χρήστες μπορούν να είναι εδώ.
		header('Location: '.URL.''); 
	
	$cur_user = wp_get_current_user();
	
	$success = false;
	$ma_message = '';

	if(isset($_POST['ma_ellak_events_participation_submit']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {
		global $wpdb;

		if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() === true ) {
					
		$name = sanitize_text_field($_POST['namez']);
		$surname = sanitize_text_field($_POST['surnamez']);
		$email = sanitize_text_field($_POST['emailz']);
		$events_id = intval($_POST['events_id']);
		//Collect the data
		$participation = array(
				'events_id'	=> $events_id,
				'name'	=> $name,
				'surname'	=> $surname,
				'email'		=> $email,				
		);
		//print_r($participation);
		$format= array('%s','%s','%s', '%d' );
		// Καταχωρούμε τη συμμετοχή 
		$wpdb->insert( 'ma_events_participants', $participation );
		$wpdb->show_errors();
		$id = $wpdb->insert_id;
		
		if($id){
			
			$ma_message = '<p class="message">H καταχώρησή σας ήταν επιτυχής.</p>';
			$success = true;
			
			// Αποστολή email στον διαχειριστή/υπεύθυνο
			$email_message = 'Νέα συμμετοχή με όνομα: '.$name;
			// wp_mail( 'email@ma.ellak.gr', '[Λογισμικό] Νέα καταχώριση', $email_message);
		} else {
			$ma_message = '<p class="error">Παρουσιάστηκε πρόβλημα και η καταχώρησή Δεν ήταν επιτυχής.</p>';
		}
		}else 
			$ma_message = '<p class="error">Παρουσιάστηκε πρόβλημα και η καταχώρησή Δεν ήταν επιτυχής.Πρέπει να συμπληρώσετε το captcha</p>';
			
	} 

?>
<?php get_header(); 
if(isset($_GET['events_id']))
	$events_id = absint($_GET['events_id']);
else
	$events_id = absint($_POST['events_id']);
$postData =  get_post($events_id);
$custom = get_post_custom($events_id);
$event_type = $custom['_ma_events_type'][0];

?>

<div class="postWrapper" id="post-<?php the_ID(); ?>">
	<?php while ( have_posts() ) : the_post(); ?>
	<h1 class="postTitle"><?php the_title(); ?></h1>
	<?php 
		if($event_type=='event')
		echo __('για την εκδήλωση','ma-ellak').": ". $postData->post_title; 
		if($event_type=='seminar')
		echo __('για το σεμινάριο','ma-ellak').": ". $postData->post_title; 
	?>
	<?php endwhile; ?>
	<div class="post">
		<?php /*---------------------- Form ------------------------------------------*/ ?>
		<div id="ma-message"><?php echo($ma_message); ?> </div>
		<?php if($success){ } else { 
		
			$url = get_permalink(86);
			$url .="&events_id=".$events_id;
			?>
		
			<form action="<?php echo $url; ?>" method="post" id="ma_ellak_software_submit_form">
				<div class="form-group">
					<label for="namez"><?php _e('Όνομα', 'ma-ellak'); ?></label>
					<input type="text" name="namez" id="namez" class="form-control input required" value="<?php if(isset($_POST['namez'])) echo $_POST['namez'];?>" class="required" />
				</div>
				<div class="form-group">
					<label for="surnamez"><?php _e('Επώνυμο', 'ma-ellak'); ?></label>
					<input type="text" name="surnamez" id="surnamez" class="form-control input required" value="<?php if(isset($_POST['surnamez'])) echo $_POST['surnamez'];?>" class="required" />
					
				</div>
				<div class="form-group">
					<label for="emailz"><?php _e('Ηλεκτρονικό ταχυδρομείο', 'ma-ellak'); ?></label>
					<input type="text" name="emailz" id="emailz" class="form-control input required email" value="<?php if(isset($_POST['emailz'])) echo $_POST['emailz'];?>" class="required" />
					
				</div>
				<div class="form-group">
				<?php //if( function_exists( 'cptch_display_captcha_custom' ) ) { echo "<input type='hidden' name='cntctfrm_contact_action' value='true' />"; echo cptch_display_captcha_custom(); } ?>
				
				</div>
				
				<input type="hidden" id="events_id" name="events_id" value="<?php echo $events_id; ?>" />
				<button type="submit" class="btn btn-primary" id="ma_ellak_events_participation_submit" name="ma_ellak_events_participation_submit"><?php _e('Υποβολή', 'ma-ellak');?></button>				
				
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
			</form>
		<?php } ?>
		<?php /*---------------------- End Form ------------------------------------------*/ ?>
	</div>
</div>	
<?php get_footer(); ?>