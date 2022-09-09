<?php

namespace FireflyIII\Http\Controllers;

use EM\Hub\Library\FormatsCurrencyObject;
use EM\Hub\Library\SubProducts;
use EM\Hub\Library\HubClient;
use EM\Hub\Models\HubCountryInterface;
use EM\Hub\Models\SubProduct;
use FireflyIII\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FrontpageController extends Controller
{
    public function index(Request $request)
    {
        ['locale' => $locale, 'currency' => $currency] = $this->getLocaleAndCurrency($request);
        $subProducts = SubProducts::getSubProducts($locale)->keyBy(function(SubProduct $subProduct){
            return $subProduct->index;
        });
        /** @var HubCountryInterface $country */
        $country = app(HubCountryInterface::class)->where('iso_currency', $currency)->first();
        $trial_price = $country ? FormatsCurrencyObject::formatCurrency($country->currency_object, $country->trial_price) : '$1';
        $domain = config('whitelabels.domain');
        $terms = Cache::remember('frontpage_terms_'.$domain.'_'.$locale, now()->addDay(), function() use($locale){
            return HubClient::getTerms($locale);
        });
        $layout = config('whitelabels.frontend_layout', 'default');
        return prefixView('frontpage.'.$layout.'.index', compact('subProducts','terms', 'currency', 'trial_price'));
    }

    public function terms(Request $request)
    {
        ['locale' => $locale, 'currency' => $currency] = $this->getLocaleAndCurrency($request);
        $domain = config('whitelabels.domain');
        $terms = Cache::remember('frontpage_terms_'.$domain.'_'.$locale, now()->addDay(), function() use($locale){
            return HubClient::getTerms($locale);
        });
        return prefixView('frontpage.terms', compact('terms'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \EM\Hub\HubException
     */
    public function signup(Request $request)
    {
        ['locale' => $locale] = $this->getLocaleAndCurrency($request);
        $siteDomain = config('whitelabels.domain');
        $link = HubClient::getSiteRegistrationLink(config('landingpage.hub_signup_source_uid'), ['locale' => $locale], ['name' => config('landingpage.hub_signup_product_name')], $request->get('spi'), $siteDomain);
        if(strpos($link['link'], '?') !== false){
            $link['link'] = rtrim($link['link'], '&').'&pf=1';
        }else{
            $link['link'] .= '?pf=1';
        }
        return redirect()->to($link['link'], 302);
    }

    private function getLocaleAndCurrency(Request $request)
    {
        $currency = strtolower($request->get('currency'));
        if($currency){
            $locale = $currency === 'eur' ? 'ie' : 'us';
        }else{
            $locale = explode('_', App::getLocale());
            $locale = strtolower($locale[1] ?? $locale[0]);
            $currency = 'usd';
        }
        return ['locale' => $locale, 'currency' => $currency];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws ValidationException
     */
    public function unsub(Request $request)
    {
        session()->setPreviousUrl('/unsub');
        if ($request->method() === 'POST') {
            $request->validate([
                'email' => 'required|string'
            ]);
            /** @var User $user */
            $user = User::whereEmail($request->input('email'))->first();
            // Unsubscribe email
            if (!is_null($user)) {
                $user->cancelMembership();
                try {
                    if (config('app.unsubscribe_email_notifications') &&
                        !cache()->has('cancellation_email_' . $user->id))
                    {
                        cache()->put('cancellation_email_' . $user->id, now()->addDay(), true);
                        $text = 'User unsubscribed from ' . config('app.name') . ': ' . $user->email;
                        Mail::raw($text, function ($message) {
                            $message->from(config('mail.from.address'), config('mail.from.name'));
                            $message->to(config('app.unsubscribe_email_notifications'));
                            $message->subject('User submitted cancellation from website');
                        });
                    }
                } catch (\Throwable $e) {
                    dd($e->getMessage());
                }
                session()->flash('success', trans('firefly.success_unsub'));
            } else if (true) {
                throw ValidationException::withMessages([
                    'email' => [trans('auth.failed')],
                ]);
            }
        }
        return prefixView('frontpage.unsub');
    }
}
