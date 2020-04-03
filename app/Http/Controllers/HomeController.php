<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(env('APP_ENV') == 'local') {
            $stat['total'] = 429;
            $stat['positives'] = 15;
            $stat['pending'] = 149;
            $stat['negatives'] = 263;
        }
        else {
            $url = 'https://i.saludiquique.cl/monitor/lab/suspect_cases/stat';
            $response = Http::get($url);
            $stat = $response->json();
        }


        return view('welcome',compact('stat'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }
}
