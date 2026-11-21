<?php
// The callback for one decimal entity: kept, padded to three digits, when it is valid Unicode; escaped otherwise.
return array( wp_kses_normalize_entities2( array( '&#0065;', '0065' ) ), wp_kses_normalize_entities2( array( '&#1114112;', '1114112' ) ) );
