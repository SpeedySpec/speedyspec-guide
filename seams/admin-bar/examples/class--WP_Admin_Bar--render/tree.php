<?php
// render() builds the tree: top-level items go in root-default, items under an item go in its -default group, and groups under a group share a -container; then it prints it.
$bar = new WP_Admin_Bar();
$bar->add_node( array( 'id' => 'top', 'title' => 'Top', 'href' => '/top' ) );
$bar->add_node( array( 'id' => 'child', 'parent' => 'top', 'title' => 'Child', 'meta' => array( 'html' => '<i>x</i>', 'target' => '_blank' ) ) );
$bar->add_group( array( 'id' => 'side', 'meta' => array( 'class' => 'mine' ) ) );
$bar->add_node( array( 'id' => 'other', 'parent' => 'side', 'title' => 'Other', 'href' => '/o' ) );
ob_start();
$bar->render();
return ob_get_clean();
