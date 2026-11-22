<?php
// Loads a file when the theme supports a feature; true when it did.
return require_if_theme_supports( 'nope', ABSPATH . 'nothing.php' );
