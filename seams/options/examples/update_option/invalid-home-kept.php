<?php
// update_option() sanitizes home: a value that isn't a URL is dropped, and the stored one kept.
update_option( 'home', 'not a url' );
return get_option( 'home' );
