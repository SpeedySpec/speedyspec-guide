<?php
// Loads style.css and editor-style.css as editor styles; on after_setup_theme.
guide_theme( 'ipsum' );
return get_editor_stylesheets() ? array_map( 'basename', get_editor_stylesheets() ) : array();
