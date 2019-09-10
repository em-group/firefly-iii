<?php
/**
 * HomeController.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace FireflyIII\Http\Controllers;

use FireflyIII\User;

/**
 * Class HomeController.
 */
class MembershipController extends Controller
{

    /** @var User $user */
    protected $user;

    /**
     * HomeController constructor.
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        app('view')->share('title', trans('memberships.membership'));
        app('view')->share('mainTitleIcon', 'fa-id-card');

        $this->middleware(function($request, $next) {
            $this->user = auth()->user();

            return $next($request);
        });
    }

    /**
     * Show index.
     */
    public function index()
    {
        $membership = $this->user->currentMembership();
        $memberships = $this->user->memberships()->withTrashed()->get();

        return view('membership.index', compact('memberships', 'membership'));
    }

    public function cancel()
    {
        $this->user->cancelMembership();

        session()->flash('success', trans('memberships.cancel_success'));

        return response()->redirectToRoute('membership.index');
    }

    public function reactivate()
    {
        // todo Redirect to some membership reactivation form, probably with payment.
    }
}
