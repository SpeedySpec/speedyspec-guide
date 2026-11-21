<?php
// An action fired with no callbacks still counts.
do_action( 'guide_quiet' );

return did_action( 'guide_quiet' );
