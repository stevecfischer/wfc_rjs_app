<?php
    $size_array               = array(
        'full'    => "Full/TL",
        'partial' => "Partial/LTL"
    );
    $us_states_array          = array(
        'AL' => 'AL',
        'AK' => 'AK',
        'AZ' => 'AZ',
        'AR' => 'AR',
        'CA' => 'CA',
        'CO' => 'CO',
        'CT' => 'CT',
        'DE' => 'DE',
        'DC' => 'DC',
        'FL' => 'FL',
        'GA' => 'GA',
        'HI' => 'HI',
        'ID' => 'ID',
        'IL' => 'IL',
        'IN' => 'IN',
        'IA' => 'IA',
        'KS' => 'KS',
        'KY' => 'KY',
        'LA' => 'LA',
        'ME' => 'ME',
        'MD' => 'MD',
        'MA' => 'MA',
        'MI' => 'MI',
        'MN' => 'MN',
        'MS' => 'MS',
        'MO' => 'MO',
        'MT' => 'MT',
        'NE' => 'NE',
        'NV' => 'NV',
        'NH' => 'NH',
        'NJ' => 'NJ',
        'NM' => 'NM',
        'NY' => 'NY',
        'NC' => 'NC',
        'ND' => 'ND',
        'OH' => 'OH',
        'OK' => 'OK',
        'OR' => 'OR',
        'PA' => 'PA',
        'PR' => 'PR',
        'RI' => 'RI',
        'SC' => 'SC',
        'SD' => 'SD',
        'TN' => 'TN',
        'TX' => 'TX',
        'UT' => 'UT',
        'VT' => 'VT',
        'VA' => 'VA',
        'WA' => 'WA',
        'WV' => 'WV',
        'WI' => 'WI',
        'WY' => 'WY'
    );
    $rjs_trailer_type         = array(
        'R' => 'R',
        'F' => 'F',
        'V' => 'V'
    );
    $rjs_trailer_options      = array(
        'Hazmat',
        'Team',
        'Expedited',
        'Tarp',
        'Pallet Exchange',
    );
    $rjs_add_fav              = array(
        'Yes'
    );
    $rjs_daily                = array(
        'Yes'
    );
    $rjs_custom_fields_trucks = array(
        array(
            'field_title' => 'TO Hazmat: ',
            'type_of_box' => 'checkbox',
            'options'     => array('Yes')
        ),
        array(
            'field_title' => 'TO Team: ',
            'type_of_box' => 'checkbox',
            'options'     => array('Yes')
        ),
        array(
            'field_title' => 'TO Expedited: ',
            'type_of_box' => 'checkbox',
            'options'     => array('Yes')
        ),
        array(
            'field_title' => 'TO Tarp: ',
            'type_of_box' => 'checkbox',
            'options'     => array('Yes')
        ),
        array(
            'field_title' => 'TO Pallet Exchange: ',
            'type_of_box' => 'checkbox',
            'options'     => array('Yes')
        ),
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
            'field_title' => 'Origin. Radius: ',
            'type_of_box' => 'text',
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
            'field_title' => 'Dest. Radius: ',
            'type_of_box' => 'text',
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
            'options'     => $size_array, /* required */
        ),
        array(
            'field_title' => 'Pickup Date: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Rate per Mile: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Width: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Min Distance: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Qty: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Length: ',
            'type_of_box' => 'text'
        ),
        array(
            'field_title' => 'Weight: ',
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
    );
    function rjs_get_fields( $post_meta ){
        // vars
        //        print_r($post_meta);
        $r     = array();
        $allow = array(
            "wfc_rjs_trucks_trailer_options"
        );
        foreach( $post_meta as $k => $v ){
            if( in_array( $k, $allow ) ){
                $v[0] = maybe_unserialize( $v[0] );
            }
            $r[$k] = $v[0];
        }
        //        print_r( $r );
        return $r;
    }

    function rjs_get_field_objects( $post_id = false, $options = array() ){
        // global
        global $wpdb;
        // filter post_id
        //        $post_id = apply_filters( 'acf/get_post_id', $post_id );
        // vars
        $field_key = '';
        $value     = array();
        // get field_names
        if( is_numeric( $post_id ) ){
            $keys = $wpdb->get_col(
                $wpdb->prepare(
                    "SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d and meta_key LIKE %s AND meta_value LIKE %s",
                    $post_id,
                    '_%',
                    'field_%'
                ) );
        }
        if( is_array( $keys ) ){
            foreach( $keys as $key ){
                $field = rjs_get_field_object( $key, $post_id, $options );
                if( !is_array( $field ) ){
                    continue;
                }
                $value[$field['name']] = $field;
            }
        }
        // no value
        if( empty($value) ){
            return false;
        }
        // return
        return $value;
    }