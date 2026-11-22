<?php
// An RFC 3339 date as a Unix timestamp, false when it isn't one; with force_utc, the time zone is ignored.
return array( rest_parse_date( '2026-01-02T03:04:05Z' ), rest_parse_date( '2026-01-02T03:04:05+01:00' ), rest_parse_date( '2026-01-02T03:04:05+01:00', true ), rest_parse_date( 'yesterday' ) );
