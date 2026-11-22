<?php
// Sends X-Content-Type-Options: nosniff, so browsers don't guess a response's type.
send_nosniff_header();
return 'sent';
