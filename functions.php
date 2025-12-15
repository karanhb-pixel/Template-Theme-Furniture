<?php
/**
 * Biz-Catalog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Biz-Catalog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function biz_catalog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Biz-Catalog, use a find and replace
		* to change 'biz-catalog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'biz-catalog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'biz-catalog' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'biz_catalog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'biz_catalog_setup' );

/**
 * Register Custom Post Types
 */
function cc_register_custom_post_types() {
    // Register Projects Post Type
    register_post_type('project', array(
        'labels' => array(
            'name' => 'Projects',
            'singular_name' => 'Project',
            'menu_name' => 'Projects',
            'add_new' => 'Add New Project',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'new_item' => 'New Project',
            'view_item' => 'View Project',
            'search_items' => 'Search Projects',
            'not_found' => 'No projects found',
            'not_found_in_trash' => 'No projects found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'rewrite' => array('slug' => 'projects'),
        'show_in_rest' => true,
    ));

    // Register Products Post Type
    register_post_type('product', array(
        'labels' => array(
            'name' => 'Products',
            'singular_name' => 'Product',
            'menu_name' => 'Products',
            'add_new' => 'Add New Product',
            'add_new_item' => 'Add New Product',
            'edit_item' => 'Edit Product',
            'new_item' => 'New Product',
            'view_item' => 'View Product',
            'search_items' => 'Search Products',
            'not_found' => 'No products found',
            'not_found_in_trash' => 'No products found in Trash',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-products',
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'rewrite' => array('slug' => 'products'),
        'show_in_rest' => true,
    ));

    // Register Service Taxonomy
    register_taxonomy('service', array('project', 'product'), array(
        'labels' => array(
            'name' => 'Services',
            'singular_name' => 'Service',
            'menu_name' => 'Services',
            'all_items' => 'All Services',
            'edit_item' => 'Edit Service',
            'view_item' => 'View Service',
            'update_item' => 'Update Service',
            'add_new_item' => 'Add New Service',
            'new_item_name' => 'New Service Name',
            'search_items' => 'Search Services',
            'popular_items' => 'Popular Services',
            'not_found' => 'No services found',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'rewrite' => array('slug' => 'service'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'cc_register_custom_post_types');

/**
 * Add SEO meta description for archive pages
 */
function cc_seo_meta_description() {
    if (is_post_type_archive('project')) {
        $description = 'Explore our portfolio of projects showcasing our work and services.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}
add_action( 'wp_head', 'cc_seo_meta_description' );

/**
 * Optimize images by serving scaled versions
 * Replace full size images with large size where appropriate
 */
function cc_optimize_image_sizes($html, $post_id, $post_image_id) {
    // Only optimize for project post type
    if (get_post_type($post_id) === 'project') {
        // Replace 'full' size with 'large' size in image HTML
        $html = str_replace('size-full', 'size-large', $html);
    }
    return $html;
}
add_filter('post_thumbnail_html', 'cc_optimize_image_sizes', 10, 3);

/**
 * Add admin notice for caching plugin recommendation
 */
function cc_caching_plugin_recommendation() {
    // Only show on production environments, not local
    if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
        return;
    }
    
    // Check if caching plugins are already active
    $active_plugins = get_option('active_plugins');
    $cache_plugins = array('wp-super-cache/wp-cache.php', 'w3-total-cache/w3-total-cache.php', 'wp-rocket/wp-rocket.php', 'cache-enabler/cache-enabler.php');
    
    $has_cache_plugin = false;
    foreach ($cache_plugins as $plugin) {
        if (in_array($plugin, $active_plugins)) {
            $has_cache_plugin = true;
            break;
        }
    }
    
    if (!$has_cache_plugin && current_user_can('install_plugins')) {
        echo '<div class="notice notice-warning is-dismissible">
            <p><strong>Performance Recommendation:</strong> To improve your site speed, consider installing a caching plugin like WP Super Cache, W3 Total Cache, or WP Rocket. This is especially important for shared hosting environments like InfinityFree.</p>
        </div>';
    }
}
add_action('admin_notices', 'cc_caching_plugin_recommendation');

/**
 * Enqueue lightbox assets for project gallery
 */
function cc_enqueue_lightbox_assets() {
    if (is_singular('project')) {
        // Add lightbox CSS
        wp_enqueue_style('cc-lightbox', get_template_directory_uri() . '/css/lightbox.css');
        
        // Add lightbox JS
        wp_enqueue_script('cc-lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), _S_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'cc_enqueue_lightbox_assets');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function biz_catalog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'biz_catalog_content_width', 640 );
}
add_action( 'after_setup_theme', 'biz_catalog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function biz_catalog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'biz-catalog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'biz-catalog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'biz_catalog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function biz_catalog_scripts() {
	wp_enqueue_style( 'biz-catalog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'biz-catalog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'biz-catalog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'biz_catalog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Demo Import functionality.
 */
require get_template_directory() . '/inc/demo-import.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function cc_enqueue_swiper_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'cc_enqueue_swiper_assets');

/**
 * ACF Options Page for Site Settings
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * ACF Site Settings Field Group
 */
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_site_settings',
        'title' => 'Site Settings',
        'fields' => array(
            array(
                'key' => 'field_company_name',
                'label' => 'Company Name',
                'name' => 'company_name',
                'type' => 'text',
                'instructions' => 'Your company or business name',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Your Company Name',
            ),
            array(
                'key' => 'field_company_tagline',
                'label' => 'Company Tagline',
                'name' => 'company_tagline',
                'type' => 'text',
                'instructions' => 'Short tagline or slogan',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Transforming Spaces. Crafting Futures.',
            ),
            array(
                'key' => 'field_hero_kicker',
                'label' => 'Hero Kicker Text',
                'name' => 'hero_kicker',
                'type' => 'text',
                'instructions' => 'Short text above the hero title',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Interior Designing & Modular Furniture',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'instructions' => 'Main hero heading',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Transforming Spaces. Crafting Futures.',
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'instructions' => 'Description text below the hero title',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Demo catalog showcasing our work and services.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero Background Image',
                'name' => 'hero_image',
                'type' => 'image',
                'instructions' => 'Upload a hero background image',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array(
                'key' => 'field_services_title',
                'label' => 'Services Section Title',
                'name' => 'services_title',
                'type' => 'text',
                'instructions' => 'Title for services section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Our Services',
            ),
            array(
                'key' => 'field_services_description',
                'label' => 'Services Section Description',
                'name' => 'services_description',
                'type' => 'textarea',
                'instructions' => 'Description for services section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Explore the key service categories offered by our company.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_projects_title',
                'label' => 'Projects Section Title',
                'name' => 'projects_title',
                'type' => 'text',
                'instructions' => 'Title for projects section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Latest Projects',
            ),
            array(
                'key' => 'field_projects_description',
                'label' => 'Projects Section Description',
                'name' => 'projects_description',
                'type' => 'textarea',
                'instructions' => 'Description for projects section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Explore our recent work and projects.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_about_title',
                'label' => 'About Section Title',
                'name' => 'about_title',
                'type' => 'text',
                'instructions' => 'Title for about section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'About Us',
            ),
            array(
                'key' => 'field_about_content',
                'label' => 'About Section Content',
                'name' => 'about_content',
                'type' => 'textarea',
                'instructions' => 'Main content for about section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'We are a professional company delivering high-quality services to our clients.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_about_facts',
                'label' => 'About Facts',
                'name' => 'about_facts',
                'type' => 'repeater',
                'instructions' => 'Key facts about your company',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Fact',
                'sub_fields' => array(
                    array(
                        'key' => 'field_about_facts_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => 'Year of Establishment',
                    ),
                    array(
                        'key' => 'field_about_facts_value',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '2024',
                    ),
                ),
            ),
            array(
                'key' => 'field_contact_title',
                'label' => 'Contact Section Title',
                'name' => 'contact_title',
                'type' => 'text',
                'instructions' => 'Title for contact section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Contact Us',
            ),
            array(
                'key' => 'field_contact_description',
                'label' => 'Contact Section Description',
                'name' => 'contact_description',
                'type' => 'textarea',
                'instructions' => 'Description for contact section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Use the form below to share your project details and we\'ll get back to you.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_contact_phone',
                'label' => 'Primary Phone',
                'name' => 'contact_phone',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '+91-9876543210',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => 'Contact Email',
                'name' => 'contact_email',
                'type' => 'email',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'contact@yourcompany.com',
            ),
            array(
                'key' => 'field_contact_address',
                'label' => 'Office Address',
                'name' => 'contact_address',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Your office address',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_contact_whatsapp',
                'label' => 'WhatsApp Number',
                'name' => 'contact_whatsapp',
                'type' => 'text',
                'instructions' => 'Number only or full international format.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '+919876543210',
            ),
            array(
                'key' => 'field_contact_form_shortcode',
                'label' => 'Contact Form Shortcode',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Paste a CF7 / Fluent Forms shortcode here, e.g. [contact-form-7 id="123"]',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '[contact-form-7 id="123"]',
            ),
            array(
                'key' => 'field_footer_copyright',
                'label' => 'Footer Copyright Text',
                'name' => 'footer_copyright',
                'type' => 'textarea',
                'instructions' => 'Copyright text for footer',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '© [current_year] Your Company Name. All rights reserved.',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_theme_logo',
                'label' => 'Custom Logo',
                'name' => 'theme_logo',
                'type' => 'image',
                'instructions' => 'Upload a custom logo for your site (overrides the default custom logo)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_theme_primary_color',
                'label' => 'Primary Color',
                'name' => 'theme_primary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the primary brand color for your site',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#3b82f6',
            ),
            array(
                'key' => 'field_theme_secondary_color',
                'label' => 'Secondary Color',
                'name' => 'theme_secondary_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the secondary brand color for your site',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#64748b',
            ),
            array(
                'key' => 'field_theme_accent_color',
                'label' => 'Accent Color',
                'name' => 'theme_accent_color',
                'type' => 'color_picker',
                'instructions' => 'Choose an accent color for buttons and highlights',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#f59e0b',
            ),
            array(
                'key' => 'field_theme_text_color',
                'label' => 'Text Color',
                'name' => 'theme_text_color',
                'type' => 'color_picker',
                'instructions' => 'Choose the main text color',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#1f2937',
            ),
            array(
                'key' => 'field_enable_custom_colors',
                'label' => 'Enable Custom Colors',
                'name' => 'enable_custom_colors',
                'type' => 'true_false',
                'instructions' => 'Enable custom colors throughout the site',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Use custom brand colors',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Enabled',
                'ui_off_text' => 'Disabled',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

/**
 * ACF Service Fields Field Group
 */
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_service_fields',
        'title' => 'Service Fields',
        'fields' => array(
            array(
                'key' => 'field_service_image',
                'label' => 'Service Image',
                'name' => 'service_image',
                'type' => 'image',
                'instructions' => 'Hero banner image for this service',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
            ),
            array(
                'key' => 'field_service_short_description',
                'label' => 'Short Description',
                'name' => 'service_short_description',
                'type' => 'textarea',
                'instructions' => 'Brief description for this service',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Description of this service',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_service_icon',
                'label' => 'Service Icon',
                'name' => 'service_icon',
                'type' => 'image',
                'instructions' => 'Optional icon for this service',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array(
                'key' => 'field_service_color',
                'label' => 'Service Color',
                'name' => 'service_color',
                'type' => 'color_picker',
                'instructions' => 'Accent color for this service',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'service',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

/**
 * ACF Project Details Field Group
 */
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_project_details',
        'title' => 'Project Details',
        'fields' => array(
            array(
                'key' => 'field_gallery_images',
                'label' => 'Gallery Images',
                'name' => 'gallery_images',
                'type' => 'gallery',
                'instructions' => 'Upload multiple images for the project gallery',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'preview_size' => 'large',
                'parent_repeater' => 'field_project_specs',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_project_specs',
                'label' => 'Project Specifications',
                'name' => 'project_specs',
                'type' => 'repeater',
                'instructions' => 'Add specifications like area, budget, materials, etc.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Specification',
                'sub_fields' => array(
                    array(
                        'key' => 'field_project_specs_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => 'e.g. Area, Budget, Materials',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => 'Area',
                    ),
                    array(
                        'key' => 'field_project_specs_value',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'instructions' => 'e.g. 1200 sq.ft, $50,000',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '1200 sq.ft',
                    ),
                ),
            ),
            array(
                'key' => 'field_project_featured',
                'label' => 'Featured Project',
                'name' => 'project_featured',
                'type' => 'true_false',
                'instructions' => 'Mark this project as featured',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_project_client_name',
                'label' => 'Client Name',
                'name' => 'project_client_name',
                'type' => 'text',
                'instructions' => 'Name of the client or company',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Client Name',
            ),
            array(
                'key' => 'field_project_location',
                'label' => 'Project Location',
                'name' => 'project_location',
                'type' => 'text',
                'instructions' => 'City or address where the project is located',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'New York, USA',
            ),
            array(
                'key' => 'field_project_year',
                'label' => 'Completion Year',
                'name' => 'project_year',
                'type' => 'number',
                'instructions' => 'Year when the project was completed',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_project_budget',
                'label' => 'Budget',
                'name' => 'project_budget',
                'type' => 'text',
                'instructions' => 'Budget range or total cost',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '$50,000 - $100,000',
            ),
            array(
                'key' => 'field_project_area',
                'label' => 'Project Area',
                'name' => 'project_area',
                'type' => 'text',
                'instructions' => 'Area in sq.ft or sq.m',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '1200 sq.ft',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

/**
 * ACF Product Fields Field Group
 */
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_product_details',
        'title' => 'Product Details',
        'fields' => array(
            array(
                'key' => 'field_product_price',
                'label' => 'Price',
                'name' => 'product_price',
                'type' => 'text',
                'instructions' => 'Product price (e.g. $99.99 or starting from $500)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '$99.99',
            ),
            array(
                'key' => 'field_product_sku',
                'label' => 'SKU',
                'name' => 'product_sku',
                'type' => 'text',
                'instructions' => 'Product SKU or model number',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'SKU-001',
            ),
            array(
                'key' => 'field_product_gallery',
                'label' => 'Product Gallery',
                'name' => 'product_gallery',
                'type' => 'gallery',
                'instructions' => 'Upload multiple images for the product gallery',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'preview_size' => 'large',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_product_specifications',
                'label' => 'Product Specifications',
                'name' => 'product_specifications',
                'type' => 'repeater',
                'instructions' => 'Add product specifications like dimensions, materials, etc.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Specification',
                'sub_fields' => array(
                    array(
                        'key' => 'field_product_spec_label',
                        'label' => 'Label',
                        'name' => 'label',
                        'type' => 'text',
                        'instructions' => 'e.g. Dimensions, Weight, Material',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => 'Dimensions',
                    ),
                    array(
                        'key' => 'field_product_spec_value',
                        'label' => 'Value',
                        'name' => 'value',
                        'type' => 'text',
                        'instructions' => 'e.g. 120cm x 80cm, 25kg, Oak Wood',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '120cm x 80cm',
                    ),
                ),
            ),
            array(
                'key' => 'field_product_featured',
                'label' => 'Featured Product',
                'name' => 'product_featured',
                'type' => 'true_false',
                'instructions' => 'Mark this product as featured',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_product_short_description',
                'label' => 'Short Description',
                'name' => 'product_short_description',
                'type' => 'textarea',
                'instructions' => 'Brief product description for listings',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Brief description of the product...',
                'new_lines' => 'br',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

function cc_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="cc-breadcrumbs" aria-label="Breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">Home</a>';

    if (is_post_type_archive('project')) {
        echo ' <span class="sep">/</span> ';
        echo '<span>Projects</span>';

    } elseif (is_singular('project')) {
        // Single Project
        $services = get_the_terms(get_the_ID(), 'service');

        echo ' <span class="sep">/</span> ';
        echo '<a href="' . esc_url(get_post_type_archive_link('project')) . '">Projects</a>';

        if (!empty($services) && !is_wp_error($services)) {
            $service = $services[0];

            echo ' <span class="sep">/</span> ';
            echo '<a href="' . esc_url(get_term_link($service)) . '">' . esc_html($service->name) . '</a>';
        }

        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html(get_the_title()) . '</span>';

    } elseif (is_tax('service')) {
        // Service archive
        $service = get_queried_object();

        echo ' <span class="sep">/</span> ';
        echo '<a href="' . esc_url(get_post_type_archive_link('project')) . '">Projects</a>';

        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html($service->name) . '</span>';

    } elseif (is_page()) {
        // Generic page fallback
        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html(get_the_title()) . '</span>';
    }

    echo '</nav>';
}

/**
 * Output custom theme colors as CSS custom properties
 */
function cc_output_custom_colors() {
    if (get_field('enable_custom_colors', 'option')) {
        $primary_color = get_field('theme_primary_color', 'option') ?: '#3b82f6';
        $secondary_color = get_field('theme_secondary_color', 'option') ?: '#64748b';
        $accent_color = get_field('theme_accent_color', 'option') ?: '#f59e0b';
        $text_color = get_field('theme_text_color', 'option') ?: '#1f2937';
        
        echo '<style id="cc-custom-colors">';
        echo ':root {';
        echo '--cc-primary-color: ' . esc_attr($primary_color) . ';';
        echo '--cc-secondary-color: ' . esc_attr($secondary_color) . ';';
        echo '--cc-accent-color: ' . esc_attr($accent_color) . ';';
        echo '--cc-text-color: ' . esc_attr($text_color) . ';';
        echo '}';
        echo '</style>';
    }
}
add_action('wp_head', 'cc_output_custom_colors');

/**
 * Get custom logo URL or fallback to default
 */
function cc_get_custom_logo_url() {
    $custom_logo = get_field('theme_logo', 'option');
    
    if ($custom_logo && isset($custom_logo['url'])) {
        return $custom_logo['url'];
    }
    
    // Fallback to default custom logo
    $default_logo = get_theme_mod('custom_logo');
    if ($default_logo) {
        return wp_get_attachment_image_url($default_logo, 'full');
    }
    
    return false;
}
