<?php 
	global $post;	
	$temp_post = $post;
	global  $ma_ellak_content_types;
	$arguments = array(
			'posts_per_page' => 6,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type' => $ma_ellak_content_types,
	);
	$side_posts = get_posts($arguments);

	foreach($side_posts as $post){ setup_postdata($post);
		
		$myid= get_the_ID();
		
	    echo'<div class="snippet">';
			echo '<div class="title"><a href="' . get_permalink($myid) . '" title="' . apply_filters('the_title', $post->post_title) . '" rel="bookmark">';
			echo' <h3>'.apply_filters('the_title', $post->post_title).'</h3></a></div>';
			
    			echo'<p class="meta purple">';
    			 get_posttype_label($side_posts[0]->post_type)."&nbsp;";
    				
    				echo ma_ellak_print_unit_title($myid);
    				echo ma_ellak_print_thema($myid,'thema');
    				echo'</p>';
?>
    		 <div class="excerpt">
		        <?php the_excerpt_max_charlength(80); ?>
		    </div>
	    </div>
<?php }  ?>
<?php wp_reset_query();?>
<?php $post = $temp_post; ?>

