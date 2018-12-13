<?php
/*
*/

if ( ! class_exists( 'MT_WPCPT_FAQS' ) ) :

	class MT_WPCPT_FAQS {

		private $bytes = 4;

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

			add_shortcode( 'faqs', array( $this, 'shortcode_faqs' ), 10, 2 );

		}

		/**
		 * Generate rand str
		 */
		public function rand_str() {
			return bin2hex( openssl_random_pseudo_bytes( $this->bytes ) );
		}

		/**
		 * Register custom taxonomy
		 */
		public function faq_tax_init() {

			$labels = array(
				'name'                       => _x( 'FAQ Categories', 'faq_categories_taxonomy' ),
				'singular_name'              => _x( 'FAQ Category', 'faq_categories_taxonomy' ),
				'search_items'               => __( 'Search FAQ Categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'popular_items'              => __( 'Popular FAQ Categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'all_items'                  => __( 'All FAQ Categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item'                => __( 'Parent FAQ Category', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item_colon'          => __( 'Parent FAQ Category:', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'edit_item'                  => __( 'Edit FAQ Category', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'view_item'                  => __( 'View FAQ Category', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'update_item'                => __( 'Update FAQ Category', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'add_new_item'               => __( 'Add New FAQ Category', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'new_item_name'              => __( 'New Position', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'separate_items_with_commas' => __( 'Separate FAQ categories with commas', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'add_or_remove_items'        => __( 'Add or remove FAQ categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'choose_from_most_used'      => __( 'Choose from the most used FAQ categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'not_found'                  => __( 'No FAQ categories found', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'no_terms'                   => __( 'No FAQ categories', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'items_list_navigation'      => __( 'Items list navigation', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'items_list'                 => __( 'Items list', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'most_used'                  => __( 'Most Used', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'back_to_terms'              => __( 'Back to FAQ categories', MT_WPCPT_FAQS__TEXTDOMAIN )
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

			register_taxonomy( 'mt-wpcpt-faqs-cats', 'mt-wpcpt-faqs', $args );
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
				'archives'              => __( 'FAQ Archives', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'parent_item_colon'     => __( 'Parent Item:', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'all_items'             => __( 'All FAQs', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'add_new_item'          => __( 'Add New FAQ', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'add_new'               => __( 'Add New', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'new_item'              => __( 'New FAQ', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'edit_item'             => __( 'Edit FAQ', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'update_item'           => __( 'Update FAQ', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'view_item'             => __( 'View FAQ', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'search_items'          => __( 'Search FAQs', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'not_found'             => __( 'Not found', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'not_found_in_trash'    => __( 'Not found in Trash', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'featured_image'        => __( 'Featured Image', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'set_featured_image'    => __( 'Set featured image', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'remove_featured_image' => __( 'Remove featured image', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'use_featured_image'    => __( 'Use as featured image', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'insert_into_item'      => __( 'Insert into item', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'uploaded_to_this_item' => __( 'Uploaded to this item', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'items_list'            => __( 'Items list', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'items_list_navigation' => __( 'Items list navigation', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'filter_items_list'     => __( 'Filter items list', MT_WPCPT_FAQS__TEXTDOMAIN )
			);
			$rewrite = array(
				'slug'                  => 'faqs',
				'with_front'            => false,
				'pages'                 => true,
				'feeds'                 => false
			);
			$args = array(
				'label'                 => __( 'FAQs', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'description'           => __( 'Frequently asked questions', MT_WPCPT_FAQS__TEXTDOMAIN ),
				'labels'                => $labels,
				'supports'              => array( 'title', 'editor' ),
				'taxonomies'            => array( 'mt-wpcpt-faqs-cats'),
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
				'capability_type'       => 'post',
				'show_admin_column'     => true
			);
			register_post_type( 'mt-wpcpt-faqs', $args );
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

			if ( is_post_type_archive( 'mt-wpcpt-faqs' ) ) {
				// Display all posts for custom post type
				$query->set( 'posts_per_page', 0 );
				return;
			}
		}

		/**
		 * Add FAQs via shortcode.
		 *
		 * [faqs cat=5]
		 *
		 * @param array $atts Button attributes
		 * @param string $content Button text content
		 *
		 * @return string Button HTML
		 */
		public function shortcode_faqs( $atts ) {

			$a = shortcode_atts( array(
				'cat'       => false, // comma separated list of FAQ category IDs
				'class'     => false, // CSS classes for FAQ element
				'exclude'   => false, // comma separated list of FAQ post IDs to exclude
				'id'        => false, // comma separated list of FAQ post IDs
				'order'     => false,
				'orderby'   => false,
				'show'      => false   // Start open or closed
			), $atts );

			$rand = $this->rand_str();

			$accordion_id = 'accordion-' . $rand;

			$args = array(
				'post_type'      => 'mt-wpcpt-faqs',
				'posts_per_page' => -1
			);

			if ( $a['cat'] ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'mt-wpcpt-faqs-cats',
						'field' => 'term_id',
						'terms' => explode( ',', $a['cat'] ),
						'include_children' => true
					)
				);
			}

			if ( $a['id'] ) {
				$args['post__in'] = explode( ',', $a['id'] );
			}

			if ( $a['exclude'] ) {
				$args['post__not_in'] = explode( ',', $a['exclude'] );
			}

			if ( $a['order'] ) {
				$args['order'] = $a['order'];
			}

			if ( $a['orderby'] ) {
				$args['orderby'] = $a['orderby'];
			}

			$posts = get_posts( $args );

			ob_start();

			if ( $a['cat'] || $a['id'] ) : ?>
				<div class="accordion <?php echo $a['class']; ?>" id="<?php echo $accordion_id; ?>">
					<?php $i = 0; foreach ($posts as $post) { ?>
						<div class="card" data-card="<?php echo $i; ?>">
							<div class="card-header" id="<?php echo sprintf( '%1$s__%2$s__%3$s', $accordion_id, 'card-header', $i ); ?>">
								<h4 class="mb-0">
									<a class="<?php echo ( $a['show'] && $i === 0 ? '' : 'collapsed' ); ?>" data-toggle="collapse" data-target="#<?php echo sprintf( '%1$s__%2$s__%3$s', $accordion_id, 'collapse', $i ); ?>" aria-expanded="true" aria-controls="<?php echo sprintf( '%1$s__%2$s__%3$s', $accordion_id, 'collapse', $i ); ?>"><?php echo get_the_title( $post->ID ); ?></a>
								</h4>
							</div>
							<div id="<?php echo sprintf( '%1$s__%2$s__%3$s', $accordion_id, 'collapse', $i ); ?>" class="collapse <?php echo ( $a['show'] && $i === 0 ? 'show' : '' ); ?>" aria-labelledby="<?php echo sprintf( '%1$s__%2$s__%3$s', $accordion_id, 'card-header', $i ); ?>" data-parent="#<?php echo $accordion_id; ?>">
								<div class="card-body">
									<?php echo apply_filters( 'the_content', $post->post_content ); ?>
								</div>
							</div>
						</div>
					<?php $i++; } ?>
				</div>
			<?php else : ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong><?php _e( 'Error', MT_WPCPT_FAQS__TEXTDOMAIN ); ?>:</strong> <?php _e( sprintf( 'the associated FAQs do not exist or are not published.', $a['id'] ), MT_WPCPT_FAQS__TEXTDOMAIN ); ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif;

			return ob_get_clean();

		}


	}

endif;
