<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $review = Review::findOrFail($request->id);

        if ($review->user_id != $user->id)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return $next($request);
    }
}
