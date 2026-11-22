<?php
// A unique ID with a prefix, from wp_unique_id() (or a counter on old WordPress).
guide_theme( 'twentytwenty' );
return array( str_starts_with( twentytwenty_unique_id( 'search-' ), 'search-' ), twentytwenty_unique_id( 'a-' ) !== twentytwenty_unique_id( 'a-' ) );
