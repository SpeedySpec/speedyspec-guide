<?php
// Cuts a slug to a length without splitting a percent-encoded character.
return wp_truncate_slug( 'caf%c3%a9-au-lait', 6 );
