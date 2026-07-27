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

                    // Optional deduplication per IP & session per day if desired, or record page hit
                    PageView::create([
                        'ip_address' => $ip,
                        'url'        => substr($request->fullUrl(), 0, 250),
                        'session_id' => $sessionId,
                        'view_date'  => $today,
                    ]);
                }
            } catch (Exception $e) {
                // Silently ignore DB write errors to never interrupt visitor response
            }
        }

        return $response;
    }
}
