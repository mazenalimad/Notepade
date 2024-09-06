<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = 'Welcome in my firse laravel';
        return view('Pages.index')->with('title', $title);
    }

    public function content() {
        return view('Pages.content');
    }

    public function about() {
        $data = array(
            'title'=> 'about',
            'services' => ['name', 'age', 'lable']
        );
        return view('Pages.about')->with($data);
    }
}
