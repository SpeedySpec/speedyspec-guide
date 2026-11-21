<?php
// HTML treats an IMAGE tag as IMG, and the processor says so.
$p = WP_HTML_Processor::create_fragment( '<image src="x">' );
$p->next_tag();
return $p->get_tag();
