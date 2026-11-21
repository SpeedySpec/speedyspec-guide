<?php
// Builds the attribute string: href through esc_url(), the rest through esc_attr(); empty, false and non-scalar values are left out.
class Guide_Menu extends Walker_Nav_Menu { public function atts( $a ) { return $this->build_atts( $a ); } }
return ( new Guide_Menu() )->atts( array( 'href' => 'javascript:x', 'title' => 'a "b"', 'rel' => '', 'x' => false, 'y' => array( 1 ), 'z' => 0 ) );
