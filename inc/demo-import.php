<?php
/**
 * Demo Content Import Functionality
 *
 * @package Biz_Catalog
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Demo Import admin menu
 */
function cc_demo_import_menu() {
    add_theme_page(
        'Demo Import',
        'Demo Import',
        'manage_options',
        'cc-demo-import',
        'cc_demo_import_page'
    );
}
add_action('admin_menu', 'cc_demo_import_menu');

/**
 * Demo Import admin page
 */
function cc_demo_import_page() {
    ?>
    <div class="wrap">
        <h1>Demo Content Import</h1>
        <div class="cc-demo-import-container">
            <div class="cc-demo-import-info">
                <h2>Import Demo Content</h2>
                <p>Import sample projects, products, and services to get started quickly with your furniture catalog website.</p>
                <p><strong>Note:</strong> This will create sample content including:</p>
                <ul>
                    <li>3-4 Sample Projects</li>
                    <li>6-8 Sample Products</li>
                    <li>3-4 Service Categories</li>
                    <li>Basic Site Settings</li>
                </ul>
                <p><strong>Warning:</strong> This action cannot be undone. It's recommended to backup your site first.</p>
            </div>
            
            <div class="cc-demo-import-actions">
                <button id="cc-import-demo-content" class="button button-primary button-large">
                    Import Demo Content
                </button>
                <button id="cc-clear-demo-content" class="button button-secondary">
                    Clear Demo Content
                </button>
                <div id="cc-import-status"></div>
            </div>
        </div>
    </div>

    <style>
        .cc-demo-import-container {
            display: flex;
            gap: 40px;
            margin-top: 20px;
        }
        .cc-demo-import-info {
            flex: 2;
            background: #fff;
            padding: 20px;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .cc-demo-import-actions {
            flex: 1;
            background: #fff;
            padding: 20px;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
            text-align: center;
        }
        .cc-demo-import-actions button {
            margin: 5px;
            width: 100%;
        }
        #cc-import-status {
            margin-top: 15px;
            padding: 10px;
            border-radius: 4px;
            display: none;
        }
        #cc-import-status.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        #cc-import-status.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        #cc-import-status.loading {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>

    <script>
    jQuery(document).ready(function($) {
        $('#cc-import-demo-content').click(function() {
            var button = $(this);
            var status = $('#cc-import-status');
            
            button.prop('disabled', true).text('Importing...');
            status.removeClass('success error').addClass('loading').text('Importing demo content, please wait...').show();
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'cc_import_demo_content',
                    nonce: '<?php echo wp_create_nonce('cc_demo_import_nonce'); ?>'
                },
                success: function(response) {
                    if (response.success) {
                        status.removeClass('loading').addClass('success').text('Demo content imported successfully!');
                        button.text('Import Complete');
                    } else {
                        status.removeClass('loading').addClass('error').text('Error: ' + response.data);
                        button.prop('disabled', false).text('Import Demo Content');
                    }
                },
                error: function() {
                    status.removeClass('loading').addClass('error').text('An error occurred during import.');
                    button.prop('disabled', false).text('Import Demo Content');
                }
            });
        });

        $('#cc-clear-demo-content').click(function() {
            if (!confirm('Are you sure you want to clear all demo content? This action cannot be undone.')) {
                return;
            }
            
            var button = $(this);
            var status = $('#cc-import-status');
            
            button.prop('disabled', true).text('Clearing...');
            status.removeClass('success error').addClass('loading').text('Clearing demo content, please wait...').show();
            
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'cc_clear_demo_content',
                    nonce: '<?php echo wp_create_nonce('cc_demo_import_nonce'); ?>'
                },
                success: function(response) {
                    if (response.success) {
                        status.removeClass('loading').addClass('success').text('Demo content cleared successfully!');
                        button.text('Clear Complete');
                    } else {
                        status.removeClass('loading').addClass('error').text('Error: ' + response.data);
                        button.prop('disabled', false).text('Clear Demo Content');
                    }
                },
                error: function() {
                    status.removeClass('loading').addClass('error').text('An error occurred during clearing.');
                    button.prop('disabled', false).text('Clear Demo Content');
                }
            });
        });
    });
    </script>
    <?php
}

/**
 * Handle demo content import via AJAX
 */
