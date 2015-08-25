<?php
    /**
     *
     * @package scf-framework
     * @author Steve
     * @date 6/10/2015
     *
     * Plugin Name: RJS Logistics Loads/Trucks Manager
     * Author: Steve Fischer
     * Version: 0.2
     */
    define( 'WPRJS_VERSION', '0.1' );
    define( 'WPRJS_REQUIRED_WP_VERSION', '4.1' );
    define( 'WPRJS_PLUGIN', __FILE__ );
    define( 'WPRJS_PLUGIN_BASENAME', plugin_basename( WPRJS_PLUGIN ) );
    define( 'WPRJS_PLUGIN_NAME', trim( dirname( WPRJS_PLUGIN_BASENAME ), '/' ) );
    define( 'WPRJS_PLUGIN_DIR', untrailingslashit( dirname( WPRJS_PLUGIN ) ) );
    define( 'WPRJS_PLUGIN_TEMPLATES_DIR', WPRJS_PLUGIN_DIR.'/templates' );
    define( 'WPRJS_SITEURL', get_site_url() );
    define( 'WPRJS_PATH', plugin_dir_url( __FILE__ ) );
    define( 'WPRJS_PARTIALS_PATH', WPRJS_PLUGIN_DIR.'/partials/' );
    require_once('includes/rjs_routes.php');
    require_once('includes/rjs_utilities.php');
    require_once('includes/rjs_post_type_manager.php');
    /*
    ===============================
    REGISTER CUSTOM POST TYPE WITH CUSTOM META BOX OPTIONS
    ===============================
    */
    $load_cpt_args  = array(
        'cpt'       => 'rjs_loads' /* CPT Name */,
        'menu_name' => 'RJS POST LOADS' /* Overide the name above */,
        'supports'  => array('custom-fields'),
        'meta_box'  => array(
            'title'     => 'Loads Custom Fields',
            'new_boxes' => array(
                array(
                    'field_title' => 'Origin City: ',
                    'type_of_box' => 'text',
                ),
                array(
                    'field_title' => 'Origin State: ',
                    'type_of_box' => 'select',
                    'options'     => $us_states_array, /* required */
                ),
                array(
                    'field_title' => 'Dest. City: ',
                    'type_of_box' => 'text',
                ),
                array(
                    'field_title' => 'Dest. State: ',
                    'type_of_box' => 'select',
                    'options'     => $us_states_array, /* required */
                ),
                array(
                    'field_title' => 'Trailer Type: ',
                    'type_of_box' => 'select',
                    'options'     => $rjs_trailer_type, /* required */
                ),
                array(
                    'field_title' => 'Trailer Options: ',
                    'type_of_box' => 'checkbox',
                    'options'     => $rjs_trailer_options, /* required */
                ),
                array(
                    'field_title' => 'Size: ',
                    'type_of_box' => 'select',
                    'options'     => $rjs_trailer_size, /* required */
                ),
                array(
                    'field_title' => 'Pickup Date: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Amount: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Width: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Distance: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Qty: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Pickup Time: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Length: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Extra Stops: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Deliver Date: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Weight: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Deliver Time: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Special Information: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Handle: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Handle Phone: ',
                    'type_of_box' => 'text'
                ),
                array(
                    'field_title' => 'Add to Favorite Posts: ',
                    'type_of_box' => 'checkbox',
                    'options'     => $rjs_add_fav,
                ),
                array(
                    'field_title' => 'Daily: ',
                    'type_of_box' => 'checkbox',
                    'options'     => $rjs_daily,
                )
            )
        ),
    );
    $load_cpt       = new wfcfw( $load_cpt_args );
    $truck_cpt_args = array(
        'cpt'       => 'rjs_trucks' /* CPT Name */,
        'menu_name' => 'RJS POST TRUCKS' /* Overide the name above */,
        'supports'  => array(),
        'meta_box'  => array(
            'title'     => 'Loads Custom Fields',
            'new_boxes' => $rjs_custom_fields_trucks
        )
    );
    $truck_cpt      = new wfcfw( $truck_cpt_args );

    class wprjs
    {
        function wprjs(){
            global $wpdb;
            add_action( 'wp_enqueue_scripts', array($this, 'angularScripts') );
            add_filter( 'json_insert_post', array($this, 'post_add_tax'), 10, 3 );
        }

        function angularScripts(){
            global $us_states_array;
            global $rjs_trailer_type;
            global $rjs_trailer_size;
            wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css' );
            wp_enqueue_style( 'rjs-styles', plugin_dir_url( __FILE__ ).'css/styles.css' );
            // Angular Core
            wp_enqueue_script(
                'angular-core', plugin_dir_url( __FILE__ ).'js/angular.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-resource', plugin_dir_url( __FILE__ ).
                'js/angular-resource.min.js', array('angular-core'), NULL, false );
            wp_enqueue_script(
                'angular-bootstrap-tables', plugin_dir_url( __FILE__ ).
                'js/angular-smart-table.min.js', array('angular-core'), NULL, false );
            wp_enqueue_script(
                'angular-sanitize', plugin_dir_url( __FILE__ ).
                'js/angular-sanitize.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-route', plugin_dir_url( __FILE__ ).'js/angular-route.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'html-janitor', plugin_dir_url( __FILE__ ).'js/html-janitor.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'angular-app', plugin_dir_url( __FILE__ ).'js/angular-app.js', array('html-janitor'), NULL, false );
            wp_enqueue_script(
                'rjs-controllers', plugin_dir_url( __FILE__ ).
                'js/rjs-controllers.js', array('angular-app'), NULL, false );
            wp_enqueue_script(
                'rjs-services', plugin_dir_url( __FILE__ ).'js/rjs-services.js', array(
                'angular-app',
                'rjs-controllers'
            ), NULL, false );
            wp_enqueue_script(
                'rjs-directives', plugin_dir_url( __FILE__ ).'js/rjs-directives.js', array(
                'angular-app',
                'rjs-controllers'
            ), NULL, false );
            wp_enqueue_script(
                'angular-animate', plugin_dir_url( __FILE__ ).'js/angular-animate.min.js', array(
                'angular-app'
            ), NULL, false );
            wp_enqueue_script(
                'rjs-ng-csv', plugin_dir_url( __FILE__ ).'js/ng-csv.min.js', array(
                'angular-app'
            ), NULL, false );
            wp_enqueue_script(
                'bootstrap-main', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'rjs-core-js', plugin_dir_url( __FILE__ ).'js/rjs.jquery.fn.js', array('jquery'), NULL, false );
            wp_enqueue_script(
                'bootstrap-angularjs', plugin_dir_url( __FILE__ ).
                'js/ui-bootstrap-angular.min.js', array('bootstrap-main'), NULL, false );
            // Template Directory
            $partials_directory = array(
                'rjs_loads'            => plugin_dir_url( __FILE__ ).'partials/post-rjs_loads.php',
                'rjs_trucks'           => plugin_dir_url( __FILE__ ).'partials/post-rjs_trucks.php',
                'favorite_truck_posts' => plugin_dir_url( __FILE__ ).'partials/favorite-truck-posts.php',
                'favorite_load_posts'  => plugin_dir_url( __FILE__ ).'partials/favorite-load-posts.php',
                'rjs_pagination'       => plugin_dir_url( __FILE__ ).'partials/rjs.pagination.html',
                'rjs_search_form'           => plugin_dir_url( __FILE__ ).'partials/search-form.php',
                'rjs_search_page'           => plugin_dir_url( __FILE__ ).'partials/post-search.php',
                'rjs_nav_section'           => plugin_dir_url( __FILE__ ).'partials/nav-section.php',
                'rjs_footer'           => plugin_dir_url( __FILE__ ).'partials/rjs-footer.php',
            );
            // Localize Variables
            $json_us_states = array();
            foreach( $us_states_array as $row ){
                $json_us_states[] = array('name' => $row, 'value' => $row);
            }
            $json_trailer_type = array();
            foreach( $rjs_trailer_type as $row ){
                $json_trailer_type[] = array('name' => $row, 'value' => $row);
            }
            $json_trailer_size = array();
            foreach( $rjs_trailer_size as $row_k => $row_v ){
                $json_trailer_size[] = array('name' => $row_v, 'value' => $row_k);
            }
            wp_localize_script(
                'angular-core',
                'wfcLocalized',
                array(
                    'site'               => get_bloginfo( 'wpurl' ),
                    'base'               => json_url(),
                    'ajax_url'           => admin_url( 'admin-ajax.php' ),
                    'nonce'              => wp_create_nonce( 'wp_json' ),
                    'template_directory' => $partials_directory,
                    'today_date'         => date( "Y-m-d", strtotime( "today midnight" ) ),
                    'plugin_path'        => plugin_dir_url( __FILE__ ),
                    'us_states'          => json_encode( $json_us_states ),
                    'trailer_type'       => json_encode( $json_trailer_type ),
                    'trailer_size'       => json_encode( $json_trailer_size ),
                )
            );
        }

        function post_add_tax( $post, $data, $update ){
            foreach( $data['post_taxonomies'] as $term => $tax ){
                wp_set_post_terms( $post['ID'], array(intval( $term )), $tax, true );
            }
        }
    }

    new wprjs();
    add_filter( 'json_query_vars', 'slug_allow_meta', 10, 1 );
    function slug_allow_meta( $valid_vars ){
        $valid_vars = array_merge( $valid_vars, array('meta_key', 'meta_value', 'meta_query') );
        return $valid_vars;
    }

    add_filter( 'json_prepare_post', 'rjs_wp_api_encode', 10, 3 );
    function rjs_wp_api_encode( $data, $post, $context ){
        $customMeta      = (array)get_post_meta( $post['ID'] );
        $filterMeta      = rjs_get_fields( $customMeta );
        $data['rjsmeta'] = $filterMeta;
        /*
         * only return what we need.
         */
        //$filterArr = array('ID' => $data['ID'], 'rjsmeta' => $data['rjsmeta']);
        $filterArr = $data;
        return $filterArr;
    }

    add_filter( 'json_query_var-meta_query', 'rjs_enable_multi_meta_query', 10, 1 );
    function rjs_enable_multi_meta_query( $data ){
        $args = array();
        foreach( $data as $key => $value ){
            if( 'relation' === $key ){
                $args['relation'] = $data['relation'];
            }
            if( substr( $key, 0, 3 ) === 'key' ){
                $arg_num                    = substr( $key, 3 );
                $args[(int)$arg_num]['key'] = $value;
            }
            if( substr( $key, 0, 5 ) === 'value' ){
                $arg_num                      = substr( $key, 5 );
                $args[(int)$arg_num]['value'] = $value;
            }
            if( substr( $key, 0, 7 ) === 'compare' ){
                $arg_num_comp                        = substr( $key, 7 );
                $args[(int)$arg_num_comp]['compare'] = $value;
            }
        }
        return $args;
    }

    /**
     * AJAX FUNCTIONS FOR CREATING AND EDITING.
     * THE REST API DOESN'T SUPPORT MULTIPLE CUSTOM FIELDS EDITS
     */
    add_action( 'wp_ajax_rjs_edit_post', 'rjs_edit_post' );
    add_action( 'wp_ajax_nopriv_rjs_edit_post', 'rjs_edit_post' );
    function rjs_edit_post(){
        foreach( $_POST['postdata'] as $field_k => $field_v ){
            if( substr( $field_k, 0, 3 ) == 'wfc' ){
                update_post_meta( $_POST['postid'], $field_k, $field_v );
            }
        }
        die();
    }

    add_action( 'wp_ajax_rjs_new_post', 'rjs_new_post' );
    add_action( 'wp_ajax_nopriv_rjs_new_post', 'rjs_new_post' );
    function rjs_new_post(){
        $post_information = array(
            'post_title'  => wp_strip_all_tags( "" ),
            'post_type'   => $_POST['posttype'],
            'post_status' => 'publish'
        );
        $post_id          = wp_insert_post( $post_information );
        if( is_int( $post_id ) ){
            foreach( $_POST['postdata'] as $field_k => $field_v ){
                if( substr( $field_k, 0, 3 ) == 'wfc' ){
                    update_post_meta( $post_id, $field_k, $field_v );
                }
            }
            echo "Success. new ID:".$post_id;
        } else{
            echo "Error creating new post";
        }
        die();
    }

    add_action( 'wp_ajax_rjs_bulk_new_post', 'rjs_bulk_new_post' );
    add_action( 'wp_ajax_nopriv_rjs_bulk_new_post', 'rjs_bulk_new_post' );
    function rjs_bulk_new_post(){
        $post_information = array(
            'post_title'  => wp_strip_all_tags( "" ),
            'post_type'   => $_POST['posttype'],
            'post_status' => 'publish'
        );
        foreach( $_POST['postdata'] as $truck ){
            $post_id = wp_insert_post( $post_information );
            if( is_int( $post_id ) ){
                foreach( $truck as $field_k => $field_v ){
                    if( substr( $field_k, 0, 3 ) == 'wfc' ){
                        update_post_meta( $post_id, $field_k, $field_v );
                    }
                }
                echo "Success. new ID:".$post_id;
            } else{
                echo "Error creating new post";
            }
        }
        die();
    }

    /**
     * Adds a join to the WordPress meta table for license key searches in the WordPress Administration
     *
     * @param string $join SQL JOIN statement
     *
     * @return string SQL JOIN statement
     */
    add_filter( 'posts_join', 'search_meta_data_join');
    function search_meta_data_join( $join ){
        global $wp_query, $wpdb;
//        print_r($wp_query);
//        die('ddddd');

        // Only join the post meta table if we are performing a search
        if( empty (get_query_var( 's' )) ){
            return $join;
        }

        // Join the post meta table
        $join .= " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";

        return $join;
    }