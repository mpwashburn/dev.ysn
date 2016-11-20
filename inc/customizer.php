<?php
/**
 * YSN Theme Customizer.
 *
 * @package YSN
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ysn_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
        
        /**
	 * Custom Customizer Customizations
	 */
	
		// Create header background color setting
	$wp_customize->add_setting( 'header_color', array(
		'default' => '#000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	
	// Add header background color control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __( 'Header Background Color', 'ysn' ),
				'section' => 'colors',
			)
		)
	);
        
        // Add section to the Customizer
	$wp_customize->add_section( 'ysn-options', array(
		'title' => __( 'Theme Options', 'ysn' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Change the default display options for the theme.', 'ysn' ),
	));
	
	// Create sidebar layout setting
	$wp_customize->add_setting( 'layout_setting',
		array(
			'default' => 'no-sidebar',
			'type' => 'theme_mod',
			'sanitize_callback' => 'ysn_sanitize_layout', 
			'transport' => 'postMessage'
		)
	);
	// Add sidebar layout controls
	$wp_customize->add_control(	'layout_control',
		array(
			'settings' => 'layout_setting',
			'type' => 'radio',
			'label' => __( 'Sidebar position', 'ysn' ),
			'choices' => array(
				'no-sidebar' => __( 'No sidebar (default)', 'ysn' ),
				'sidebar-left' => __( 'Left sidebar', 'ysn' ),
				'sidebar-right' => __( 'Right sidebar', 'ysn' )
			),
			'section' => 'ysn-options',
		)
	);
	
}
add_action( 'customize_register', 'ysn_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ysn_customize_preview_js() {
	wp_enqueue_script( 'ysn_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ysn_customize_preview_js' );

/**
 * Sanitize layout options
 */
function ysn_sanitize_layout( $value ) {
	if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) ) {
		$value = 'no-sidebar';
	}
	return $value;
}


/**
 * Inject Customizer CSS when appropriate
 */
function ysn_customizer_css() {
	$header_color = get_theme_mod('header_color');
	
	?>
<style type="text/css">
	.site-header {
		background-color: <?php echo $header_color; ?>
	}
</style>
	<?php
}
add_action( 'wp_head', 'ysn_customizer_css' );
