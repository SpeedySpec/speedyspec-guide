<?php
// Stores wp_register_script()'s array arguments as script data: in_footer as the footer group, strategy (async or defer), and fetchpriority; unknown values are wrong.
wp_register_script( 'guide-app', 'https://cdn.example/app.js', array( 'jquery' ), '1.2' );
$s = wp_scripts();
_wp_scripts_add_args_data( $s, 'guide-app', array( 'in_footer' => true, 'strategy' => 'defer', 'fetchpriority' => 'low' ) );
return array( $s->get_data( 'guide-app', 'group' ), $s->get_data( 'guide-app', 'strategy' ), $s->get_data( 'guide-app', 'fetchpriority' ) );
