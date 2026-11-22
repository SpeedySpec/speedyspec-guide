<?php
// The URL of the feed being served, from the request, for the atom:link rel="self" element.
guide_go( '/?feed=rss2' );
return get_self_link();
