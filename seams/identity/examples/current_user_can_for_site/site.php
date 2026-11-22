<?php
// current_user_can() on another site of a network; on a single site, the site itself.
return array( current_user_can_for_site( 1, 'manage_options' ), current_user_can_for_site( 1, 'nope' ) );
