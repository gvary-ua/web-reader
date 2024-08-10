<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ValidateSignatureCloudfrontTls
{
    public $keyResolver;

    public function __construct()
    {
        $this->keyResolver = function () {
            return App::make('config')->get('app.key');
        };
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, ...$args)
    {
        if ($this->hasValidSignature($request)) {
            return $next($request);
        }
        throw new InvalidSignatureException;
    }

    // Copied from
    // vendor/laravel/framework/src/Illuminate\Routing/UrlGenerator:402

    /**
     * Determine if the given request has a valid signature.
     *
     * @param  bool  $absolute
     * @return bool
     */
    public function hasValidSignature(Request $request, $absolute = true, array $ignoreQuery = [])
    {
        return $this->hasCorrectSignature($request, $absolute, $ignoreQuery)
            && $this->signatureHasNotExpired($request);
    }

    /**
     * Determine if the signature from the given request matches the URL.
     *
     * @param  bool  $absolute
     * @return bool
     */
    public function hasCorrectSignature(Request $request, $absolute = true, array $ignoreQuery = [])
    {
        $ignoreQuery[] = 'signature';

        $url = $absolute ? $request->url() : '/'.$request->path();

        /**
         * WARNING: This is the the only difference from copied code!
         * We need this because
         * 1. I terminate TLS on cloudfront, so the path is
         *    user -https-> CF -http-> nginx -http-> php
         * Thus php returns http URLs in the html.
         * 2. To fix this ^ I forced https
         * But now there is a problem with signature because
         * php generates https:// urls and nginx sends http:// urls
         * which results in mismatch.
         * 3. That's why I did this hack.
         *
         * See: https://stackoverflow.com/questions/52525958/signed-route-for-email-verification-does-not-pass-signature-validation
         */
        $url = str_replace('http://', 'https://', $url);
        /**
         * Difference ends!
         */
        $queryString = collect(explode('&', (string) $request->server->get('QUERY_STRING')))
            ->reject(fn ($parameter) => in_array(Str::before($parameter, '='), $ignoreQuery))
            ->join('&');

        $original = rtrim($url.'?'.$queryString, '?');

        $signature = hash_hmac('sha256', $original, call_user_func($this->keyResolver));

        return hash_equals($signature, (string) $request->query('signature', ''));
    }

    /**
     * Determine if the expires timestamp from the given request is not from the past.
     *
     * @return bool
     */
    public function signatureHasNotExpired(Request $request)
    {
        $expires = $request->query('expires');

        return ! ($expires && Carbon::now()->getTimestamp() > $expires);
    }
}
