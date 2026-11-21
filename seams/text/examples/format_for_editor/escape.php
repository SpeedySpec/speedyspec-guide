<?php
// Escapes <, > and & (not quotes) for a textarea, and passes the text through format_for_editor.
add_filter( 'format_for_editor', fn( $text, $editor ) => "[$editor] $text", 10, 2 );
return array( format_for_editor( '<b>"A & B"</b>', 'tinymce' ), format_for_editor( '' ) );
