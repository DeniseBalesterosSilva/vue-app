<?php

namespace App\Http\Controllers;

use App\Models\RegulamentoChunk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $chunks = RegulamentoChunk::whereNotNull('artigo');
        
        if($request->get('search')) {
            $chunks = $chunks->where('conteudo', 'like', '%' . $request->get('search') . '%')
                ->orWhere('titulo', 'like', '%' . $request->get('search') . '%');
        }
        
        $chunks = $chunks->paginate(8);

        return Inertia::render('Dashboard', [
            'chunks' => $chunks,
        ]);
    }
}
