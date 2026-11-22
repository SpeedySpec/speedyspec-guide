<?php
// The CSS selectors each custom color applies to, by area, color and property; twentytwenty_get_elements_array filters them.
guide_theme( 'twentytwenty' );
$elements = twentytwenty_get_elements_array();
return array( array_keys( $elements ), array_keys( $elements['content'] ), array_keys( $elements['content']['accent'] ) );
