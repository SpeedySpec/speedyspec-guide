<?php
// Adds the Index Sidebar and All Archives Sidebar templates to the default template types; on default_template_types.
guide_theme( 'ipsum' );
$types = ipsum_sidebar_template_types( array() );
return array_map( fn( $t ) => $t['title'], $types );
