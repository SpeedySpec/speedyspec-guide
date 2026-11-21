<?php
// A DOCTYPE token's details, including whether the document renders in quirks mode.
$p = new WP_HTML_Tag_Processor( '<!DOCTYPE html><p>' );
$p->next_token();
$info = $p->get_doctype_info();
return array( $info->name, $info->indicated_compatibility_mode );
