<?php
// The registered post statuses matching arguments, as names or objects.
return array( get_post_stati( array( 'public' => true ) ), array_values( get_post_stati( array( 'internal' => true ) ) ) );
