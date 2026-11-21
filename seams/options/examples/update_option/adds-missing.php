<?php
// An option that isn't stored is added.
update_option( 'guide_new', 'x' );
return get_option( 'guide_new' );
