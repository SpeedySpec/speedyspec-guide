<?php
// Replaces the ref values in a variation's styles with the values they point to in theme.json data, removing refs that point nowhere.
$data = array( 'color' => array( 'text' => array( 'ref' => 'styles.color.background' ), 'background' => array( 'ref' => 'styles.missing' ) ) );
wp_resolve_block_style_variation_ref_values( $data, array( 'styles' => array( 'color' => array( 'background' => '#123456' ) ) ) );
return $data;
