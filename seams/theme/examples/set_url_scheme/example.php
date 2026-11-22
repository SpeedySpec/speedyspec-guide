<?php
// A URL with its scheme set: http, https, relative, or by context (login, admin); filtered by set_url_scheme.
return array( set_url_scheme( 'http://example.org/a', 'https' ), set_url_scheme( 'https://example.org/a?b=1', 'relative' ), set_url_scheme( '//example.org/a' ) );
