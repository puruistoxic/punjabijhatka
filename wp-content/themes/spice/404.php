<?php
		get_header();		
?>
	<div class="wrapper">
		<div class="error-page-html">
			<section>			
				<?php
					printf(__('%s','SPICE'),spice_get_option('404-page-text'));
				?>
			</section>

		</div> <!-- EVENT ends -->
	</div> 
<?php
		get_footer();
?>
