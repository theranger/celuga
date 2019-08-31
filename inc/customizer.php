<?php
/**
 * beluga Theme Customizer
 *
 * @package beluga
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function beluga_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	class beluga_Customize_Textarea_Control extends WP_Customize_Control
	{
		public $type = 'textarea';

		public function render_content()
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
				<textarea rows="5"
						  style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
			</label>
			<?php
		}
	}

	//FEATURED IMAGES SECTION
	$wp_customize->add_section('beluga_featured_image_options', array(
		'title' => 'Featured Image Options',
		'priority' => 70,
		'description' => 'Featured images will only appear in the header of single posts in the post\'s featured image is 1600px wide or greater.'
	));
	//SITE LICENSE SECTION
	$wp_customize->add_section('beluga_site_license_info', array(
		'title' => 'Site License Information',
		'priority' => 130,
	));

	//FEATURED IMAGE ON THE FRONT PAGE - SETTING
	$wp_customize->add_setting('beluga_theme_settings[featured_frontpage]', array(
		'default' => 1,
		'type' => 'option',
		'sanitize_callback' => 'sanitize_null'
	));
	//FEATURED IMAGE IN THE HEADER - SETTING
	$wp_customize->add_setting('beluga_theme_settings[featured_header]', array(
		'default' => 1,
		'type' => 'option',
		'sanitize_callback' => 'sanitize_null'
	));
	//HEADER IMAGE OPACITY - SETTING
	$wp_customize->add_setting('beluga_theme_settings[header_opacity]', array(
		'default' => '0',
		'type' => 'option',
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_null'
	));
	//SITE LICENSE INFORMATION - SETTING
	$wp_customize->add_setting('beluga_theme_settings[site_license]', array(
		'default' => '',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_textbox'
	));

	//SITE LICENSE INFORMATION - CONTROL
	$wp_customize->add_control(new beluga_Customize_Textarea_Control($wp_customize, 'beluga_site_license', array(
		'label' => 'We recommend Creative Commons',
		'section' => 'beluga_site_license_info',
		'settings' => 'beluga_theme_settings[site_license]',
	)));
	//FEATURED IMAGES ON THE FRONT PAGE - CONTROL
	$wp_customize->add_control('beluga_featured_frontpage_control', array(
			'label' => __('Include featured image thumbnails on the blog\'s front page.', 'beluga'),
			'section' => 'beluga_featured_image_options',
			'settings' => 'beluga_theme_settings[featured_frontpage]',
			'type' => 'checkbox'
		)
	);
	//FEATURED IMAGES IN THE HEADER - CONTROL
	$wp_customize->add_control('beluga_featured_header_control', array(
			'label' => __('Include featured images in single post headers.', 'beluga'),
			'section' => 'beluga_featured_image_options',
			'settings' => 'beluga_theme_settings[featured_header]',
			'type' => 'checkbox'
		)
	);
	//HEADER IMAGE OPACITY - CONTROL
	$wp_customize->add_control('beluga_header_opacity_control', array(
			'label' => __('Set the opacity of header images to make your title text better stand out.', 'beluga'),
			'section' => 'header_image',
			'settings' => 'beluga_theme_settings[header_opacity]',
			'type' => 'select',
			'choices' => array('0' => 'Fully Visible',
				'0.1' => '90%',
				'0.2' => '80%',
				'0.3' => '70%',
				'0.4' => '60%',
				'0.5' => '50%',
				'0.6' => '40%',
				'0.7' => '30%',
				'0.8' => '20%',
				'0.9' => '10%',)
		)
	);
}

add_action('customize_register', 'beluga_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function beluga_customize_preview_js()
{
	wp_enqueue_script('beluga_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'beluga_customize_preview_js');

/**
 * Passthrough function for settings that don't require sanitizing
 */
function sanitize_null($i)
{
	return $i;
}

/**
 * Sanitizes textboxes by adding <br> tags between lines, running wptexturize
 */
function sanitize_textbox($i)
{
	$i = str_replace(array("\n", "\r", "\r\n", "\n\r"), '<br />', $i);
	$i = wptexturize($i);

	return $i;
}
