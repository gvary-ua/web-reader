<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        $supportedLocales = config('app.SUPPORTED_LOCALES');
        $defaultLocale = config('app.DEFAULT_LOCALE');

        $acceptLanguage = $request->header('Accept-Language');

        $appLocale = $defaultLocale;
        if (session('locale')) {
            $appLocale = session('locale');
        } elseif (Auth::check()) {
            $userLang = Auth::user()['locale'];

            if ($userLang) {
                // If user has locale set specifically in a settings, then use it
                $appLocale = $userLang;
                session(['locale' => $userLang]);
            }
        } elseif ($acceptLanguage) {
            $locales = $this->parseLocaleFromHeader($acceptLanguage);
            $chosenLocaleFromHeader = $this->chooseLocale($locales, $supportedLocales, $defaultLocale);

            // Doesn't have in a session nor in a db.
            $appLocale = $chosenLocaleFromHeader;
            session(['locale' => $chosenLocaleFromHeader]);
        }

        app()->setLocale($appLocale);

        return $next($request);
    }

    /*
    This get you from headers like this
    string 'en-US,en;q=0.8,uk;q=0.6,ru;q=0.4' (length=32)
    array like this
    array(3) {
        [0]=>
        string(2) "en"
        [1]=>
        string(2) "en"
        [2]=>
        string(2) "uk"
    }
    */
    private function parseLocaleFromHeader(string $header)
    {
        $prefLocales = array_reduce(
            explode(',', $header),
            function ($res, $el) {
                [$langRegion] = explode(';q=', $el);
                [$lang] = explode('-', $langRegion);
                array_push($res, $lang);

                return $res;
            }, []);

        return $prefLocales;
    }

    private function chooseLocale(array $locales, array $supportedLocales, string $defaultLocale)
    {
        foreach ($locales as $locale) {
            if (in_array($locale, $supportedLocales)) {
                return $locale;
            }
        }

        return $defaultLocale;
    }
}
