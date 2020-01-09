<?php
  	
	if ( post_password_required() ) : ?>
<p class="nocomments container"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'SPICE' ); ?></p>
<?php
		return;
	endif;
?>

<section id="comment-wrap">
<?php if ( have_comments() && ! empty( $comments_by_type['comment'] ) ) : ?>
	<h3 id="comments" class="comments_title"><?php comments_number( esc_html__( '0 Comments', 'SPICE' ), esc_html__( '1 Comment', 'SPICE' ), '% ' . esc_html__( 'Comments', 'SPICE' ) ); ?></h3>
<?php endif; ?>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="comment_navigation_top">
				<div class="previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
				<div class="next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div> 
		<?php endif; ?>

		<?php if ( ! empty($comments_by_type['comment']) ) : ?>
			<ul class="list-comments clearfix">
				<?php wp_list_comments( array('type'=>'comment','callback'=>'spice_custom_comments_template') ); ?>
			</ul>
		<?php endif; ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="comment_navigation_bottom clearfix">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' ); ?></div>
				<div class="nav-next"><?php next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>

		<?php if ( ! empty($comments_by_type['pings']) ) : ?>
			<div id="trackbacks">
				<h3 id="trackbacks-title"><?php esc_html_e('Trackbacks/Pingbacks','SPICE') ?></h3>
				<ol class="pinglist">
					<?php wp_list_comments('type=pings&callback=spice_list_pings'); ?>
				</ol>
			</div>
		<?php endif; ?>
	<?php else : // this is displayed if there are no comments so far ?>
	   <div id="comment-section" class="nocomments">
		  <?php if ('open' == $post->comment_status) : ?>
			 <!-- If comments are open, but there are 0 comments to display. -->

		  <?php else : // When comments are closed ?>
			 <!-- So if comments are closed... -->

		  <?php endif; ?>
	   </div>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
    <div class="comment-form show-form clearfix">
    <h3><?php esc_html__('Write your comment','SPICE'); ?></h3>
	<?php
		  comment_form( 
		  	array(
		  		'label_submit' => esc_attr__( 'Submit Now', 'SPICE' ), 
				'class_submit'=>'btn red-btn',
				'comment_notes_after' =>'',						
		  		'title_reply' => '<span>' . esc_attr__( '', 'SPICE' ) . '</span>', 		  		 
			  	'fields' => array(
					'author'=>'<div class="row"><div class="col-md-4 col-sm-6"><input placeholder="'.sprintf(esc_html__('Enter Your Name*','SPICE')).'" id="author" class="comment-name-txt" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" '.( $req ? ' aria-required="true"' : '' ).' /></div>',
					'email'=>'<div class="col-md-4 col-sm-6"><input placeholder="'.sprintf(esc_html__('Enter Your Email*','SPICE')).'" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" '.( $req ? ' aria-required="true"' : '' ).' /></div>',
					'url' =>'<div class="col-md-4 col-sm-6"><input placeholder="'.sprintf(esc_html__('Enter site URL here','SPICE')).'" id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ).'" size="30" /></div></div>',
			  	),
		  	  	'comment_field' => '<textarea id="comment" name="comment" aria-required="true" placeholder="'.sprintf(esc_html__('Comments*','SPICE')).'"></textarea>',
			) 
		  );
	?>
    </div>
	<?php else: ?>

	<?php endif; // if you delete this the sky will fall on your head ?>
</section>