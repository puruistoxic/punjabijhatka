<?php

add_filter( 'cmb2_init', 'gallery_post_format_meta_box' );
function gallery_post_format_meta_box()
{	
	$prefix = 'spice_gallery_post_format_';
	$cmb_gallery_post = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Gallery Format Settings', 'SPICE' ),
		'object_types'  => array('post'), // Post type			
	) );
	$cmb_gallery_post->add_field( array(
		'name' => esc_html__( 'Upload Gallery Images', 'SPICE' ),
		'desc' => esc_html__( 'Upload Your Gallery Images', 'SPICE' ),
		'id'   => $prefix . 'gallery',
		'type' => 'file_list',
		
	) );

}
add_filter( 'cmb2_init', 'video_post_format_meta_box' );
function video_post_format_meta_box()
{	

	$prefix = 'spice_video_post_format_';
	$cmb_gallery_post = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Video Format Settings', 'SPICE' ),
		'object_types'  => array('post'), // Post type			
	) );
	$cmb_gallery_post->add_field( array(
		'name' => esc_html__( 'Upload Video', 'SPICE' ),
		'desc' => esc_html__( 'Upload Your video', 'SPICE' ),
		'id'   => $prefix . 'video',
		'type' => 'file',
		
	) );
}