<?php
// Writes an email address with random characters as entities, so simple scrapers miss it; browsers show it as written.
return html_entity_decode( antispambot( 'me@example.org' ) );
