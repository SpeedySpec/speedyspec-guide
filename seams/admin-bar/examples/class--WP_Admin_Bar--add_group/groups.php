<?php
// add_group() adds a node with group true; remove_node() and remove_menu() remove one; my-blogs is the old name of my-sites, with a notice.
$bar = new WP_Admin_Bar();
$bar->add_group( array( 'id' => 'g' ) );
$bar->add_node( array( 'id' => 'x', 'parent' => 'my-blogs' ) );
$bar->add_node( array( 'id' => 'y' ) );
$bar->remove_menu( 'y' );
return array( $bar->get_node( 'g' )->group, $bar->get_node( 'x' )->parent, $bar->get_node( 'y' ) );
