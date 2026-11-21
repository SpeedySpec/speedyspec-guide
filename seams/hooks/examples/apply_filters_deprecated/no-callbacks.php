<?php
// With no callbacks, nothing is reported and the first argument comes back.
return apply_filters_deprecated( 'guide_old', array( 'value' ), '6.0.0', 'guide_new' );
