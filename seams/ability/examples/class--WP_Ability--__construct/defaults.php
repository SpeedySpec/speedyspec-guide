<?php
// The properties are checked and defaulted: no capabilities, annotations readonly, destructive and idempotent null, show_in_rest and public false.
$ability = new WP_Ability( 'guide/x', array( 'label' => 'X', 'description' => 'D.', 'category' => 'tools', 'execute_callback' => '__return_true', 'permission_callback' => '__return_true' ) );
return array( $ability->get_meta(), $ability->get_required_capabilities(), $ability->get_input_schema(), $ability->get_output_schema(), $ability->get_meta_item( 'public' ), $ability->get_meta_item( 'none', 'fallback' ), $ability->get_description() );
