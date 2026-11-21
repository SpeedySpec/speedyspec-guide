<?php
// Replaces every setting; names and values keep only letters, digits, - and _.
wp_set_current_user( 1 );
return array( wp_set_all_user_settings( array( 'editor' => 'html', 'bad name' => 'x y' ) ), get_user_option( 'user-settings', 1 ) );
