<?php
// An archive link in a format: link (a link tag), option, html (a list item) or custom; filtered by get_archives_link.
return array( get_archives_link( 'http://example.org/2026/', '2026' ), get_archives_link( 'http://example.org/2026/', '2026', 'option' ), get_archives_link( 'http://example.org/2026/', '2026', 'link' ) );
