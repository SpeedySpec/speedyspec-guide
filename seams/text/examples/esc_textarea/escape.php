<?php
// htmlspecialchars() with quotes: existing entities are escaped again, so they show as typed.
function guide_bracket_textarea( $safe, $text ) {
	return "[$safe]";
}
add_filter( 'esc_textarea', 'guide_bracket_textarea', 10, 2 );
return esc_textarea( '<p>&amp; "q"</p>' );
