<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/bhaveshkhadodara/
 * @since             1.0.0
 * @package           Time_Based_Scrolling_Lyric
 *
 * @wordpress-plugin
 * Plugin Name:       Time based scrolling lyric
 * Plugin URI:        https://profiles.wordpress.org/bhaveshkhadodara/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Bhavesh Khadodara
 * Author URI:        https://profiles.wordpress.org/bhaveshkhadodara/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       time-based-scrolling-lyric
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TIME_BASED_SCROLLING_LYRIC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-time-based-scrolling-lyric-activator.php
 */
function activate_time_based_scrolling_lyric() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-time-based-scrolling-lyric-activator.php';
	Time_Based_Scrolling_Lyric_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-time-based-scrolling-lyric-deactivator.php
 */
function deactivate_time_based_scrolling_lyric() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-time-based-scrolling-lyric-deactivator.php';
	Time_Based_Scrolling_Lyric_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_time_based_scrolling_lyric' );
register_deactivation_hook( __FILE__, 'deactivate_time_based_scrolling_lyric' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-time-based-scrolling-lyric.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_time_based_scrolling_lyric() {

	$plugin = new Time_Based_Scrolling_Lyric();
	$plugin->run();

}
run_time_based_scrolling_lyric();