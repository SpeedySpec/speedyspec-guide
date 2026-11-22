<?php
// The callback for one match: escaped when it has no >.
return array( wp_pre_kses_less_than_callback( array( '< b' ) ), wp_pre_kses_less_than_callback( array( '<b>' ) ) );
