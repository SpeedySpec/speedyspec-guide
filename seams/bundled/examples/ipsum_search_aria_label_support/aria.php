<?php
// Gives the Search block support for an ARIA label, from its metadata; other blocks are unchanged. On block_type_metadata.
guide_theme( 'ipsum' );
return array( ipsum_search_aria_label_support( array( 'name' => 'core/search', 'supports' => array( 'align' => true ) ) ), ipsum_search_aria_label_support( array( 'name' => 'core/code' ) ) );
