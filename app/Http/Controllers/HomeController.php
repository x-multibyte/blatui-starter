<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view(config('blatui.pages.home'));
    }
}
