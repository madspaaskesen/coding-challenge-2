<?php

namespace App\Http\Controllers;

use App\Project;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::with('entries')->get();

        return view('home', ['projects' => $projects]);
    }
}
