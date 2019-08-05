<?php

declare(strict_types=1);

namespace FireflyIII\Http\Middleware;

use Closure;
use FireflyIII\Helpers\FeatureAccess\UserLevel;
use FireflyIII\Repositories\User\UserRepositoryInterface;
use FireflyIII\User;
use Illuminate\Http\Request;

class FeatureAccess
{

    public function handle(Request $request, Closure $next, $level = 'invalid')
    {
        /** @var UserRepositoryInterface $userRep */
        $userRep = app(UserRepositoryInterface::class);
        /** @var User $user */
        $user = auth()->user();
        if (!$userRep->hasFeature($user, new UserLevel($level))) {
            // todo Probably shouldn't be in the error key.
            session()->flash('error', 'You do not have access to this feature, with your current plan');
            return redirect('/'); // Maybe just go back to the previous page?
        }

        return $next($request);
    }
}