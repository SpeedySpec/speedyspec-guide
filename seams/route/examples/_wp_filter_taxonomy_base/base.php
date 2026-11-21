<?php
// Strips a leading /index.php/ and slashes from a taxonomy base.
return array( _wp_filter_taxonomy_base( '/index.php/topics/' ), _wp_filter_taxonomy_base( '' ) );
