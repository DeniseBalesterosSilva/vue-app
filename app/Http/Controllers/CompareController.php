<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $priorities =  collect([
            ['id' => 1, 'name' => 'High'],
            ['id' => 2, 'name' => 'Medium'],
            ['id' => 3, 'name' => 'Low'],
        ]);

        return Inertia::render('Compare', [
           'priorities' => $priorities,
        ]);
    }


    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'priority' => 'required|integer|between:1,3',
            ]);
            
            Todo::updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->name, 'priority' => $request->priority]
            );
            
            return redirect()->route('compare')->with('success', 'Todo saved successfully!');
        }catch (\Exception $e) {
            return redirect()->route('compare')->withErrors(['error' => 'Failed to save Todo: ' . $e->getMessage()]);
        }
    }
}
