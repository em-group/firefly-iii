<?php

namespace FireflyIII\Http\Middleware;

use Closure;
use FireflyIII\User;

class RequiresMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var User $user */
        $user = auth()->user();

        if (preg_match('/^membership|variables/im', $request->route()->uri) === 0) {
            $membership = $user->currentMembership();
            if (empty($membership) || $membership->expires_at->isPast()) {

                return redirect(route('membership.index'));
            }
        }

        return $next($request);
    }

}
