<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Services\StockDataGetter;

class Asset extends Model
{
    protected $casts = ['doc' => 'object', 'updated_at' => 'datetime'];

    const STATUS_ACTIVE = 1;

    public function AssetType() {
        return $this->belongsTo(AssetsType::class, 'type_id', 'id');
    }
    public function Sector() {
        return $this->hasOne(Sector::class, 'id', 'sector_id' );
    }
    public function AssetPosition() {
        return $this->hasOne(AssetPosition::class, 'asset_id', 'id');
    }

    public static function store($assetData)
    {
        $newAsset = Asset::where('doc->ticker', $assetData->ticker)->first();

        if(!$newAsset)
            $newAsset = new Asset();

        try{
            $doc = ($newAsset->doc) ?? (object) []; 
            $doc->ticker = strtoupper($assetData->ticker);

            if(isset($assetData->query_param))
                $doc->queryParam = $assetData->query_param;
            else
                unset($doc->queryParam);

            if(isset($assetData->dy))
                $doc->dy = $assetData->dy;
            else
                unset($doc->dy);

            $newAsset->type_id = $assetData->type_id;
            $newAsset->sector_id = $assetData->sector_id ?? null;
            $newAsset->doc = $doc;

            if(!isset($assetData->value) || $assetData->value == ""){
                $stockValueService = new StockDataGetter();
                $value = $stockValueService->getByAsset($newAsset);
            }
            else{
                $value = $assetData->value;
            }
    
            $doc->value = $value;

            $newAsset->doc = $doc;
            $newAsset->save();
            
            return $newAsset;
        }catch(\Exception $err)
        {
            dd($err);
            throw new \Exception($err->getMessage());
        }

    }


    public function updateValue()
    {
        $stockValueService = new StockDataGetter();
        $value = $stockValueService->getByAsset($this);
        
        $doc = ($this->doc) ?? (object) [];
        $doc->value = $value;
        $this->doc = $doc;

        $this->save();
    }


    public function getValue()
    {
        return $this->doc->value;
    }

    public function setValue($value)
    {
        $doc = $this->doc;
        $doc->value = $value;
        $this->doc = $doc;
        $this->save();
    }

    public function getTicker()
    {
        return $this->doc->ticker;
    }


    public function getQueryParam()
    {
        return $this->doc->queryParam;
    }


    public function getDy()
    {
        return @$this->doc->dy;
    }

    public function getDyByMonth()
    {
        $dy = $this->getDy();
        if(!$dy) return 0;

        return $dy / 100 / 12;
    }

    public function scopeSearch($query, $search)
    {
        // uso de lower para garantir que a busca seja case-insensitive
        return $query->whereRaw("LOWER(doc->>'$.ticker') LIKE LOWER(?)", ['%' . $search . '%']);
    }
}