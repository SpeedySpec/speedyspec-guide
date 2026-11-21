<?php
// Adds the attributes every element may have, such as class, id, style and data-*, to an element's allowed ones.
$attrs = _wp_add_global_attributes( array( 'href' => true ) );
return array( isset( $attrs['class'] ), isset( $attrs['data-*'] ), isset( $attrs['href'] ) );
