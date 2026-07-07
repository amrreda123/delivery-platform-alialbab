<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Setting;

class HomeController extends Controller
{
    public function home() {
        $categories = Category::where('is_active', true)->get();

        return view('home', compact('categories'));
    }

    public function services() {
        $categories = Category::where('is_active', true)->get();
        return view('services', compact('categories'));
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
