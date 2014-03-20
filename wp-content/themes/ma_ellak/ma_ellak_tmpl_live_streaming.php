<?php

/*
 Template Name: Live Streaming Page
*/
  /**
  *@desc A single blog post See page.php is for a page layout.
  */
ma_ellak_streaming_redirect();
  get_header();
  ?>
    <?php 
  if (have_posts()) : while (have_posts()) : the_post();
  $ProgramPostId =get_option_tree('ma_ellak_view_event_program_option_id');
  $ParticipationFormPostId = get_option_tree('ma_ellak_view_event_option_id');
  $cid = $_GET['eventId'];
  $postdata = get_post($cid);
  $meta = get_post_meta($cid);
  
  $start = $meta['_ma_event_startdate_timestamp'][0]?strtotime($meta['_ma_event_startdate_timestamp'][0]):'';
  $starttime = $meta['_ma_event_startdate_time'][0]?$meta['_ma_event_startdate_time'][0]:'';
  
  $startd = date(MA_DATE_FORMAT,$start);
  $endd = $meta['_ma_event_enddate_timestamp'][0]?date(MA_DATE_FORMAT,strtotime($meta['_ma_event_enddate_timestamp'][0])):'';
  $endtime = $meta['_ma_event_enddate_time'][0]?$meta['_ma_event_enddate_time'][0]:'';
  
  $SdateD = date('d',$start);
  $SdateM = date('m',$start);
  $event_type = $meta ['_ma_events_type'][0];
  $place = $meta ['_ma_event_place'][0];
  $address=$meta['_ma_event_address'][0];
  $participation_form = $meta['_ma_events_participate'][0]=='no'?'':esc_url( get_permalink($ParticipationFormPostId) ).'?events_id='.$cid;
  $program = strlen($meta['_ma_event_title_program_desc'][0])<6?'':$meta['_ma_event_title_program_desc'][0];
  $thistime = strtotime($startd);
  $currenttime= strtotime(date(MA_DATE_FORMAT));
 	//echo $currenttime ." Thistime=". $currenttime;
   ?>
  
  <div class="row-fluid filters">
          <div class="span6">
            <p><a href="<?php echo get_permalink(get_option_tree('ma_ellak_list_event_option_id'))?>">ΠΙΣΩ ΣΤΗ ΛΙΣΤΑ</a></p>
          </div>
   </div>
   <div class="row-fluid event">
		  	<div class="cols">
		  		<div class="span5 col">
		  			<div class="boxed-in  livestreaming the-date">
					  
				    <?php 
					// FOTIS for Proof of concept: USE ONLY THE XXXXXXXXXXXXXXX from the youtube.com/watch?v=XXXXXXXXXXXXX
				    ma_ellak_print_streaming ($cid);
					//echo '<iframe width="420" height="315" src="'.$meta['_ma_ellak_event_url'][0].'" frameborder="0" allowfullscreen></iframe>';
					?>
					</div>
		 		</div><!-- span4 col -->
		 		<div class="span7 text col">
					  <h3><a href="<?php echo $postdata->guid; ?>" rel="bookmark" 
				  	title="<?php the_title_attribute($cid);?>" class="btn btn-large btn-link"><?php echo $postdata->post_title; ?></a>
				  	<a href="?ical&eid=<?php echo$cid; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/btn_ical.png" width="24" height="15" alt="ical"/></a></h3>
				  	  <p  class="meta purple">
					  <?php if($event_type=='event')
						echo  __('ΕΚΔΗΛΩΣΗ','ma-ellak'); 
						if($event_type=='seminar')
						echo __('ΣΕΜΙΝΑΡΙΟ','ma-ellak'); 
						?>
					  <?php ma_ellak_print_unit_title($cid); ?> 
					  <?php echo ma_ellak_print_thema($cid,'thema');?>
					  </strong> 
					  <?php echo $startd ." ". $starttime; if($endd) echo" - ". $endd ." ". $endtime;?></p>
					  <p  class="meta purple">
					  <?php if($place){?>
					  <?php echo __( 'ΣΤΟ', 'ma-ellak' );?>  
					  <strong class="magenta"><?php echo $place?></strong> 
					  <?php }?>
					  <?php if($address)?>
					  <strong ><?php echo $address;?></strong></p>
					 
					  <?php  the_excerpt_max_charlength(240);?>
					  
					  
					  <p>&nbsp;</p>
					
				</div><!-- span8 text col -->
		  	</div><!-- cols -->
	  </div><!-- row-fluid event -->
	 
	  
  <div class="back-purple">
  	<div class="container">
  		<div class="row-fluid">
  			<ul class="nav nav-tabs span10 offset2">
  				<?php if($meta['_ma_event_live'][0]==on){?>
  				<li class="active">
  					<a href="#tab-0" data-toggle="tab"><?php echo  __('LIVE STREAMING','ma-ellak');?></a>
  				</li>
  				<li>
  				
  				<?php }else{?>
  				<li class="active">
  					<a href="#tab-1" data-toggle="tab"><?php echo  __('ΠΕΡΙΓΡΑΦΗ','ma-ellak');?></a>
  				</li>
  				<?php }?>
  				<?php if(strlen($program)>6){?>
  					<li><a href="#tab-2"><?php echo __('ΠΡΟΓΡΑΜΜΑ','ma-ellak')?></a></li>
  				<?php }?>
  			</ul>
  		</div>
  	</div>
  </div>
  <div class="back-gray">
        <div class="container">
          <div class="row-fluid">
            <div class="tab-content span8 offset1">
            <?php if($meta['_ma_event_live'][0]==on){?>
              <div id="tab-0" class="tab-pane active">
            	<p>LIVE STREAMING</p>
            	<p><?php if($currenttime> $thistime) echo __('Η ζωντανή μετάδοση έχει ολοκληρωθεί','ma-ellak');
            	else if($currenttime < $thistime) 
            	{
            		echo __('Η ζωντανή μετάδοση θα πραγματοποιηθεί στις ','ma-ellak') .$startd;
            		if($meta['_ma_event_startdate_time'][0]) 
            			echo " - ". $meta['_ma_event_startdate_time'][0];
            	}else{
            		//ma_ellak_print_streaming($cid);
            	}
            	?>
            	</p>
            	<p>&nbsp;</p>
           		</div>
           	  <div id="tab-1" class="tab-pane">
            <?php }else{?>
              <div id="tab-1" class="tab-pane active">
            <?php }?>	
              	<?php 
              	echo  apply_filters('the_content', get_post($post->ID)->post_content);
              	 
              	?>
              </div>
              
              <?php if(strlen($program)>6){?>
              <div id="tab-2" class="tab-pane">
              	<?php include('ma_ellak_events_tmpl_program.php');?>
              </div>
              <?php }?>
             </div>
           </div>
         </div>
       </div>
	 
	 <?php echo social_output();?>
     
	<?php
  endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php
  endif;
  
  get_footer();

?>