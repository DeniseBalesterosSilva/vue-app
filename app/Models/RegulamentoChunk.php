<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulamentoChunk extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo", "artigo", "pagina", "conteudo", "embedding", "created_at"
    ];
}
