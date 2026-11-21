<?php
// From an ISO 8601 string (YYYYMMDDTHH:MM:SS plus a timezone), or from a timestamp in UTC; getIso() and getXml() give it back.
$from_iso = new IXR_Date( '20260102T03:04:05Z' );
$from_time = new IXR_Date( 86400 );
return array( $from_iso->getIso(), $from_iso->getXml(), $from_time->getIso(), $from_iso->timezone );
