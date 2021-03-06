<?php if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5af02aa8a00b3',
	'title' => 'Gallery Options',
	'fields' => array(
		array(
			'key' => 'field_5af02b351da19',
			'label' => 'Subtitle text',
			'name' => 'mt_gallery_subtitle',
			'type' => 'text',
			'instructions' => 'Add top page subtitle text',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5af02b4b1da1a',
			'label' => 'Gallery Images',
			'name' => 'mt_gallery_images',
			'type' => 'gallery',
			'instructions' => 'Add gallery images',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'insert' => 'append',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5af02f5e1da1b',
			'label' => 'Gallery Template',
			'name' => 'mt_gallery_template',
			'type' => 'select',
			'instructions' => 'Select the gallery template',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'mt_gallery_3cols' => '3 Columns',
				'mt_gallery_4cols' => '4 Columns',
				'mt_gallery_3cols_fs' => '3 Columns Full Screen',
				'mt_gallery_4cols_fs' => '4 Columns Full Screen',
			),
			'default_value' => array(
				0 => 'mt_gallery_3cols',
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'return_format' => 'value',
			'placeholder' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'mt_gallery',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

acf_add_local_field_group(array(
	'key' => 'group_5af0301be4999',
	'title' => 'Page Customization',
	'fields' => array(
		array(
			'key' => 'field_5af0302c92160',
			'label' => 'Custom Title',
			'name' => 'mt_page_title',
			'type' => 'text',
			'instructions' => 'Change page title',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5af0305092161',
			'label' => 'Subtitle text',
			'name' => 'mt_page_subtitle',
			'type' => 'text',
			'instructions' => 'Add page subtitle text',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_5af0306192162',
			'label' => 'Top Image Height',
			'name' => 'mt_page_top_imgh',
			'type' => 'text',
			'instructions' => 'Change top page image height ( eg: 450px ). Default is the full height of the device',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'page',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;