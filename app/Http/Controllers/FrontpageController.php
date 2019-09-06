<?php

namespace FireflyIII\Http\Controllers;

use EM\Hub\Library\SubProducts;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{

    public function index()
    {
        $subProducts = SubProducts::getSubProducts();

        return view('frontpage.index', compact('subProducts'));
    }
}
