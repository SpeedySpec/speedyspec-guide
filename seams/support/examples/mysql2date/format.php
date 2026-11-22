<?php
// Formats a MySQL date: U and G give the timestamp, anything else is formatted with date_i18n(), translated when asked; false for an empty date.
return array( mysql2date( 'F j, Y', '2026-03-01 09:30:00' ), mysql2date( 'U', '2026-03-01 09:30:00' ), mysql2date( 'D', '2026-03-01 09:30:00', false ), mysql2date( 'Y', '' ) );
