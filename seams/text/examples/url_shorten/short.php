<?php
// Drops the scheme, www. and a trailing slash, and cuts long URLs with an ellipsis.
return array( url_shorten( 'https://www.example.com/' ), url_shorten( 'http://example.com/a/very/long/path/that/goes/on', 20 ) );
