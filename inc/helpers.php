<?php 

namespace GFonts\Helpers;

/**
 * Gets the fonts from Google or from the WP cache
 * @param  string  $search_term The search term for searching in "Family" field
 * @param  boolean $match       If the search term should match the family exactly
 * @return array                return the list of matched fonts
 */
function gfont_get_fonts( $search_term = '', $match = false ) {
	global $GFONT_APIKEY;

	$fonts = wp_cache_get( 'gfont_font_cache' );
	if( $fonts === false || count( $fonts === 0 ) ) { 
		$fonts = json_decode(
				file_get_contents( 'https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&family=x&key=' . $GFONT_APIKEY ), 
				true );

		if( $fonts === false || ! is_array( $fonts['items'] ) ) { 
			return( array() );
		}
		wp_cache_set( 'gfont_font_cache', $fonts['items'], '', time() + DAY_IN_SECONDS );

		$fonts = $fonts['items'];
	}

	if( empty( $search_term ) ) { return $fonts; }
	$out = array();
	foreach( $fonts as $font ) {
		if( 
			( $match && $font['family'] === $search_term ) || 
			( !$match && stripos( $font['family'], $search_term ) !== false )
		) { 
			$out[] = $font;
		}
	}

	return $out;
}
