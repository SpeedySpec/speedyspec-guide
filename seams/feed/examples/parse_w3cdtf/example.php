<?php
// The Unix timestamp of a W3C date and time such as 2026-03-15T10:00:00Z, honouring its time zone offset, or -1. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( parse_w3cdtf( '2026-03-15T10:00:00Z' ), parse_w3cdtf( '2026-03-15T12:00:00+02:00' ), parse_w3cdtf( 'yesterday' ) );
