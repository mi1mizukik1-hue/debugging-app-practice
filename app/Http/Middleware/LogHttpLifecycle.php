<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogHttpLifecycle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('=== Request received ===', [
            'method' => $request->method(),
            'url' => $request->url(),
            'input' => $request->all(),
        ]);

        // コントローラーを実行
        $response = $next($request);

        // レスポンス返却時（コントローラー実行後）
        \Log::info('=== Response sent ===', [
            'status' => $response->status(),
        ]);

        return $response;
    }
}
