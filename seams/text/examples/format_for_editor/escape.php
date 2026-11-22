<?php
// Escapes <, > and & (not quotes) for a textarea, and passes the text through format_for_editor.
function guide_prefix_editor( $text, $editor ) {
	return "[$editor] $text";
}
add_filter( 'format_for_editor', 'guide_prefix_editor', 10, 2 );
return array( format_for_editor( '<b>"A & B"</b>', 'tinymce' ), format_for_editor( '' ) );
