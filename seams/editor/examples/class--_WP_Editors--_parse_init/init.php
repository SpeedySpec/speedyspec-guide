<?php
// TinyMCE settings as a JavaScript object literal: booleans bare, objects, arrays and functions as they are, everything else quoted.
return guide_call( '_WP_Editors', '_parse_init', array( 'menubar' => false, 'toolbar1' => 'bold,italic', 'formats' => '{a:1}', 'setup' => 'function(ed){}' ) );
