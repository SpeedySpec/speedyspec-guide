<?php
// Fills an object's labels from defaults, by whether it is hierarchical; shared by post types and taxonomies.
$labels = _get_custom_object_labels( (object) array( 'labels' => array( 'name' => 'Things' ), 'hierarchical' => false, 'label' => 'Things' ), array( 'name' => array( 'Posts', 'Pages' ), 'singular_name' => array( 'Post', 'Page' ) ) );
return (array) $labels;
