<?php
// With no callbacks, nothing is reported or run.
do_action_deprecated( 'guide_unused', array(), '6.0.0' );

return did_action( 'guide_unused' );
