<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserGroup
{
    public function handle(Request $request, Closure $next, ...$groups)
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Load the 'group' relation to avoid issues with lazy loading
        $user->load('group');

        // Get the name of the user's group
        $userGroup = $user->group->name ?? null;

        // Check if the user's group is in the list of allowed groups
        if (!in_array($userGroup, $groups)) {
            // If not, redirect to the login page with an error message
            return redirect()->route('landing_page')->with('error', 'Unauthorized access');
        }

        // Allow the request to proceed if the group is valid
        return $next($request);
    }
}
