<?php
// Whether two widths and heights have the same ratio, allowing for rounding.
return array( wp_image_matches_ratio( 1200, 800, 300, 200 ), wp_image_matches_ratio( 1200, 800, 300, 201 ), wp_image_matches_ratio( 1200, 800, 300, 300 ) );
