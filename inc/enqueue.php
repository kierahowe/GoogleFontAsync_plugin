<?php 

namespace GFonts\Enqueue;

class Enqueue { 
	public function __construct() { 
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	public function admin_enqueue() {
		$screen = get_current_screen();
		if( $screen->id === 'settings_page_gfont_settings' ) { 
			wp_enqueue_style( 'select2-style', plugin_dir_url(__FILE__) . '../vendor/select2/select2/dist/css/select2.min.css' );
   		    wp_enqueue_script( 'select2-js',  plugin_dir_url(__FILE__) . '../vendor/select2/select2/dist/js/select2.min.js' );

   		    wp_enqueue_script( 'select-fonts-js',  plugin_dir_url(__FILE__) . '../assets/js/select_fonts.js' );
			wp_enqueue_style( 'jfont-admin-css', plugin_dir_url(__FILE__) . '../assets/css/admin.css' );
   		}
	}

	public function enqueue() { 

	}
}

new Enqueue();