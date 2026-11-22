<?php
// While cache addition is suspended, nothing is added.
wp_suspend_cache_addition( true );
return wp_cache_add( 'k', 'v' );
