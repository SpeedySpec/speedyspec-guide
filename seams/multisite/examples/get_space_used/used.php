<?php
// The megabytes the site's uploads use, from its uploads folder; pre_get_space_used can answer.
add_filter( 'pre_get_space_used', fn() => 12.5 );
return get_space_used();
