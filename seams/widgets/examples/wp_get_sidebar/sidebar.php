<?php
// A registered sidebar by ID; wp_inactive_widgets gives the inactive widgets area; null otherwise.
register_sidebar( array( 'id' => 'side', 'name' => 'Side' ) );
return array( wp_get_sidebar( 'side' )['name'], wp_get_sidebar( 'wp_inactive_widgets' ), wp_get_sidebar( 'none' ) );
