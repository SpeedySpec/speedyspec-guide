<?php
// Whether an email's domain is on the network's banned_email_domains list (or a subdomain of one); is_email_address_unsafe filters it.
update_site_option( 'banned_email_domains', array( 'spam.example' ) );
return array( is_email_address_unsafe( 'a@spam.example' ), is_email_address_unsafe( 'a@mail.spam.example' ), is_email_address_unsafe( 'a@ok.example' ) );
