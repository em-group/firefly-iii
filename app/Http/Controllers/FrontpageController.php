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
}
