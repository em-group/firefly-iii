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
    public function index()
    {
        $locale = explode('_', App::getLocale());
        $locale = strtolower($locale[1] ?? $locale[0]);
        $subProducts = SubProducts::getSubProducts($locale)->keyBy(function(SubProduct $subProduct){
            return $subProduct->index;
        });
        $domain = config('whitelabels.domain');
        $terms = Cache::remember('frontpage_terms_'.$domain.'_'.$locale, now()->addDay(), function() use($locale){
            return HubClient::getTerms($locale);
        });
        $layout = config('whitelabels.frontend_layout', 'default');
        return view('frontpage.'.$layout.'.index', compact('subProducts','terms'));
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
        $link = HubClient::getLandingpageLink(getenv('EMHUB_SIGNUP_SOURCE_UID'), ['locale' => $locale], ['name' => getenv('EMHUB_SIGNUP_PRODUCT_NAME')], $request->get('spi'));
        return redirect()->to($link['link'], 302);
    }
}
