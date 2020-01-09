<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail">
		<a href="<?php the_permalink(); ?>"
		   title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail( 'insight-blog-classic-preview-image' ); ?>
		</a>
	</div>
<?php } ?>
