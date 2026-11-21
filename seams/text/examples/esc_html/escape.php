<?php
// Escapes <, >, &, " and ', leaving existing entities as they are.
return esc_html( '<a href="x">Tom & Jerry\'s &amp;</a>' );
