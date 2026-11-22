<?php
// Prints the editor: the tools with the Visual and Code tabs when both editors are on, the textarea with the content (formatted for the visual editor), and the settings scripts later need. Without a user who can edit richly, only the code editor shows.
$html = guide_render( fn() => _WP_Editors::editor( '<p>Hello</p>', 'notes', array( 'media_buttons' => false ) ) );
return $html;
