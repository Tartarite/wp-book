<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Book
 * @subpackage Wp_Book/admin
 * @author     Varchas Beedu <varchasbeedu@gmail.com>
 */
class Wp_Book_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-book-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Book_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Book_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-book-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function cust_post_type_book() {

		/*
		* This function will add custom post type named 'Book'.
		*/

		$labels = array(
			'name' 					=> _x( 'Books', 'Post Type General Name' ),
			'singular_name' 		=> _x( 'Book', 'Post Type Singular Name' ),
			'menu_name' 			=> __( 'Book' ),
			'all_items' 			=> __( 'All Books' ),
			'view_item' 			=> __( 'View Book' ),
			'add_new_item' 			=> __( 'Add New Book' ),
			'add_new' 				=> __( 'Add New' ),
			'edit_item' 			=> __( 'Edit Book' ),
			'update_item' 			=> __( 'Update Book' ),
			'search_item' 			=> __( 'Search Book'),
			'not_found' 			=> __( 'Book Not Found' ),
			'not_found_in_trash' 	=> __( 'Book Not Found In Trash' )
		);

		$args = array(
			'labels' 				=> $labels,
			'description'			=> 'Book custom post type.',
			'public' 				=> true,
			'has_archive' 			=> true,
			'publicly_queryable' 	=> true,
			'query_var'          	=> true,
			'hierarchical'       	=> false,
			'show_ui'            	=> true,
      		'show_in_menu'       	=> true,
			'show_in_nav_menus'		=> true,
			'show_in_admin_bar'		=> true,
			'menu_position'			=> 6,
			'rewrite'            	=> array( 'slug' => 'book' ),
      		'capability_type'    	=> 'post',
			'supports'           	=> array( 'title', 'editor', 'author', 'thumbnail' ),
      		'taxonomies'         	=> array( 'category', 'post_tag' ),
			'show_in_rest'       	=> true
		);

		register_post_type( 'book', $args );
	}
}
