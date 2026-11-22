<?php
// Whether an aspectRatio value is set to a ratio, not auto or empty.
return array( wp_is_explicit_aspect_ratio_value( '16/9' ), wp_is_explicit_aspect_ratio_value( 'auto' ), wp_is_explicit_aspect_ratio_value( '' ) );
