<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsolidatedController extends Controller
{
    public function index(Request $request)
    {
        $consolidateds = new \App\Models\Consolidated();
        
        if($request->sortDir === 'desc') {
            $consolidateds = $consolidateds->orderByDesc($request->sortBy);
        } 
        elseif($request->sortDir === 'asc') {
            $consolidateds = $consolidateds->orderBy($request->sortBy);
        } else {
            $consolidateds = $consolidateds->orderByDesc('date');
        }

        $consolidateds = $consolidateds->paginate(20);

        $types = \App\Models\Consolidated::orderBy('date', 'desc')->first();
        $types = get_object_vars($types->doc);
        unset($types['Total']);
        $types = array_keys($types);

        return Inertia::render('Consolidated', [
            'consolidateds' => $consolidateds,
            'types' => $types,
            'sortBy' => $request->sortBy ?? 'date',
            'sortDir' => $request->sortDir ?? 'desc',

            'message' => session('message'),
        ]);
    }
}
