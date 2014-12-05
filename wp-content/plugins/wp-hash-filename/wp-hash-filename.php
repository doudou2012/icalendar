<?php

/**
 * The WP Hash Filename Plugin
 *
 * Rename upload filename by hash.
 *
 * @package WP_Hash_Filename
 * @subpackage Main
 */

/**
 * Plugin Name: WP Hash Filename
 * Plugin URI:  http://xiedexu.cn/wp-hash-filename.htm
 * Description: Rename upload filename by hash.
 * Version: 1.0
 * Author: iOpenV
 * Author URI: http://www.iopenv.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function make_filename_hash($filename) {
	$info = pathinfo($filename);
	$ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
	$name = basename($filename, $ext);
	return md5($name) . $ext;
}
add_filter('sanitize_file_name', 'make_filename_hash', 10);