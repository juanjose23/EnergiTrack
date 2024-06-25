<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Home extends Controller
{
    //
    public function index()
    {
        return view('Page.index');
    }
    public function nosotros()
    {
        return view('Page.about');
    }
    public function contacto()
    {
        return view('Page.contacto');
    }
}

