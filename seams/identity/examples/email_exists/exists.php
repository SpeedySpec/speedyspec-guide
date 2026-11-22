<?php
// A user ID by email, or false; email_exists filters it.
return array( email_exists( 'admin@example.org' ), email_exists( 'nobody@example.org' ) );
