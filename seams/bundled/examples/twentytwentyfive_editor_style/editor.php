<?php
// Loads editor-style.css as an editor style; on after_setup_theme.
guide_theme( 'twentytwentyfive' );
return array_map( 'basename', get_editor_stylesheets() );
