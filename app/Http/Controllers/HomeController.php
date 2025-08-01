<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::where('is_active', true)->orderBy('title')->get();
        return view('home', compact('qualifications'));
    }
}