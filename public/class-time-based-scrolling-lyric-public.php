<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/bhaveshkhadodara/
 * @since      1.0.0
 *
 * @package    Time_Based_Scrolling_Lyric
 * @subpackage Time_Based_Scrolling_Lyric/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Time_Based_Scrolling_Lyric
 * @subpackage Time_Based_Scrolling_Lyric/public
 * @author     Bhavesh Khadodara <bhaveshkhadodara999@gmail.com>
 */
class Time_Based_Scrolling_Lyric_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Time_Based_Scrolling_Lyric_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Time_Based_Scrolling_Lyric_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/time-based-scrolling-lyric-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Time_Based_Scrolling_Lyric_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Time_Based_Scrolling_Lyric_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/time-based-scrolling-lyric-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function music_custom_post_type() {
		/*
		* Creating a function to create our audio post type
		*/

		// Set UI labels for Custom Post Type
			$labels = array(
				'name'                => _x( 'Music', 'Post Type General Name', 'twentytwenty' ),
				'singular_name'       => _x( 'Music', 'Post Type Singular Name', 'twentytwenty' ),
				'menu_name'           => __( 'Music', 'twentytwenty' ),
				'parent_item_colon'   => __( 'Parent Music', 'twentytwenty' ),
				'all_items'           => __( 'All Music', 'twentytwenty' ),
				'view_item'           => __( 'View Music', 'twentytwenty' ),
				'add_new_item'        => __( 'Add New Music', 'twentytwenty' ),
				'add_new'             => __( 'Add New', 'twentytwenty' ),
				'edit_item'           => __( 'Edit Music', 'twentytwenty' ),
				'update_item'         => __( 'Update Music', 'twentytwenty' ),
				'search_items'        => __( 'Search Music', 'twentytwenty' ),
				'not_found'           => __( 'Not Found', 'twentytwenty' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
			);
			
		// Set other options for Custom Post Type
			
			$args = array(
				'label'               => __( 'Music', 'twentytwenty' ),
				'description'         => __( 'Music news and reviews', 'twentytwenty' ),
				'labels'              => $labels,
				// Features this audio supports in Post Editor
				'supports'            => array( 'title','custom-fields', ),
				// You can associate this audio with a taxonomy or custom taxonomy. 
				'taxonomies'          => array( 'genres' ),
				/* A hierarchical audio is like Pages and can have
				* Parent and child items. A non-hierarchical audio
				* is like Posts.
				*/	
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
				'show_in_rest' => true,
		
			);
			
			// Registering your Custom Post Type
			register_post_type( 'Music', $args );
		
		}
	public function custom_post_type_columns($columns){
		return array(
			'title' => __('Song name'),
			'shortcode' => __('Shortcode'),
			'date' => __('Date')
		);
	}
	public function custom_post_type_head($column_name, $post_ID){
		echo '[music track="' . $post_ID . '"]';
		
	}
	static function music_track_lyrics($track){
		if(!empty($track['track'])){
			$musicFile = get_post_meta( $track['track'], 'music-file',true);
			$musiclyric = get_post_meta( $track['track'], 'music-lyrics',true);
			echo '<div class="bg"></div>
			<center> <audio src="'.$musicFile.'" controls></audio></center>
			<input type="hidden" id="lycrics" value="'.$musiclyric.'">';
		}
	}

}
