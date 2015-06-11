<?php
    /**
     *
     * @package scf-framework
     * @author Steve
     * @date 6/10/2015
     *
     * Plugin Name: RJS Logistics Loads/Trucks Manager
     * Author: Steve Fischer
     * Version: 0.1
     */
    define('WPRJS_VERSION', '0.1');
    define('WPRJS_REQUIRED_WP_VERSION', '4.1');
    define('WPRJS_PLUGIN', __FILE__);
    define('WPRJS_PLUGIN_BASENAME', plugin_basename( WPRJS_PLUGIN ));
    define('WPRJS_PLUGIN_NAME', trim( dirname( WPRJS_PLUGIN_BASENAME ), '/' ));
    define('WPRJS_PLUGIN_DIR', untrailingslashit( dirname( WPRJS_PLUGIN ) ));
    define('WPRJS_PLUGIN_TEMPLATES_DIR', WPRJS_PLUGIN_DIR.'/templates');

    class wprjs
    {
        function wprjs(){
            global $wpdb;
            add_action( 'wp_enqueue_scripts', array($this, 'angularScripts') );
            add_filter( 'json_insert_post', array($this, 'post_add_tax'), 10, 3 );
            add_filter( 'template_include', array($this, 'template_override') );
        }

        function angularScripts(){
            // Angular Core
            wp_enqueue_script(
                'angular-core', plugin_dir_url( __FILE__ ).'js/angular.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-sanitize', plugin_dir_url( __FILE__ ).
                'js/angular-sanitize.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-route', plugin_dir_url( __FILE__ ).'js/angular-route.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'html-janitor', plugin_dir_url( __FILE__ ).'js/html-janitor.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-app', plugin_dir_url( __FILE__ ).'js/angular-app.js', array('html-janitor'), NULL, false );
            // Angular Factories
            /*wp_enqueue_script(
                'angular-factories', plugin_dir_url( __FILE__ ).
                'js/angular-factories.js', array('angular-app'), NULL, false );*/
            // Angular Directives
            /*wp_enqueue_script(
                'angular-post-directives', plugin_dir_url( __FILE__ ).
                'js/angular-posts-directives.js', array('angular-factories'), NULL, false );*/
            // Template Directory
            $template_directory = array(
                'list_detail'   => plugin_dir_url( __FILE__ ).'angularjs-templates/list-detail.html',
                'single_detail' => plugin_dir_url( __FILE__ ).'angularjs-templates/single-detail.html',
                'new_post'      => plugin_dir_url( __FILE__ ).'angularjs-templates/new-post.html',
                'post_content'  => plugin_dir_url( __FILE__ ).'angularjs-templates/post-content.html',
            );
            // TEMPLATE OVERRIDES
            if( file_exists( get_stylesheet_directory().'/angularjs-templates/list-detail.html' ) ){
                $template_directory['list_detail'] =
                    get_stylesheet_directory_uri().'/angularjs-templates/list-detail.html';
            }
            if( file_exists( get_stylesheet_directory().'/angularjs-templates/single-detail.html' ) ){
                $template_directory['single_detail'] =
                    get_stylesheet_directory_uri().'/angularjs-templates/single-detail.html';
            }
            if( file_exists( get_stylesheet_directory().'/angularjs-templates/new-post.html' ) ){
                $template_directory['new_post'] = get_stylesheet_directory_uri().'/angularjs-templates/new-post.html';
            }
            if( file_exists( get_stylesheet_directory().'/angularjs-templates/post-content.html' ) ){
                $template_directory['post_content'] =
                    get_stylesheet_directory_uri().'/angularjs-templates/post-content.html';
            }
            // Localize Variables
            wp_localize_script(
                'angular-core',
                'wfcLocalized',
                array(
                    'site'               => get_bloginfo( 'wpurl' ),
                    'base'               => json_url(),
                    'nonce'              => wp_create_nonce( 'wp_json' ),
                    'template_directory' => $template_directory
                )
            );
        }

        function post_add_tax( $post, $data, $update ){
            foreach( $data['post_taxonomies'] as $term => $tax ){
                wp_set_post_terms( $post['ID'], array(intval( $term )), $tax, true );
            }
        }

        function template_override( $template ){
            /*
             * Optional: Have a plug-in option to disable template handling
             * if( get_option('wpse72544_disable_template_handling') )
             *     return $template;
             */
            if( is_singular( 'post' ) && 'single.php' != $template ){
                //WordPress couldn't find an 'event' template. Use plug-in instead:
                $template = WPRJS_PLUGIN_TEMPLATES_DIR.'/single.php';
            }
            return $template;
        }
    }

    new wprjs();
    // Register Custom Post Type
    function wfc_register_post_type(){
        $labels = array(
            'name'               => _x( 'Load', 'Post Type General Name', 'text_domain' ),
            'singular_name'      => _x( 'Loads', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'          => __( 'Post Load', 'text_domain' ),
            'name_admin_bar'     => __( 'Post Load', 'text_domain' ),
            'parent_item_colon'  => __( 'Parent Item:', 'text_domain' ),
            'all_items'          => __( 'All Items', 'text_domain' ),
            'add_new_item'       => __( 'Add New Item', 'text_domain' ),
            'add_new'            => __( 'Add New', 'text_domain' ),
            'new_item'           => __( 'New Item', 'text_domain' ),
            'edit_item'          => __( 'Edit Item', 'text_domain' ),
            'update_item'        => __( 'Update Item', 'text_domain' ),
            'view_item'          => __( 'View Item', 'text_domain' ),
            'search_items'       => __( 'Search Item', 'text_domain' ),
            'not_found'          => __( 'Not found', 'text_domain' ),
            'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
        );
        $args   = array(
            'label'               => __( 'wfc_loads', 'text_domain' ),
            'description'         => __( 'RJS Loads', 'text_domain' ),
            'labels'              => $labels,
            'supports'            => array('title', 'custom-fields'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'show_in_admin_bar'   => false,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'wfc_loads', $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'wfc_register_post_type', 0 );
    function wp_api_encode_acf( $data, $post, $context ){
        $data['meta'] = array_merge( $data['meta'], get_fields( $post['ID'] ) );
        return $data;
    }

    if( function_exists( 'get_fields' ) ){
        add_filter( 'json_prepare_post', 'wp_api_encode_acf', 10, 3 );
    }