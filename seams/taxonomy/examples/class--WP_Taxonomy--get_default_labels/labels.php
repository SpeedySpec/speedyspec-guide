<?php
// The default labels, each a pair for flat and hierarchical taxonomies; reset_default_labels() forgets them so they are translated again.
$labels = WP_Taxonomy::get_default_labels();
WP_Taxonomy::reset_default_labels();
return array( $labels['add_new_item'], $labels['parent_item'], count( $labels ) > 20 );
