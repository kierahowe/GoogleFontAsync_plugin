<?php 

class GFontTests extends WP_UnitTestCase{ 
	private $font_options = array( 'Roboto', 'Roboto Condensed', 'Raleway', 'Noticia Text' );

	/**
	 * Test the font searching - confirm finding the sample fonts
	 * @return void
	 */
	function test_font_search() { 
		foreach( $this->font_options as $font ) { 
			$ret = \GFonts\Helpers\gfont_get_fonts( $font );
			$this->assertGreaterThanOrEqual( 1, count( $ret ) );	
		}

		$ret = \GFonts\Helpers\gfont_get_fonts( '' );
		$this->assertGreaterThanOrEqual( 600, count( $ret ) );	
	}

	/**
	 * Test the Enqueuing of scripts and styles
	 * @return void
	 */
	function test_enqueue() { 
 		set_current_screen('settings_page_gfont_settings');

 		$enq = new \GFonts\Enqueue\Enqueue();
 		$this->assertTrue( has_action( 'wp_enqueue_scripts', array( $enq, 'enqueue' ) ) !== false );
 		$this->assertTrue( has_action( 'admin_enqueue_scripts', array( $enq, 'admin_enqueue' ) ) !== false );

 		$enq->admin_enqueue();
		$this->assertTrue( wp_script_is( 'select2-js', 'enqueued' ) );
		$this->assertTrue( wp_script_is( 'select-fonts-js', 'enqueued' ) );

		$this->assertTrue( wp_style_is( 'select2-style', 'enqueued' ) );
		$this->assertTrue( wp_style_is( 'jfont-admin-css', 'enqueued' ) );

 		$enq->enqueue();
		$this->assertTrue( wp_script_is( 'WebFontConfig', 'enqueued' ) );
	}

	/**
	 * Test the options class
	 * @return [type] [description]
	 */
	function test_options() { 
		$op = new \GFonts\Options\Options();
		$this->assertTrue( has_action( 'admin_menu', array( $op, 'add_plugin_page' ) ) !== false );
 		$this->assertTrue( has_action( 'admin_init', array( $op, 'page_init' ) ) !== false );

	}
}