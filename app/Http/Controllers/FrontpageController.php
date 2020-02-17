<?php

namespace FireflyIII\Http\Controllers;

use EM\Hub\Library\SubProducts;
use EM\Hub\Library\HubClient;
use EM\Hub\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FrontpageController extends Controller
{
    public function index(Request $request)
    {
        $currency = strtolower($request->get('currency'));
        if($currency){
            $locale = $currency === 'eur' ? 'ie' : 'us';
        }else{
            $locale = explode('_', App::getLocale());
            $locale = strtolower($locale[1] ?? $locale[0]);
            $currency = 'usd';
        }

        $subProducts = SubProducts::getSubProducts($locale)->keyBy(function(SubProduct $subProduct){
            return $subProduct->index;
        });
        $domain = config('whitelabels.domain');
        $terms = Cache::remember('frontpage_terms_'.$domain.'_'.$locale, now()->addDay(), function() use($locale){
            return HubClient::getTerms($locale);
        });
        $layout = config('whitelabels.frontend_layout', 'default');
        return view('frontpage.'.$layout.'.index', compact('subProducts','terms', 'currency'));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \EM\Hub\HubException
     */
    public function signup(Request $request)
    {
        $locale = explode('_', App::getLocale());
        $locale = strtolower($locale[1] ?? $locale[0]);
        $link = HubClient::getLandingpageLink(config('landingpage.hub_signup_source_uid'), ['locale' => $locale], ['name' => config('landingpage.hub_signup_product_name')], $request->get('spi'));
        return redirect()->to($link['link'], 302);
    }
}
