<?php
/**
 * @package GoogleFontAsync_plugin
 * @version 1.0
 */
/*
Plugin Name: GoogleFontAsync_plugin
Plugin URI: http://www.kierahowe.com
Description: Adding Google fonts (Asynchronously)
Author: Kiera Howe
Version: 1.0
Author URI: http://www.kierahowe.com
*/

global $GFONT_APIKEY;
$GFONT_APIKEY = 'AIzaSyCIDoM74PaOQmuQUzG4VUMed-suoy2MO78';

require_once ( plugin_dir_path(__FILE__) . "inc/enqueue.php" );
require_once ( plugin_dir_path(__FILE__) . "inc/options.php" );
require_once ( plugin_dir_path(__FILE__) . "inc/ajax.php" );
require_once ( plugin_dir_path(__FILE__) . "inc/helpers.php" );
