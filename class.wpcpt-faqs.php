<?php
/*
*/

if ( ! class_exists( 'WPCPT_FAQS' ) ) :

	class WPCPT_FAQS {

		public function __construct() {

			/**
			 * 'init'
			 *
			 * Initialize the taxonomies and post type.
			 */
			add_action( 'init', array( $this, 'faq_tax_init') );
			add_action( 'init', array( $this, 'faq_post_type') );

			/**
			 * Alter the query
			 */
			add_action( 'pre_get_posts', array( $this, 'modify_query' ), 1 );

		}

		/**
		 * Register custom taxonomy
		 */
		public function faq_tax_init() {

			$labels = array(
				'name'                       => _x( 'FAQ Categories', 'faq_categories_taxonomy' ),
				'singular_name'              => _x( 'FAQ Category', 'faq_categories_taxonomy' ),
				'search_items'               => __( 'Search FAQ Categories', WPCPT_FAQS__TEXTDOMAIN ),
				'popular_items'              => __( 'Popular FAQ Categories', WPCPT_FAQS__TEXTDOMAIN ),
				'all_items'                  => __( 'All FAQ Categories', WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item'                => __( 'Parent FAQ Category', WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item_colon'          => __( 'Parent FAQ Category:', WPCPT_FAQS__TEXTDOMAIN ),
				'edit_item'                  => __( 'Edit FAQ Category', WPCPT_FAQS__TEXTDOMAIN ),
				'view_item'                  => __( 'View FAQ Category', WPCPT_FAQS__TEXTDOMAIN ),
				'update_item'                => __( 'Update FAQ Category', WPCPT_FAQS__TEXTDOMAIN ),
				'add_new_item'               => __( 'Add New FAQ Category', WPCPT_FAQS__TEXTDOMAIN ),
				'new_item_name'              => __( 'New Position', WPCPT_FAQS__TEXTDOMAIN ),
				'separate_items_with_commas' => __( 'Separate FAQ categories with commas', WPCPT_FAQS__TEXTDOMAIN ),
				'add_or_remove_items'        => __( 'Add or remove FAQ categories', WPCPT_FAQS__TEXTDOMAIN ),
				'choose_from_most_used'      => __( 'Choose from the most used FAQ categories', WPCPT_FAQS__TEXTDOMAIN ),
				'not_found'                  => __( 'No FAQ categories found', WPCPT_FAQS__TEXTDOMAIN ),
				'no_terms'                   => __( 'No FAQ categories', WPCPT_FAQS__TEXTDOMAIN ),
				'items_list_navigation'      => __( 'Items list navigation', WPCPT_FAQS__TEXTDOMAIN ),
				'items_list'                 => __( 'Items list', WPCPT_FAQS__TEXTDOMAIN ),
				'most_used'                  => __( 'Most Used', WPCPT_FAQS__TEXTDOMAIN ),
				'back_to_terms'              => __( 'Back to FAQ categories', WPCPT_FAQS__TEXTDOMAIN )
			);
			$rewrite = array(
				'slug'                       => 'faq_categories',
				'with_front'                 => false,
				'hierarchical'               => true
			);
			$args = array(
				'labels'                     => $labels,
				'description'                => __( '' ),
				'public'                     => true,
				'publicly_queryable'         => true,
				'hierarchical'               => true,
				'show_ui'                    => true,
				'show_in_menu'               => true,
				'show_in_nav_menus'          => true,
				'show_admin_column'          => true,
				'rewrite'                    => $rewrite
			);

			register_taxonomy( 'wpcpt-faqs-cats', 'wpcpt-faqs', $args );
		}

		/**
		 * Register "FAQs" post type
		 */
		public function faq_post_type() {

			$labels = array(
				'name'                  => _x( 'FAQs', 'Post Type General Name' ),
				'singular_name'         => _x( 'FAQ', 'Post Type Singular Name' ),
				'menu_name'             => _x( 'FAQs', 'Post Type Singular Name' ),
				'name_admin_bar'        => _x( 'FAQs', 'Post Type Singular Name' ),
				'archives'              => __( 'FAQ Archives', WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item_colon'     => __( 'Parent Item:', WPCPT_FAQS__TEXTDOMAIN ),
				'all_items'             => __( 'All FAQs', WPCPT_FAQS__TEXTDOMAIN ),
				'add_new_item'          => __( 'Add New FAQ', WPCPT_FAQS__TEXTDOMAIN ),
				'add_new'               => __( 'Add New', WPCPT_FAQS__TEXTDOMAIN ),
				'new_item'              => __( 'New FAQ', WPCPT_FAQS__TEXTDOMAIN ),
				'edit_item'             => __( 'Edit FAQ', WPCPT_FAQS__TEXTDOMAIN ),
				'update_item'           => __( 'Update FAQ', WPCPT_FAQS__TEXTDOMAIN ),
				'view_item'             => __( 'View FAQ', WPCPT_FAQS__TEXTDOMAIN ),
				'search_items'          => __( 'Search FAQs', WPCPT_FAQS__TEXTDOMAIN ),
				'not_found'             => __( 'Not found', WPCPT_FAQS__TEXTDOMAIN ),
				'not_found_in_trash'    => __( 'Not found in Trash', WPCPT_FAQS__TEXTDOMAIN ),
				'featured_image'        => __( 'Featured Image', WPCPT_FAQS__TEXTDOMAIN ),
				'set_featured_image'    => __( 'Set featured image', WPCPT_FAQS__TEXTDOMAIN ),
				'remove_featured_image' => __( 'Remove featured image', WPCPT_FAQS__TEXTDOMAIN ),
				'use_featured_image'    => __( 'Use as featured image', WPCPT_FAQS__TEXTDOMAIN ),
				'insert_into_item'      => __( 'Insert into item', WPCPT_FAQS__TEXTDOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', WPCPT_FAQS__TEXTDOMAIN ),
				'items_list'            => __( 'Items list', WPCPT_FAQS__TEXTDOMAIN ),
				'items_list_navigation' => __( 'Items list navigation', WPCPT_FAQS__TEXTDOMAIN ),
				'filter_items_list'     => __( 'Filter items list', WPCPT_FAQS__TEXTDOMAIN )
			);
			$rewrite = array(
				'slug'                  => 'faqs',
				'with_front'            => false,
				'pages'                 => true,
				'feeds'                 => false
			);
			$args = array(
				'label'                 => __( 'FAQs', WPCPT_FAQS__TEXTDOMAIN ),
				'description'           => __( 'Frequently asked questions', WPCPT_FAQS__TEXTDOMAIN ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor' ),
				'taxonomies'            => array( 'wpcpt-faqs-cats'),
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_menu'          => true,
				'menu_position'         => 10,
				'menu_icon'             => 'dashicons-editor-help',
				'show_in_admin_bar'     => true,
				'show_in_nav_menus'     => true,
				'can_export'            => true,
				'has_archive'           => true,
				'exclude_from_search'   => true,
				'publicly_queryable'    => true,
				'rewrite'               => $rewrite,
				'capability_type'       => array( 'faq', 'faqs' ),
				'show_admin_column'     => true
			);
			register_post_type( 'wpcpt-faqs', $args );
		}

		/**
		 * Modify the query
		 *
		 * We include the ability to modify the query from WordPress defaults,
		 * for example if you wish to change the number of posts displayed, etc.
		 */
		public function modify_query( $query ) {
			if ( is_admin() || ! $query->is_main_query() )
				return;

			if ( is_post_type_archive( 'wpcpt-faqs' ) ) {
				// Display all posts for custom post type
				$query->set( 'posts_per_page', 0 );
				return;
			}
		}

	}

	$WPCPT_FAQS = new WPCPT_FAQS();

endif;
