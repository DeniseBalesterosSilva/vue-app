<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $priorities = [
            1 => 'High',
            1 => 'Medium',
            3 => 'Low',
        ];

        return Inertia::render('Compare', [
           'priorities' => $priorities,
        ]);
    }
}
