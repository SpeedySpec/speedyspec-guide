<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus the Requests library's autoloader and a transport that answers from a queue.
 *
 *  `class-wp-http.php` registers the autoloader the same way. Requests sent with the `transport` option set to
 *  `Guide_Queue_Transport` never leave the machine: each gets the next raw HTTP response queued with
 *  `Guide_Queue_Transport::$responses`, and the request is recorded in `Guide_Queue_Transport::$sent`, so the
 *  library's parsing, redirects, cookies and hooks run on real responses.
 */

require __DIR__ . '/../basic-setup.php';

WpOrg\Requests\Autoload::register();
WpOrg\Requests\Requests::set_certificate_path(ABSPATH . WPINC . '/certificates/ca-bundle.crt');

/** A transport that answers each request with the next queued raw response. */
final class Guide_Queue_Transport implements WpOrg\Requests\Transport
{
    /** @var list<string> The raw responses to give, in order. */
    public static array $responses = [];

    /** @var list<array{url: string, headers: array, data: mixed, method: string}> The requests sent. */
    public static array $sent = [];

    public function request($url, $headers = [], $data = [], $options = [])
    {
        self::$sent[] = ['url' => $url, 'headers' => $headers, 'data' => $data, 'method' => $options['type']];
        return array_shift(self::$responses) ?? "HTTP/1.1 500 No response queued\r\n\r\n";
    }

    public function request_multiple($requests, $options)
    {
        $out = [];
        foreach ($requests as $id => $request)
        {
            $out[$id] = $this->request($request['url'], $request['headers'], $request['data'], $request['options']);
            $request['options']['hooks']->dispatch('transport.internal.parse_response', [&$out[$id], $request]);
        }
        return $out;
    }

    public static function test($capabilities = [])
    {
        return true;
    }
}
