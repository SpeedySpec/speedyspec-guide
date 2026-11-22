<?php
// Makes relative src and href values absolute against the base; URLs with an allowed protocol are kept.
return links_add_base_url( '<a href="page">p</a><img src="/i.png"><a href="https://example.com/">e</a>', 'http://example.org/dir/' );
