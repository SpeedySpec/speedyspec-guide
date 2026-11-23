<?php
// Ajax handler that remembers whether the user dismissed the dashboard's Welcome panel.
guide_ajax( 'wp_ajax_update_welcome_panel', array( 'visible' => 0, 'welcomepanelnonce' => wp_create_nonce( 'welcome-panel-nonce' ) ) );
return get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
