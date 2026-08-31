<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        $supportedLocales = ['en', 'id'];

        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
        } else {
            App::setLocale('id');
        }

        return $next($request);
    }
}