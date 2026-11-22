<?php
// A value anonymized by type: email deleted@site.invalid, url https://site.invalid, ip zeroed, date 0000-00-00 00:00:00, text and longtext replaced; wp_privacy_anonymize_data filters it.
return array( wp_privacy_anonymize_data( 'email', 'a@b.c' ), wp_privacy_anonymize_data( 'url', 'https://x' ), wp_privacy_anonymize_data( 'ip', '1.2.3.4' ), wp_privacy_anonymize_data( 'date' ), wp_privacy_anonymize_data( 'text' ) );
