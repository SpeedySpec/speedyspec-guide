<?php
// Ajax handler that remembers a feature pointer the user dismissed, in their dismissed_wp_pointers meta.
guide_ajax( 'wp_ajax_dismiss_wp_pointer', array( 'pointer' => 'wp496_privacy' ) );
return get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true );
