<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class StaticPageController extends Controller {
    /**
     * Display the "About Workopia" page.
     */
    public function about(): View {
        return view('pages.about');
    }

    /**
     * Display the "Contact Us" page.
     */
    public function contact_us(): View {
        return view('pages.contact-us');
    }

    /**
     * Display the pricing page.
     */
    public function pricing(): View {
        return view('pages.pricing');
    }

    /**
     * Display the welcome page.
     */
    public function welcome(): View {
        return view('pages.welcome');
    }
}
