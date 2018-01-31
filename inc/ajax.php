<?php 

namespace GFonts\Ajax;

//////////////////////////////////////////
/// Ajax Functions
/// 
/// 

/**
 * Find the fonts that match a search parameter passed from Select2
 * @return void       returns nothing, but, transmits an array, JSON encoded.
 */
function ajax_search_fonts() {
	if( ! current_user_can('manage_options') ) { 
		wp_send_json( array() );
	}

	$search_term = sanitize_text_field( $_GET['search'] );
	$ret = \GFonts\Helpers\gfont_get_fonts( $search_term );

	$out = array();
	foreach( $ret as $font ) { 
		$out[] = array( 'id' => $font['family'], 'text' => $font['family'] );
	}
	wp_send_json( array( 'results' => $out ) );
}

add_action( 'wp_ajax_gfont_get_fonts', __NAMESPACE__ . '\ajax_search_fonts' );
