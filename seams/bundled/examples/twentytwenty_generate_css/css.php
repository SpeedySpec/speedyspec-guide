<?php
// A CSS rule from a selector, property and value with a prefix and suffix, printed unless told not to; empty without a value or selector.
guide_theme( 'twentytwenty' );
return array( twentytwenty_generate_css( '.a', 'color', '#fff', '', '', false ), twentytwenty_generate_css( '', 'color', '#fff', '', '', false ), guide_render( fn() => twentytwenty_generate_css( '.b', 'margin', '2', '', 'rem' ) ) );
