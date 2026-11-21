<?php
// The date, year, month and day structures, following the order of the date tags in the permalink structure.
$r = guide_permalinks( '/%year%/%monthnum%/%postname%/' );
$plain = $r->get_date_permastruct();
return array( $r->get_date_permastruct(), $r->get_year_permastruct(), $r->get_month_permastruct(), $r->get_day_permastruct() );
