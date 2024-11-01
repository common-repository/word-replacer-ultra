<?php
/*
Plugin Name: Word Replacer Ultra
Plugin URI:
Description: Search and Replace in Post, Pages and all Custom Post Type.
Version: 1.0
Author: Blitz Mobile Apps
License: GPLv2
Author URI: https://blitzmobileapps.com/
Requires at least: 5.0
Tested up to: 5.6
Text Domain: word-replacer-ultra
 */

define('WORD_REPLACER_ULTRA_PATH', dirname(__FILE__));
$plugin = plugin_basename(__FILE__);
define('WORD_REPLACER_ULTRA_URL', plugin_dir_url($plugin));

require WORD_REPLACER_ULTRA_PATH . '/inc/word-replacer-ultra-main.php';
require WORD_REPLACER_ULTRA_PATH . '/inc/word-replacer-ultra-ajax.php';
