<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetsType extends Model
{
    protected $casts = ['doc' => 'object'];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const GROUP_INCOME = 1;
    const GROUP_VALUE = 2;

    public function Assets() {
        return $this->hasMany(Asset::class, 'type_id', 'id')->where('status_id', Asset::STATUS_ACTIVE);
    }

    // AUX
    public function getName()
    {
        return $this->doc->name;
    }

    public static function getId($typeName)
    {
        $type = AssetsType::select('id')->where('doc->name', $typeName)->first();

        if(!$type)
            throw new \Exception("Tipp $typeName não encontrado.");

        return $type->id;
    }
}