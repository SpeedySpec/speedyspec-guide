<?php
// Whether a month, day and year make a real date, filtered by wp_checkdate with the date as given.
return array( wp_checkdate( 2, 29, 2028, '2028-02-29' ), wp_checkdate( 2, 30, 2026, '2026-02-30' ) );
