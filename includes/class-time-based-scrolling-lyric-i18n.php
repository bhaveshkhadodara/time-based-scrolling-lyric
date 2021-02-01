<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://profiles.wordpress.org/bhaveshkhadodara/
 * @since      1.0.0
 *
 * @package    Time_Based_Scrolling_Lyric
 * @subpackage Time_Based_Scrolling_Lyric/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Time_Based_Scrolling_Lyric
 * @subpackage Time_Based_Scrolling_Lyric/includes
 * @author     Bhavesh Khadodara <bhaveshkhadodara999@gmail.com>
 */
class Time_Based_Scrolling_Lyric_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'time-based-scrolling-lyric',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
