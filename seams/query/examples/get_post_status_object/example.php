<?php
// A registered post status's object, or null.
return array( get_post_status_object( 'publish' )->public, get_post_status_object( 'nope' ) );
