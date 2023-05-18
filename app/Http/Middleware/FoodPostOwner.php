<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Food;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FoodPostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $food = Food::findOrfail($request->id);

        if($food->author != $currentUser->id)
        {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return $next($request);
    }
}
