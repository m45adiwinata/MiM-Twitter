<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $data['user'] = Auth::user();
            return view('home', $data);
        }
        
        return redirect()->route('relog');
    }
}
