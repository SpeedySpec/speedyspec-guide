<?php
// Sets a variable on the main query.
guide_go( '/' );
set_query_var( 'guide_color', 'red' );
return get_query_var( 'guide_color' );
