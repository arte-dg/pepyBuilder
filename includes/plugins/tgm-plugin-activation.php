<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package pepybuilder WordPress theme
 */

function pepybuilder_tgmpa_register() {

	// Get array of recommended plugins
		// Get array of recommended plugins
	$plugins = array(

		array(
			'name'				=> 'Criar Header, Footer & Blocks',
			'slug'				=> 'header-footer-elementor', 
			'required'			=> true,
			'force_activation'	=> false,
		),
		array(
			'name'				=> 'Social Share Buttons',
			'slug'				=> 'add-to-any', 
			'required'			=> false,
			'force_activation'	=> false,
		),
		array(
			'name'				=> 'WordPress SEO',
			'slug'				=> 'seo-by-rank-math', 
			'required'			=> false,
			'force_activation'	=> false,
		),
				    		
	);


	// Register notice
	tgmpa( $plugins, array(
		'id'           => 'pepybuilder_theme',
		'domain'       => 'pepybuilder',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );

}
add_action( 'tgmpa_register', 'pepybuilder_tgmpa_register' );