<?php
namespace Raven\Core\Dynamic_Tags\Tags;

use Elementor\Core\DynamicTags\Tag as Tag;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Archive_Description extends Tag {

	public function get_name() {
		return 'archive-description';
	}

	public function get_title() {
		return __( 'Archive Description', 'raven' );
	}

	public function get_group() {
		return 'archive';
	}

	public function get_categories() {
		return [ 'text' ];
	}

	public function render() {
		echo wp_kses_post( get_the_archive_description() );
	}
}