function cc_handle_demo_import() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'cc_demo_import_nonce')) {
        wp_die('Security check failed');
    }

    // Check permissions
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient permissions');
    }

    // Import demo content
    $result = cc_create_demo_content();
    
    if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
    } else {
        wp_send_json_success('Demo content imported successfully');
    }
}
add_action('wp_ajax_cc_import_demo_content', 'cc_handle_demo_import');

/**
 * Handle demo content clearing via AJAX
 */
function cc_handle_demo_clear() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'cc_demo_import_nonce')) {
        wp_die('Security check failed');
    }

    // Check permissions
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient permissions');
    }

    // Clear demo content
    $result = cc_clear_demo_content();
    
    if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
    } else {
        wp_send_json_success('Demo content cleared successfully');
    }
}
add_action('wp_ajax_cc_clear_demo_content', 'cc_handle_demo_clear');

/**
 * Create demo content
 */
function cc_create_demo_content() {
    try {
        // Create services first
        $services = cc_create_demo_services();
        
        // Create projects
        $projects = cc_create_demo_projects($services);
        
        // Create products
        $products = cc_create_demo_products($services);
        
        // Set demo site settings
        cc_set_demo_site_settings();
        
        // Flush rewrite rules
        flush_rewrite_rules();
        
        return true;
    } catch (Exception $e) {
        return new WP_Error('demo_import_failed', $e->getMessage());
    }
}

/**
 * Create demo services
 */
function cc_create_demo_services() {
    $services_data = array(
        array(
            'name' => 'Interior Design',
            'slug' => 'interior-design',
            'description' => 'Complete interior design solutions for residential and commercial spaces.'
        ),
        array(
            'name' => 'Modular Furniture',
            'slug' => 'modular-furniture',
            'description' => 'Custom modular furniture solutions that adapt to your space and needs.'
        ),
        array(
            'name' => 'Kitchen Design',
            'slug' => 'kitchen-design',
            'description' => 'Modern kitchen design and installation services with premium finishes.'
        ),
        array(
            'name' => 'Office Furniture',
            'slug' => 'office-furniture',
            'description' => 'Professional office furniture solutions for productive workspaces.'
        )
    );

    $services = array();
    
    foreach ($services_data as $service_data) {
        $term = wp_insert_term(
            $service_data['name'],
            'service',
            array(
                'slug' => $service_data['slug'],
                'description' => $service_data['description']
            )
        );
        
        if (!is_wp_error($term)) {
            $services[] = get_term($term['term_id']);
        }
    }
    
    return $services;
}

/**
 * Create demo projects
 */
function cc_create_demo_projects($services) {
    $projects_data = array(
        array(
            'title' => 'Modern Office Renovation',
            'content' => 'A complete office transformation featuring contemporary design elements, modular workstations, and collaborative spaces. The project included custom-built furniture, lighting design, and space optimization.',
            'excerpt' => 'Contemporary office renovation with custom modular furniture and collaborative spaces.',
            'client' => 'Tech Solutions Inc.',
            'location' => 'Mumbai, India',
            'year' => 2024,
            'budget' => '$75,000 - $100,000',
            'area' => '2500 sq.ft',
            'featured' => true
        ),
        array(
            'title' => 'Luxury Kitchen Makeover',
            'content' => 'High-end kitchen renovation featuring premium materials, custom cabinetry, and state-of-the-art appliances. The design emphasizes functionality and aesthetic appeal.',
            'excerpt' => 'Premium kitchen renovation with custom cabinetry and modern appliances.',
            'client' => 'The Sharma Residence',
            'location' => 'Delhi, India',
            'year' => 2024,
            'budget' => '$50,000 - $75,000',
            'area' => '400 sq.ft',
            'featured' => true
        ),
        array(
            'title' => 'Residential Interior Design',
            'content' => 'Complete home interior design project covering living areas, bedrooms, and dining space. The design incorporates modern furniture with traditional Indian elements.',
            'excerpt' => 'Complete home interior design with modern and traditional elements.',
            'client' => 'The Patel Family',
            'location' => 'Bangalore, India',
            'year' => 2023,
            'budget' => '$40,000 - $60,000',
            'area' => '1800 sq.ft',
            'featured' => false
        )
    );

    $projects = array();
    
    foreach ($projects_data as $index => $project_data) {
        $post_data = array(
            'post_title' => $project_data['title'],
            'post_content' => $project_data['content'],
            'post_excerpt' => $project_data['excerpt'],
            'post_status' => 'publish',
            'post_type' => 'project',
            'post_author' => get_current_user_id()
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            // Assign service
            if (!empty($services[$index % count($services)])) {
                wp_set_post_terms($post_id, array($services[$index % count($services)]->term_id), 'service');
            }
            
            // Update ACF fields
            if (function_exists('update_field')) {
                update_field('field_project_client_name', $project_data['client'], $post_id);
                update_field('field_project_location', $project_data['location'], $post_id);
                update_field('field_project_year', $project_data['year'], $post_id);
                update_field('field_project_budget', $project_data['budget'], $post_id);
                update_field('field_project_area', $project_data['area'], $post_id);
                update_field('field_project_featured', $project_data['featured'], $post_id);
                
                // Add sample specifications
                $specs = array(
                    array('label' => 'Client', 'value' => $project_data['client']),
                    array('label' => 'Location', 'value' => $project_data['location']),
                    array('label' => 'Area', 'value' => $project_data['area']),
                    array('label' => 'Budget', 'value' => $project_data['budget'])
                );
                update_field('field_project_specs', $specs, $post_id);
            }
            
            $projects[] = get_post($post_id);
        }
    }
    
    return $projects;
}

