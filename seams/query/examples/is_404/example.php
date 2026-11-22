<?php
// Whether the main query found nothing and is a 404.
guide_go( '/?p=999999' );
return array( is_404(), is_single() );
