<?php
// Sets $content_width to 640, as twentynineteen_content_width filters it; on after_setup_theme, early.
guide_theme( 'twentynineteen' );
return $GLOBALS['content_width'];
