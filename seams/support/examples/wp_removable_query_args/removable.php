<?php
// The query arguments the admin removes from its address after showing a notice (message, updated, deleted and the like); removable_query_args filters them.
return array_slice( wp_removable_query_args(), 0, 6 );