/**
 * Create demo products
 */
function cc_create_demo_products($services) {
    $products_data = array(
        array(
            'title' => 'Executive Office Desk',
            'content' => 'Premium executive desk crafted from high-quality oak wood with modern design elements. Features built-in cable management and storage solutions.',
            'excerpt' => 'Premium oak executive desk with modern design and cable management.',
            'price' => '$1,299',
            'sku' => 'EXEC-DSK-001',
            'short_description' => 'Premium executive desk with oak finish and modern design.',
            'featured' => true
        ),
        array(
            'title' => 'Modular Sofa Set',
            'content' => 'Comfortable modular sofa system that can be configured in multiple arrangements. Upholstered in premium fabric with solid wood frame.',
            'excerpt' => 'Configurable modular sofa system with premium fabric upholstery.',
            'price' => 'Starting from $1,899',
            'sku' => 'MOD-SOF-002',
            'short_description' => 'Modular sofa system with premium fabric and solid wood frame.',
            'featured' => true
        ),
        array(
            'title' => 'Modern Dining Table',
            'content' => 'Sleek dining table with tempered glass top and stainless steel legs. Seats up to 6 people comfortably.',
            'excerpt' => 'Modern dining table with glass top and steel legs, seats 6.',
            'price' => '$899',
            'sku' => 'DIN-TBL-003',
            'short_description' => 'Modern dining table with tempered glass top for 6 people.',
            'featured' => false
        ),
        array(
            'title' => 'Ergonomic Office Chair',
            'content' => 'Ergonomically designed office chair with adjustable height, lumbar support, and breathable mesh back.',
            'excerpt' => 'Ergonomic office chair with adjustable features and mesh back.',
            'price' => '$449',
            'sku' => 'OFF-CHR-004',
            'short_description' => 'Ergonomic office chair with adjustable height and lumbar support.',
            'featured' => false
        ),
        array(
            'title' => 'Bookshelf Unit',
            'content' => 'Multi-tier bookshelf with adjustable shelves and modern design. Perfect for displaying books and decorative items.',
            'excerpt' => 'Multi-tier bookshelf with adjustable shelves and modern design.',
            'price' => '$599',
            'sku' => 'BOOK-SHF-005',
            'short_description' => 'Adjustable bookshelf with modern design for books and decor.',
            'featured' => false
        ),
        array(
            'title' => 'Bedroom Furniture Set',
            'content' => 'Complete bedroom furniture set including bed frame, nightstands, and dresser. Crafted from sustainable wood with contemporary finish.',
            'excerpt' => 'Complete bedroom set with bed frame, nightstands, and dresser.',
            'price' => 'Starting from $2,299',
            'sku' => 'BED-SET-006',
            'short_description' => 'Complete bedroom furniture set with sustainable wood construction.',
            'featured' => true
        )
    );

    $products = array();
    
    foreach ($products_data as $index => $product_data) {
        $post_data = array(
            'post_title' => $product_data['title'],
            'post_content' => $product_data['content'],
            'post_excerpt' => $product_data['excerpt'],
            'post_status' => 'publish',
            'post_type' => 'product',
            'post_author' => get_current_user_id()
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            // Assign service
            if (!empty($services[$index % count($services)])) {
                wp_set_post_terms($post_id, array($services[$index % count($services)]->term_id), 'service');
            }
            
            // Update ACF fields
            if (function_exists('update_field')) {
                update_field('field_product_price', $product_data['price'], $post_id);
                update_field('field_product_sku', $product_data['sku'], $post_id);
                update_field('field_product_short_description', $product_data['short_description'], $post_id);
                update_field('field_product_featured', $product_data['featured'], $post_id);
                
                // Add sample specifications
                $specs = array(
                    array('label' => 'SKU', 'value' => $product_data['sku']),
                    array('label' => 'Material', 'value' => 'Premium Wood/Metal'),
                    array('label' => 'Warranty', 'value' => '2 Years')
                );
                update_field('field_product_specifications', $specs, $post_id);
            }
            
            $products[] = get_post($post_id);
        }
    }
    
    return $products;
}

