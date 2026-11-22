<?php
// Loads the classic editor's stylesheet and the Inter font as editor styles; on init.
guide_theme( 'twentytwenty' );
twentytwenty_classic_editor_styles();
return array_map( 'basename', get_editor_stylesheets() );
