<?php
// Leaves out the themes paused for recovery mode from a list of theme folders.
return wp_skip_paused_themes( array( '/themes/a' ) );
