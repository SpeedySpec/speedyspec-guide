<?php
// The current time as a DateTimeImmutable in the site's timezone.
update_option( 'timezone_string', 'Europe/Paris' );
return current_datetime()->getTimezone()->getName();
