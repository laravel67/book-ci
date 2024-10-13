<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        return view('home/index');
    }

    public function about()
    {
        return view('home/about');
    }

    public function blog()
    {
        return view('home/blog');
    }

    public function contact()
    {
        return view('home/contact');
    }
}
