<?php 

namespace GFonts\Options;

class Options { 
	function __construct() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	public function add_plugin_page() {
		// This page will be under "Settings"
		add_options_page(
			__( 'Google Font Settings', 'gfont' ), 
			__( 'Google Font Settings', 'gfont' ), 
			'manage_options', 
			'gfont_settings', 
			array( $this, 'options_page' )
		);
	}

	/**
	 * Register and add settings
	 */
	public function page_init()
	{        
		register_setting(
			'main_options',
			'google_fonts',
			array( $this, 'sanitize' )
		);

		add_settings_section(
			'font_select',
			__( 'Select a Font', 'gfont' ),
			array( $this, 'output_section' ),
			'gfont_admin_settings'
		);  

		add_settings_field(
			'google_font_list',
			__( 'Font Select', 'gfont' ),
			array( $this, 'font_select_control' ),
			'gfont_admin_settings',
			'font_select'
		);
	}

	/**
	 * Ouput the admin options page
	 * @return [type] [description]
	 */
	public function options_page()
	{
		// Set class property
		$this->options = get_option( 'google_fonts' );
		?>
		<div class="wrap">
			<h1>Google Font Settings</h1>
			<form method="post" action="options.php">
			<?php
				// This prints out all hidden setting fields
				settings_fields( 'main_options' );
				do_settings_sections( 'gfont_admin_settings' );
				submit_button();
			?>
			</form>
		</div>
		<?php
	}

	public function output_section() { 
	?>
	<?php 
	}

	public function font_select_control() { 
	?>
		<select class="font_select" name="google_fonts[]" multiple="multiple">
			<?php 
			if( is_array( $this->options ) ) : 
				foreach( $this->options as $opt ) : 
			?>
					<option value="<?php echo esc_attr( $opt ); ?>" selected><?php echo esc_html( $opt ); ?></option>
			<?php 
				endforeach;
			endif;
			?>
		</select>
	<?php 
	}
}

new Options();