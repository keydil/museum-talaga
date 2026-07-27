<?php

namespace App\Http\Middleware;

Closure;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\PageView;
use Illuminate\Support\Facades\Schema;
use Exception;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests for non-admin, non-asset, non-livewire routes
        if ($request->isMethod('GET') && !$request->is('admin*') && !$request->is('livewire*') && !$request->is('up')) {
            try {
                if (Schema::hasTable('page_views')) {
                    $ip = $request->ip();
                    $sessionId = session()->getId();
                    $today = now()->toDateString();

                    // Anti-Spam / Deduplikasi: 1 IP hanya dicatat 1x Pengunjung Unik per hari
                    PageView::firstOrCreate([
                        'ip_address' => $ip,
                        'view_date'  => $today,
                    ], [
                        'url'        => substr($request->fullUrl(), 0, 250),
                        'session_id' => $sessionId,
                    ]);
                }
            } catch (Exception $e) {
                // Silently ignore DB write errors to never interrupt visitor response
            }
        }

        return $response;
    }
}
