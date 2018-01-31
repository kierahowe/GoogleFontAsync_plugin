<?php 

namespace GFonts\Enqueue;

class Enqueue { 
	function __construct() { 
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );
	}

	function enqueue_style() {
		
	}
}

new Enqueue();