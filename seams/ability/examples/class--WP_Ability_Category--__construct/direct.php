<?php
// Built with a slug and a label and description; unknown properties are skipped with a notice, and missing ones throw.
$category = new WP_Ability_Category( 'tools', array( 'label' => 'Tools', 'description' => 'D.', 'color' => 'red' ) );
try { new WP_Ability_Category( '', array() ); } catch ( InvalidArgumentException $e ) { echo $e->getMessage(), "\n"; }
try { new WP_Ability_Category( 'x', array( 'label' => 'X', 'description' => 'D.', 'meta' => 'no' ) ); } catch ( InvalidArgumentException $e ) { echo $e->getMessage(), "\n"; }
return array( $category->get_slug(), $category->get_meta() );
