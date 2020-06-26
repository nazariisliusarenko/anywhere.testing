<?php
/**
 * Plugin's bootstrap file to launch the plugin.
 *
 * @package     Gutenberg_Stepconference\AllBlocks
 * @author      Fadi Nicolas Zahhar (Pro-Freelancer)
 * @license     GPL2+
 *
 * @wordpress-plugin
 * Plugin Name: Gutenberg StepConference - Blocks
 * Plugin URI:  https://stepconference.com
 * Description: A plugin containing Gutenberg blocks for StepConference Child Theme.
 * Version:     1.0
 * Author:      Fadi Nicolas Zahhar <a href="http://www.pro-solutions.net/">Pro-Freelancer</a>
 * Author URI:  http://www.pro-solutions.net/
 * Text Domain: stepconferencewpblocks
 * Domain Path: /languages
 * License:     GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Gutenberg_Stepconference\AllBlocks;

//  Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory() {
	return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url() {
	static $plugin_url;

	if ( empty( $plugin_url ) ) {
		$plugin_url = plugins_url( null, __FILE__ );
	}

	return $plugin_url;
}

// Enqueue JS and CSS
include __DIR__ . '/lib/enqueue-scripts.php';

// Register meta boxes
include __DIR__ . '/lib/meta-boxes.php';

// Block Templates
include __DIR__ . '/lib/block-templates.php';

// Dynamic Blocks
include __DIR__ . '/blocks/12-dynamic/index.php';
