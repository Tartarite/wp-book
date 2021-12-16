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
	public function bookmeta_integrate_wpdb() {
		global $wpdb;

		$wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
		$wpdb->tables[] = 'bookmeta';

		return;
	}

	public function wpb_cust_post_type_book() {

		/*
		* This function will add custom post type named 'Book'.
		*/

		$labels = array(
			'name' 					=> _x( 'Books', 'Post Type General Name' ),
			'singular_name' 		=> _x( 'Book', 'Post Type Singular Name' ),
			'menu_name'				=> __( 'Book' ),
			'all_items'				=> __( 'All Books' ),
			'view_item'				=> __( 'View Book' ),
			'add_new_item'			=> __( 'Add New Book' ),
			'add_new' 				=> __( 'Add New' ),
			'edit_item'				=> __( 'Edit Book' ),
			'update_item'			=> __( 'Update Book' ),
			'search_item'			=> __( 'Search Book'),
			'not_found'				=> __( 'Book Not Found' ),
			'not_found_in_trash'	=> __( 'Book Not Found In Trash' )
		);

		$args = array(
			'labels' 				=> $labels,
			'description'			=> 'Book custom post type.',
			'public' 				=> true,
			'has_archive' 			=> true,
			'publicly_queryable'	=> true,
			'query_var'				=> true,
			'hierarchical'			=> false,
			'show_ui'				=> true,
			'show_in_menu'			=> true,
			'show_in_nav_menus'		=> true,
			'show_in_admin_bar'		=> true,
			'menu_position'			=> 6,
			'rewrite'				=> array( 'slug' => 'book' ),
			'capability_type'		=> 'post',
		//	'supports'				=> array( 'title', 'editor', 'author', 'thumbnail' ),
		//	'taxonomies'			=> array( 'category', 'post_tag' ),
			'show_in_rest'			=> true
		);

		register_post_type( 'book', $args );
	}

	public function wpb_cust_hie_taxonomy() {

		/*
		* This function adds custom hierarchical taxonomy 'Category'.
		*/

		$labels = array(
			'name' 				=> _x( 'Book Categories', 'Taxonomy General Name' ),
			'singular_name' 	=> _x( 'Book Category', 'Taxonomy Singular Name' ),
			'search_items' 		=> __( 'Search For Book Category' ),
			'all_items'			=> __( 'All Book Categories' ),
			'parent_item'		=> __( 'Parent Book Category' ),
			'parent_item_colon'	=> __( 'Parent Book Category:' ),
			'edit_item'			=> __( 'Edit Book Category' ),
			'update_item'		=> __( 'Update Book Category' ),
			'add_new_item'		=> __( 'Add New Book Category' ),
			'new_item_name'		=> __( 'New Book Category ' ),
			'menu_name'			=> __( 'Book Category' ),
		);

		$args = array(
			'hierarchical'		=> true,
			'labels'			=> $labels,
			'show_ui'			=> true,
			'show_admin_column'	=> true,
			'query_var'			=> true,
			'rewrite'			=> [ 'slug' => 'book-category' ],
		);

		register_taxonomy( 'book-category', array( 'book' ), $args );
	}

	public function wpb_cust_nonhie_taxonomy() {

		/*
		* This function adds custom non-hierarchical taxonomy named 'Book Tag'.
		*/

		$labels = array(
			'name' 				=> _x( 'Book Tags', 'Taxonomy General Name' ),
			'singular_name' 	=> _x( 'Book Tag', 'Taxonomy Singular Name' ),
			'search_items' 		=> __( 'Search For Book Tag' ),
			'all_items'			=> __( 'All Book Tags' ),
			'edit_item'			=> __( 'Edit Book Tag' ),
			'update_item'		=> __( 'Update Book Tag' ),
			'add_new_item'		=> __( 'Add New Book Tag' ),
			'new_item_name'		=> __( 'New Book Tag' ),
			'menu_name'			=> __( 'Book Tags' ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => [ 'slug' => 'book-tag' ],
		);

		register_taxonomy( 'book-tag', array( 'book' ), $args );

	}
	public function bookmeta_integrate_wpdb() {
		global $wpdb;

		$wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
		$wpdb->tables[] = 'bookmeta';

		return;
	}

	public function wpb_cust_meta_box() {
		add_meta_box( "wpb-meta-book",
									"Book Details",
									array( $this, "wpb_cust_meta_box_content" ),
									"book",
									"side",
									"high" );
	}

	public function wpb_cust_meta_box_content( $post ) {
		wp_nonce_field( basename( __FILE__ ), "wp_wpb_cpt_nonce" );
		?>
			<label for="author_name">Author Name : </label><br/>
			<?php $ath_name = get_book_meta( $post->ID, "book_author_name" );?>
			<input name="author_name" id="author_name" type="text" value="<?php _e( $ath_name ); ?>" /><br/>
			<label for="price">Price : </label><br/>
			<input name="price" id="price" type="text"/><br/>
			<label for="publisher">Publisher : </label><br/>
			<input name="publisher" id="publisher" type="text"/><br/>
			<label for="year">Year : </label><br/>
			<input name="year" id="year" type="text" maxlength="4"/><br/>
			<label for="edition">Edition : </label><br/>
			<input name="edition" id="edition" type="text"/><br/>
			<label for="ur_l">URL : </label><br/>
			<input name="ur_l" id="ur_l" type="text"/><br/>
		<?php
	}
	public function wpb_save_book_metabox_data( $post_id, $post ) {
		if( !isset( $_POST[ 'wp_wpb_cpt_nonce' ] ) || !wp_verify_nonce( $_POST[ 'wp_wpb_cpt_nonce' ], basename( __FILE__ ))) { // To Verify Nonce
				return $post_id;
		}

		$post_slug = "book";
		if( $post_slug != $post->post_type ){ // Verifying slug value
			return;
		}

		// save data to database
		$auth_name = '';
		$price = '';
		$pub_name = '';
		$year = '';
		$edition = '';
		$url = '';
		if( !empty( $_POST[ 'author_name' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'author_name' ] );
			update_book_meta( $post_id, "book_author_name", $auth_name );
		}
		if( !empty( $_POST[ 'price' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'price' ] );
			update_book_meta( $post_id, "book_price", $auth_name );
		}
		if( !empty( $_POST[ 'publisher' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'publisher' ] );
			update_book_meta( $post_id, "book_publisher", $auth_name );
		}
		if( !empty( $_POST[ 'year' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'year' ] );
			update_book_meta( $post_id, "book_year", $auth_name );
		}
		if( !empty( $_POST[ 'edition' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'edition' ] );
			update_book_meta( $post_id, "book_edition", $auth_name );
		}
		if( !empty( $_POST[ 'ur_l' ]) ) {
			$auth_name = sanitize_text_field( $_POST[ 'ur_l' ] );
			update_book_meta( $post_id, "book_url", $auth_name );
		}
	}

	public function wpb_cust_menu_page() {
		add_menu_page( 'WPT Book Menu', 'Books Menu', 'manage_options', 'book_menu', array( $this, 'wpb_create_book_menu_page' ) );
	}

	public function wpb_create_book_menu_page() {
		require_once 'partials/wp-book-admin-display.php';
	}

	public function wpb_book_register_settings() {
		register_setting( 'books-setting-group', 'currency' );
		register_setting( 'books-setting-group', 'post-per-page' );
		add_settings_section( 'books-setting-section', 'Books setting section', array( $this, 'wpb_book_settings_section' ), 'book_menu' );
		add_settings_field( 'book-currency', 'Currency', array( $this, 'wpb_book_currency' ), 'book_menu', 'books-setting-section' );
		add_settings_field( 'book-post-pp', 'Posts Per Page', array( $this, 'wpb_book_post_pp' ), 'book_menu', 'books-setting-section' );
	}

	public function wpb_book_settings_section() {}

	public function wpb_book_currency() {
		echo '<select name="currency" id="currency">
						<option value="Dollar">$ - dollar</option>
						<option value="Rupees">Rs. - rupees</option>
					</select>';
	}

	public function wpb_book_post_pp() {
		echo '<input type="text" name="post-per-page" value=""/>';
	}


}


function add_book_meta( $book_id, $meta_key, $meta_value, $unique = false ) {
	return add_metadata( 'book', $book_id, $meta_key, $meta_value, $unique);
}

function delete_book_meta( $book_id, $meta_key, $meta_value = '') {
	return delete_metadata( 'book', $book_id, $meta_key, $meta_value );
}

function get_book_meta( $book_id, $key = '', $single = true ) {
	return get_metadata( 'book', $book_id, $key, $single );
}

function update_book_meta( $book_id, $meta_key, $meta_value, $prev_value = '' ) {
	return update_metadata( 'book', $book_id, $meta_key, $meta_value, $prev_value );
}
