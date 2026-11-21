<?php
// The first link's href, cleaned for the database; false when there is none.
return array( get_url_in_content( '<p><a>no</a> <a href="https://example.com/?a=1&amp;b=2">x</a></p>' ), get_url_in_content( 'no links' ), get_url_in_content( '' ) );
