<?php
// htmlspecialchars() with quotes: existing entities are escaped again, so they show as typed.
add_filter( 'esc_textarea', fn( $safe, $text ) => "[$safe]", 10, 2 );
return esc_textarea( '<p>&amp; "q"</p>' );
