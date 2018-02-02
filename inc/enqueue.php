<?php 

namespace GFonts\Enqueue;

/**
 * Class to enqueue the scripts and css
 */
class Enqueue { 

	/**
	 * Constructor
	 */
	public function __construct() { 
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}

	/**
	 * Enqueues scripts and CSS for use in the admin area
	 * @return void
	 */
	public function admin_enqueue() {
		$screen = get_current_screen();
		if( $screen->id === 'settings_page_gfont_settings' ) { 
			wp_enqueue_style( 'select2-style', plugin_dir_url( __FILE__ ) . '../vendor/select2/select2/dist/css/select2.min.css' );
   		    wp_enqueue_script( 'select2-js',  plugin_dir_url( __FILE__ ) . '../vendor/select2/select2/dist/js/select2.min.js' );

   		    wp_enqueue_script( 'select-fonts-js',  plugin_dir_url( __FILE__ ) . '../assets/js/select_fonts.js' );
			wp_enqueue_style( 'jfont-admin-css', plugin_dir_url( __FILE__ ) . '../assets/css/admin.css' );
   		}
	}

	/**
	 * Enqueues scripts and CSS for use in the main pages
	 * @return void
	 */
	public function enqueue() {
		$fonts = get_option( 'google_fonts' );

		wp_enqueue_script( 'WebFontConfig', plugin_dir_url( __FILE__ ) . '../assets/js/gfont.js', array(), false, true  );
		wp_localize_script( 'WebFontConfig', 'WebFontConfig', array( 'google' => array( 'families' => $fonts ) ) );
		$script = "
   (function(d) {
      var wf = d.createElement('script'), s = d.scripts[0];
      wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      wf.async = true;
      s.parentNode.insertBefore(wf, s);
   })(document); ";

		wp_add_inline_script( 'WebFontConfig', $script, 'after' );
	}
}

// Initiate enqueue
new Enqueue();