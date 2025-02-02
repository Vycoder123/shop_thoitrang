<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Chuyển hướng nếu chưa đăng nhập
            return redirect()->route('login.form')->with('error', 'Bạn cần đăng nhập!');
        }

        if (Auth::user()->role !== $role) {
            // Chuyển hướng nếu vai trò không phù hợp
            return redirect()->route('home.index')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}
