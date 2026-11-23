<?php
// Ajax handler that remembers which list table columns a user hid on a screen.
guide_ajax( 'wp_ajax_hidden_columns', array( 'page' => 'edit-post', 'hidden' => 'tags,comments', 'screenoptionnonce' => wp_create_nonce( 'screen-options-nonce' ) ) );
return get_user_option( 'manageedit-postcolumnshidden' );
