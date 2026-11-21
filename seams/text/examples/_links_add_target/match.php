<?php
// The callback for one tag: it reads the target from the $_links_add_target global.
$GLOBALS['_links_add_target'] = 'new';
return _links_add_target( array( '<a href="x">', 'a', ' href="x"' ) );
