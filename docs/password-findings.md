# Passwords and crypto: findings for speedyspec-server

What writing the Passwords and crypto seam's pages found in speedyspec-server at commit `219cc61e7a4f` that its compat
records don't capture. `compat/password` and `compat/crypto` hold recorded cases (`cases.json`) and no `breaks.json`;
the only list of differences is `EXPECTED_FAILURES` in `crates/speedyspec-wp-password-php/tests/wordpress.rs` (phpass,
MD5 and three bcrypt-cost tests) and the phpass test in `crates/speedyspec-wp-crypto-php/tests/wordpress.rs`. Each item
below was read from the server's source and tests; none was run on the guide's runner (the seam is unported, so its
examples run on WordPress only). When the server records one, update the page it names.

## 1. argon2 hashes the trimmed password

`wp_hash_password()` hashes `trim( $password )` for argon2 (`crates/speedyspec-wp-password/src/hash.rs`, tested by
`speedyspec-wp-password::hash::default_is_argon2id_trimmed`). WordPress trims only for bcrypt; under the
`wp_hash_password_algorithm` filter its argon2 hashes the password as given. On WordPress with argon2id,
`wp_check_password( ' pw ', wp_hash_password( ' pw ' ) )` is true; on SpeedySpec it is false, which is what WordPress's
own bcrypt default answers. No WordPress test covers it, so it is in no expected-failure list. Documented on
`content/speedyspec/password/_seam.mdx`.

## 2. The ignored-salt warning is an `E_USER_WARNING`

PHP's `password_hash()` raises `E_WARNING` for its ignored `salt` option. SpeedySpec raises the same message as
`E_USER_WARNING` (`crates/speedyspec-wp-password-php/src/lib.rs` L18-L20). `php::php_errors_match` compares only the
message, so an error handler that checks `$errno` sees 512 instead of 2. Documented on
`content/speedyspec/password/_seam.mdx`.

## 3. Cost limits refuse hashes WordPress accepts

A stored bcrypt or argon2 hash above the site's `PasswordCostLimits` (default bcrypt 16, argon2 256 MiB and 10 passes)
never verifies, and `wp_hash_password()` with options above them throws `ValueError`. WordPress verifies and writes any
cost PHP accepts (bcrypt up to 31). The server tests it (`speedyspec-wp-password::check::bcrypt_above_the_cost_limit_never_verifies_nor_runs`,
`speedyspec-wp-password-php::php::php_bound_cost_limits_cap_hashing_and_checking`), but no compat record or
expected-failure list names it. Documented on `content/speedyspec/password/_seam.mdx`.

## 4. More hash formats than phpass and MD5 never verify

`$2x$`, MD5-crypt, SHA-256-crypt and SHA-512-crypt hashes, which WordPress verifies through `password_verify()`, never
verify on SpeedySpec. `php::recorded_checks_replay` skips them as divergent (`$divergent` in
`crates/speedyspec-wp-password-php/tests/php.rs`), but `EXPECTED_FAILURES` names only phpass and MD5. Documented on
`content/speedyspec/password/_seam.mdx`.
