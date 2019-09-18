<?php

namespace FireflyIII\Http\Controllers;

use EM\Hub\Library\SubProducts;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{

    public function index()
    {
        $subProducts = SubProducts::getSubProducts();

        $layout = config('whitelabels.frontend_layout', 'default');

        return view('frontpage.'.$layout.'.index', compact('subProducts'));
    }
}
