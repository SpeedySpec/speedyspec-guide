<?php
// Registers a theme feature with its type, description and schema, so it can show in REST; an error for a bad type or schema.
$r = register_theme_feature( 'guide-dark', array( 'type' => 'boolean', 'description' => 'Dark mode.', 'show_in_rest' => true ) );
return array( $r, get_registered_theme_feature( 'guide-dark' )['description'], register_theme_feature( 'guide-odd', array( 'type' => 'date' ) )->get_error_code() );
