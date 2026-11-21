<?php
// null while parsing is going fine.
$p = WP_HTML_Processor::create_fragment( '<p>fine</p>' );
while ( $p->next_token() ) {
}
return $p->get_last_error();
