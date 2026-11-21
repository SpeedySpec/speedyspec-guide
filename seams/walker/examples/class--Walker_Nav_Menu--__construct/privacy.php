<?php
// The constructor reads the privacy policy page's URL; a link to it gets rel privacy-policy.
guide_page( 9, 'Privacy' );
add_filter( 'pre_option_wp_page_for_privacy_policy', fn() => '9' );
function guide_item( $id, $title, $parent = 0, $extra = array() ) { return (object) ( $extra + array( 'ID' => $id, 'db_id' => $id, 'menu_item_parent' => $parent, 'title' => $title, 'url' => "http://example.org/$id", 'classes' => array( 'menu-item' ), 'target' => '', 'xfn' => '', 'attr_title' => '', 'current' => false ) ); }
$args = (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'item_spacing' => 'discard' );
return ( new Walker_Nav_Menu() )->walk( array( guide_item( 1, 'Privacy', 0, array( 'url' => 'http://example.org/?page_id=9' ) ) ), 0, $args );
