<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewAuthorGuidance
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Tambahkan panduan jika user adalah penulis baru
        if (Auth::check() && Auth::user()->role === 'author' && Auth::user()->isNewAuthor) {
            $content = json_decode($response->getContent(), true);
            
            if ($content && isset($content['article'])) {
                $content['guidance'] = [
                    'message' => 'Tips for new authors:',
                    'suggestions' => [
                        'Write regularly to build your audience',
                        'Engage with readers through comments',
                        'Use relevant categories for better visibility'
                    ]
                ];
                
                $response->setContent(json_encode($content));
            }
        }

        return $response;
    }
}