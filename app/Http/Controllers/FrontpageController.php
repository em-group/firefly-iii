<?php

namespace FireflyIII\Http\Controllers;

use EM\Hub\HubException;
use EM\Hub\Library\HubClient;
use EM\Hub\Library\SubProducts;

class FrontpageController extends Controller
{

    public function index()
    {
        $subProducts = SubProducts::getSubProducts();

        $layout = config('whitelabels.frontend_layout', 'default');

        try {
            $terms = HubClient::getTerms(substr(app()->getLocale(), 0, 2));
        } catch (HubException $e) {
            $terms = '';
        }

        return view('frontpage.'.$layout.'.index', compact('subProducts', 'terms'));
    }
}
