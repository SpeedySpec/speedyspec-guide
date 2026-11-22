<?php
// Serializes blocks with before and after callbacks for each.
function guide_mark_after( &$block ) {
	return '<!-- after -->';
}
return traverse_and_serialize_blocks( parse_blocks( '<!-- wp:separator /-->' ), null, 'guide_mark_after' );
