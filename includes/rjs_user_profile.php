<?php

    add_action( 'show_user_profile', 'add_extra_user_fields' );
    add_action( 'edit_user_profile', 'add_extra_user_fields' );

    add_action( 'personal_options_update', 'save_extra_user_fields' );
    add_action( 'edit_user_profile_update', 'save_extra_user_fields' );

    function save_extra_user_fields( $user_id ){
        update_user_meta( $user_id, 'rjs_handle', sanitize_text_field( $_POST['rjs_handle'] ) );
        update_user_meta( $user_id, 'rjs_handle_phone', sanitize_text_field( $_POST['rjs_handle_phone'] ) );

    }

    function add_extra_user_fields( $user ){
        ?>
        <table class="form-table">
            <tr>
                <th>
                    <label for="rjs_handle">Handle</label>
                </th>
                <td><input type="text"
                           name="rjs_handle"
                           value="<?php echo esc_attr( get_the_author_meta( 'rjs_handle', $user->ID ) ); ?>"
                           class="regular-text"/></td>
            </tr>
            <tr>
                <th>
                    <label for="rjs_handle_phone">Handle Phone</label>
                </th>
                <td><input type="text"
                           name="rjs_handle_phone"
                           value="<?php echo esc_attr( get_the_author_meta( 'rjs_handle_phone', $user->ID ) ); ?>"
                           class="regular-text"/></td>
            </tr>
        </table>
        <?php
    }