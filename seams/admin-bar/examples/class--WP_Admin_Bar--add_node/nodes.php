<?php
// Adds or updates a node: arguments merge into an existing node, meta merges too; a node needs an id (one made from the title, with a notice).
$bar = new WP_Admin_Bar();
$bar->add_node( array( 'id' => 'a', 'title' => 'A', 'meta' => array( 'class' => 'x' ) ) );
$bar->add_node( array( 'id' => 'a', 'href' => '/a', 'meta' => array( 'title' => 'T' ) ) );
$bar->add_menu( array( 'title' => 'No Id' ) );
$bar->add_node( array( 'href' => '/ignored' ) );
return array( (array) $bar->get_node( 'a' ), array_keys( $bar->get_nodes() ) );
