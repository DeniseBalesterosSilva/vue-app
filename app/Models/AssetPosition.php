<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;

use App\Models\Asset;
use App\Traits\UserTrait;

class AssetPosition extends Model
{
    use UserTrait;

    public $table = 'assets_positions';
    protected $casts = ['doc' => 'object'];
    
    public function Asset() {
        return $this->hasOne(Asset::class, 'id', 'asset_id');
    }

    public static function store($positionData, $assetId)
    {
        $asset = Asset::find($assetId);

        $position = AssetPosition::where('user_id', self::getUserId())->where('asset_id', $asset->id)->first();

        if(!$position)
        {
            $position = new AssetPosition();
            $position->user_id = self::getUserId();
            $position->asset_id = $asset->id;
        }

        $doc = ($position->doc) ?? (object) [];
        if(@$positionData->buy){
            $doc->last_deal = date('Y-m-d');
        }
        $doc->weight = $positionData->weight;
        $doc->shares = ($positionData->shares) ?? 0;

        $position->doc = $doc;
        $position->save();

        return $position;
    }


    public static function getPositionByTicker($ticker)
    {
        $asset = Asset::where('doc->ticker', $ticker)->first();
        if(!$asset){
            throw new Exception("Não foi possível encontrar o asset para o ticker $ticker");
        }

        $position = AssetPosition::where('asset_id', $asset->id)->first();
        if(!$position){
            throw new Exception("Não foi possível encontrar o position para o asset Id {$asset->id}");
        }

        return $position;
    }


    // AUX
    public function getWeight()
    {
        return $this->doc->weight;
    }

    public function getShares()
    {
        return $this->doc->shares;
    }
}
