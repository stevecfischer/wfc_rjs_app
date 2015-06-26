<?php

    /**
     *
     * @package scf-framework
     * @author steve
     * @date 6/16/15
     */
    class rjs_routes
    {

        function __construct(){
//            global $myplugin_api_mytype;
            add_filter( 'json_endpoints', array($this, 'register_routes') );
        }

        function register_routes( $routes ){

            // Add more custom routes here
            $routes['/save_sg/(?P<id>\d+)'] = array(
                array(array($this, 'save_style_guide'), WP_JSON_Server::EDITABLE | WP_JSON_Server::ACCEPT_JSON)
            );
            return $routes;
        }

        function save_style_guide( $data ){
            $return['data'] = $data;
            $response = new WP_JSON_Response();
            $response->set_data( $return );
            return $response;
        }
    }