<?php
    /**
     * Include the custome metaboxes to go with our custom types
     */
    include_once('rjs_meta_box_cases.php');

    /**
     * Class to add new posttype easly
     *
     * @package scf-framework
     * @author Steve (6/11/2012)
     */
    class wfcfw
    {
        /**
         * @var array $new_cpts
         */
        private $new_cpts = array();

        /**
         * Constructor, launch everyting
         *
         * @param array $obj an array of parameters to build the new CPT
         */
        public function __construct( $obj ){
            $this->new_cpts[] = $obj;
            if( isset($obj['meta_box']) ){
                $new_meta_box = new wfc_meta_box_class( $obj );
            }
            add_action( 'init', array(&$this, 'add_cpt_to_admin_menu') );
            //$this->add_cpt_to_admin_menu();
        }

        /**
         * Add the new CPT to the admin panel
         * Register the posttype
         * Register the taxonomy
         *
         */
        function add_cpt_to_admin_menu(){
            $vars = $this->new_cpts;
            foreach( $vars as $var ){
                if( !empty($var['cpt']) ){
                    /**
                     * Change CPT labels.
                     *
                     * @since 5.5.0
                     *
                     * @param array $wfc_cpt_labels_array .
                     */
                    $wfc_cpt_labels_array = array(
                        'name'               => _x( $var ['cpt'], 'post type general name' ),
                        'singular_name'      => _x( $var['cpt'], 'post type singular name' ),
                        'add_new'            => _x( 'Add New ', $var['cpt'] ),
                        'add_new_item'       => __( 'Add New '.$var['cpt'] ),
                        'edit_item'          => __( 'Edit '.$var['cpt'] ),
                        'new_item'           => __( 'New '.$var['cpt'] ),
                        'view_item'          => __( 'View '.$var['cpt'] ),
                        'search_items'       => __( 'Search '.$var['cpt'] ),
                        'not_found'          => __( 'No '.$var['cpt'].' found' ),
                        'not_found_in_trash' => __( 'No '.$var['cpt'].' found in Trash' ),
                        'parent_item_colon'  => '',
                        'menu_name'          => !empty($var['menu_name']) ? $var['menu_name'] : $var ['cpt']
                    );
                    $cpt_labels           = apply_filters( "wfc_cpt_labels", $wfc_cpt_labels_array );
                    /**
                     * Change CPT arguments.
                     *
                     * @since 5.5.0
                     *
                     * @param array $wfc_cpt_args_array .
                     */
                    $wfc_cpt_args_array = array(
                        'labels'        => $cpt_labels,
                        'public'        => true,
                        'menu_position' => 5,
                        'has_archive'   => strtolower( $var['cpt'] ),
                        'rewrite'       => array(
                            'slug'       => strtolower( $var['cpt'] ),
                            'with_front' => false
                        ),
                        'hierarchical'  => true,
                        'supports'      => apply_filters( "wfc_post_type_support", $var['supports'], strtolower( $var['cpt'] ) )
                    );
                    register_post_type(
                        strtolower( $var['cpt'] ),
                        apply_filters(
                            "wfc_cpt_args", $wfc_cpt_args_array, $var['cpt']
                        ) );
                }
                if( !empty($var['tax']) ){
                    foreach( $var['tax'] as $single_tax ){
                        $set_taxonomy_label = !empty($single_tax['menu_name']) ? $single_tax['menu_name'] : $single_tax['tax_label'];
                        $tax_labels         = array(
                            'name'              => _x( $set_taxonomy_label, 'taxonomy general name' ),
                            'singular_name'     => _x( $single_tax['tax_label'], 'taxonomy singular name' ),
                            'search_items'      => __( 'Search '.$set_taxonomy_label ),
                            'all_items'         => __( 'All '.$set_taxonomy_label ),
                            'parent_item'       => __( 'Parent '.$set_taxonomy_label ),
                            'parent_item_colon' => __( 'Parent '.$set_taxonomy_label.':' ),
                            'edit_item'         => __( 'Edit '.$set_taxonomy_label ),
                            'update_item'       => __( 'Update '.$set_taxonomy_label ),
                            'add_new_item'      => __( 'Add New '.$set_taxonomy_label ),
                            'new_item_name'     => __( 'New Genre '.$set_taxonomy_label ),
                            'menu_name'         => $set_taxonomy_label
                        );
                        /* added ability to 'share' custom taxonomies across post types */
                        $obj_type = isset($var['object_type']) ? $var['object_type'] : strtolower( $var['cpt'] );
                        register_taxonomy(
                            strtolower( $single_tax['tax_label'] ), $obj_type, array(
                                'hierarchical' => true,
                                'labels'       => $tax_labels,
                                'show_ui'      => true,
                                'public'       => true,
                                'query_var'    => true,
                                'rewrite'      => true,
                            ) );
                    }
                }
            }
        }
    }