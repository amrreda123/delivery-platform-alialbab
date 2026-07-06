<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        return view('home');
    }

    public function services() {
        return view('services');
    }

    public function howItWorks() {
        return view('how-it-works');
    }

    public function faq() {
        return view('faq');
    }

    public function contact() {
        return view('contact');
    }
}