/**
 * Set demo site settings
 */
function cc_set_demo_site_settings() {
    if (function_exists('update_field')) {
        // Company information
        update_field('field_company_name', 'MR Furniture & Interiors', 'option');
        update_field('field_company_tagline', 'Transforming Spaces. Crafting Futures.', 'option');
        
        // Hero section
        update_field('field_hero_kicker', 'Interior Designing & Modular Furniture', 'option');
        update_field('field_hero_title', 'Transforming Spaces. Crafting Futures.', 'option');
        update_field('field_hero_subtitle', 'We create beautiful, functional spaces that reflect your style and meet your needs. From residential interiors to commercial projects, our expertise brings your vision to life.', 'option');
        
        // Section titles and descriptions
        update_field('field_services_title', 'Our Services', 'option');
        update_field('field_services_description', 'Explore the key service categories offered by our company.', 'option');
        update_field('field_projects_title', 'Latest Projects', 'option');
        update_field('field_projects_description', 'Explore our recent work and projects.', 'option');
        update_field('field_about_title', 'About Us', 'option');
        update_field('field_about_content', 'With over a decade of experience in interior design and furniture manufacturing, we pride ourselves on delivering exceptional quality and service. Our team of skilled designers and craftsmen work together to create spaces that are both beautiful and functional.', 'option');
        update_field('field_contact_title', 'Contact Us', 'option');
        update_field('field_contact_description', 'Use the form below to share your project details and we\'ll get back to you.', 'option');
        
        // Contact information
        update_field('field_contact_phone', '+91-9876543210', 'option');
        update_field('field_contact_email', 'contact@mrfurniture.com', 'option');
        update_field('field_contact_address', '123 Design Street, Furniture District, Mumbai, Maharashtra 400001', 'option');
        update_field('field_contact_whatsapp', '+919876543210', 'option');
        
        // Footer
        update_field('field_footer_copyright', '© 2024 MR Furniture & Interiors. All rights reserved.', 'option');
        
        // Demo facts
        $facts = array(
            array('label' => 'Years of Experience', 'value' => '12+'),
            array('label' => 'Projects Completed', 'value' => '500+'),
            array('label' => 'Happy Clients', 'value' => '300+'),
            array('label' => 'Design Awards', 'value' => '8')
        );
        update_field('field_about_facts', $facts, 'option');
        
        // Enable custom colors
        update_field('field_enable_custom_colors', true, 'option');
        update_field('field_theme_primary_color', '#3b82f6', 'option');
        update_field('field_theme_secondary_color', '#64748b', 'option');
        update_field('field_theme_accent_color', '#f59e0b', 'option');
        update_field('field_theme_text_color', '#1f2937', 'option');
    }
}

/**
 * Clear demo content
 */
function cc_clear_demo_content() {
    try {
        // Delete all projects
        $projects = get_posts(array(
            'post_type' => 'project',
            'numberposts' => -1,
            'post_status' => 'any'
        ));
        
        foreach ($projects as $project) {
            wp_delete_post($project->ID, true);
        }
        
        // Delete all products
        $products = get_posts(array(
            'post_type' => 'product',
            'numberposts' => -1,
            'post_status' => 'any'
        ));
        
        foreach ($products as $product) {
            wp_delete_post($product->ID, true);
        }
        
        // Delete all services
        $services = get_terms(array(
            'taxonomy' => 'service',
            'hide_empty' => false
        ));
        
        foreach ($services as $service) {
            wp_delete_term($service->term_id, 'service');
        }
        
        return true;
    } catch (Exception $e) {
        return new WP_Error('demo_clear_failed', $e->getMessage());
    }
}