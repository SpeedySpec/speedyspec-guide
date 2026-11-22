<?php
// get_node() and get_nodes() return copies; changing one changes nothing in the bar. After render() they return null.
$bar = new WP_Admin_Bar();
$bar->add_node( array( 'id' => 'a', 'title' => 'A' ) );
$copy = $bar->get_node( 'a' );
$copy->title = 'Changed';
$before = $bar->get_node( 'a' )->title;
ob_start();
$bar->render();
ob_end_clean();
return array( $before, $bar->get_node( 'a' ), $bar->get_nodes() );
