<?php
// Whether the main query is for robots.txt.
guide_go( '/?robots=1' );
return is_robots();
