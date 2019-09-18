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

use EM\Hub\Library\CreateAccount;
use EM\Hub\Library\SubProducts;
use FireflyIII\Http\Middleware\FeatureAccess;
use FireflyIII\User;
use Illuminate\Http\Request;

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
        $hasActiveMembership = $this->user->hasActiveMembership();
        $membership = $this->user->currentMembership();
        $memberships = $this->user->memberships()
            ->withTrashed()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('membership.index', compact('memberships', 'membership', 'hasActiveMembership'));
    }

    public function cancel()
    {
        $this->user->cancelMembership();

        session()->flash('success', trans('memberships.cancel_success'));

        return response()->redirectToRoute('membership.index');
    }

    public function reactivate()
    {
        $success = false;
        // Any membership ever
        if (!empty($membership = $this->user->currentMembership())) {

            // A still-active membership
            if ($membership->expires_at->isPast()) {
                $membership = $this->user->reactivateMembership();
                if (!empty($membership)) {
                    $success = true;
                    session()->flash('success', trans('memberships.reactivated_success'));
                }
            }
        }

        if (!$success) {
            session()->flash('error', trans('memberships.reactivate_error'));
        }

        return response()->redirectToRoute('membership.index');
    }

    public function buy()
    {
        $subProducts = SubProducts::getSubProducts();
        $subProducts->map(function($product) {
            $product->data = array_merge(
                $product->data,
                ['features' => FeatureAccess::getFeatureNames($product->index)]
            );
        });
        $purchaseLink = '/membership/payment';

        $subdomain = preg_replace('/https?:\/\//', '$0*.', config('app.url')).':*';

        return response()->view(
            'membership.purchase',
            compact('subProducts', 'purchaseLink'),
            200,
            ['Content-Security-Policy' => "frame-src 'self' $subdomain"]
        );
    }

    public function forwardToPayment(Request $request)
    {
        $product_index = $request->input('product_index');

        ['url' => $url] = CreateAccount::getPaymentLink($this->user, $product_index);

        return redirect($url, 302, ['X-Frame-Options' => 'SAMEORIGIN']);
    }
}
