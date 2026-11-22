<?php
// A color of an area (content or header-footer) for a context (text, accent, secondary, borders), from the accent_accessible_colors theme mod; false when unknown.
guide_theme( 'twentytwenty' );
return array( twentytwenty_get_color_for_area( 'content', 'accent' ), twentytwenty_get_color_for_area( 'header-footer', 'borders' ), twentytwenty_get_color_for_area( 'content', 'nope' ) );
