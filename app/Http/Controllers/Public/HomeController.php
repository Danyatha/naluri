<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home');
    }
}
