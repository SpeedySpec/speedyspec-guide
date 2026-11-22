<?php
// The date as a timestamp, with mktime() in PHP's default timezone, ignoring the parsed timezone.
date_default_timezone_set( 'UTC' );
return ( new IXR_Date( '20260102T03:04:05' ) )->getTimestamp();
