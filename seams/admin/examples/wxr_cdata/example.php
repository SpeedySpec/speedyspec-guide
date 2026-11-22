<?php
// Wraps text in a CDATA section for the export, splitting any ]]> it holds; defined by export_wp().
guide_render( 'export_wp' );
return wxr_cdata( 'Fish & chips ]]> here' );
