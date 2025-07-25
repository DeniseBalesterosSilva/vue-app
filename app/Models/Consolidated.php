<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consolidated extends Model
{
    protected $table = 'consolidated';
    protected $casts = ['doc' => 'object'];


    public function store($data)
    {
        $this->user_id = 1;
        $this->date = new \DateTime('today');
        $this->doc = $data->doc;
        $this->status_id = 1;
        $this->save();
    }
}