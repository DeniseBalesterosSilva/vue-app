<?php

namespace App\Http\Controllers;

use App\Models\RegulamentoChunk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChunkController extends Controller
{
    public function index(Request $request)
    {
        $chunk = RegulamentoChunk::where('id', $request->route('id'))->firstOrFail();

        return Inertia::render('Chunk', [
            'chunk' => $chunk,
            'message' => session('message'),
        ]);
    }


    public function store(Request $request)
    {
        $chunk = RegulamentoChunk::where('id', $request->input('id'))->firstOrFail();

        $chunk->conteudo = $request->input('conteudo');
        $chunk->save();

        return redirect()->route('chunk', ['id' => $chunk->id])
            ->with('message', 'Chunk updated successfully!');
    }
}
