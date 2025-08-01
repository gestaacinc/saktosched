<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;

class HomeController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::where('is_active', true)->get();
        return view('home', ['qualifications' => $qualifications]);
    }
}
