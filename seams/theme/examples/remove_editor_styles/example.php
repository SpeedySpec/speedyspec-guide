<?php
// Removes the editor stylesheets a theme added; false when it had none.
add_editor_style( 'a.css' );
return array( remove_editor_styles(), $GLOBALS['editor_styles'] ?? 'removed' );
