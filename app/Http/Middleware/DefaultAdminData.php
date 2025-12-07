<?php

namespace App\Http\Middleware;

use App\Models\Contact;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class DefaultAdminData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user();

        if($user)
        {
            $message = Contact::where('is_replied', 0)->latest()->get();
        }
        else{
            $message = [];
        }
        View::share([
            'message' => $message,
            'user' => $user,
        ]);
        
        return $next($request);
    }
}
