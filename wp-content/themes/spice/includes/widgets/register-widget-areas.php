<?php	
	function spice_widgets_init() 
	{
		register_sidebar( array(
		'name' 		=> 'Sidebar Area',
		'id' 		=> 'sidebar-1',
		'class'         => 'clearfix',
		'before_widget' => '<article id="%1$s" class="widgets archive-list %2$s">',
		'after_widget' 	=> '</div></article>',
		'before_title' 	=> '<h4>',
		'after_title' 	=> '</h4><div class="widget-content">',
		) );

		register_sidebar( array(
		'name' 		=> 'Woocomerce Sidebar',
		'id' 		=> 'woocom-sidebar',
		'class'         => 'clearfix',
		'before_widget' => '<div id="%1$s" class="widgets archive-list %2$s">',
		'after_widget' 	=> '</div>',
		'before_title' 	=> '<h4>',
		'after_title' 	=> '</h4>',
		) );
		register_sidebar( array(
		'name' 		=> 'Without Title Sidebar',
		'id' 		=> 'without-title',
		'class'         => 'clearfix',
		'before_widget' => '<article id="%1$s" class="widgets archive-list %2$s">',
		'after_widget' 	=> '</article>',
		'before_title' 	=> '',
		'after_title' 	=> '',
		) );
	}
	add_action( 'widgets_init', 'spice_widgets_init' );
?>