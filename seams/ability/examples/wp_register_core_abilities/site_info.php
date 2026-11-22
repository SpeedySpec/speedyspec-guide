<?php
// core/get-site-info returns get_bloginfo() fields, all or those asked for; it needs manage_options.
guide_core_abilities();
add_filter( 'pre_option_blogname', fn() => 'Guide' );
add_filter( 'pre_option_blogdescription', fn() => 'Just another guide' );
$ability = wp_get_ability( 'core/get-site-info' );
$refused = $ability->execute()->get_error_code();
add_filter( 'user_has_cap', fn( $all ) => $all + array( 'manage_options' => true ) );
return array( $refused, $ability->execute( array( 'fields' => array( 'name', 'description', 'charset' ) ) ), $ability->execute( array( 'fields' => array( 'nope' ) ) )->get_error_code() );
