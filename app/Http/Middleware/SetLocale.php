<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL; // Tambahkan facade URL
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        $supportedLocales = ['en', 'id'];

        if (!in_array($locale, $supportedLocales)) {
            $locale = 'id';
        }

        App::setLocale($locale);

        // Mengeset URL default parameter 'locale' secara otomatis
        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}