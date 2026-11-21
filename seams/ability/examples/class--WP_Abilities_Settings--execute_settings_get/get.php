<?php
// core/settings-get returns the settings exposed to abilities, by their exposed name, all of them or by group or name; an empty boolean option is false.
guide_core_abilities();
add_filter( 'pre_option_blogname', fn() => 'Guide' );
add_filter( 'pre_option_posts_per_page', fn() => '10' );
add_filter( 'pre_option_guide_flag', fn() => '' );
register_setting( 'general', 'blogname', array( 'show_in_abilities' => true, 'type' => 'string', 'label' => 'Site Title' ) );
register_setting( 'reading', 'posts_per_page', array( 'show_in_abilities' => array( 'name' => 'per_page' ), 'type' => 'integer' ) );
register_setting( 'reading', 'guide_flag', array( 'show_in_abilities' => true, 'type' => 'boolean' ) );
register_setting( 'general', 'guide_hidden', array( 'type' => 'string' ) );
add_filter( 'user_has_cap', fn( $all ) => $all + array( 'manage_options' => true ) );
$ability = wp_get_ability( 'core/settings-get' );
return array( $ability->execute(), $ability->execute( array( 'group' => 'reading' ) ), $ability->execute( array( 'fields' => array( 'per_page' ) ) ) );
