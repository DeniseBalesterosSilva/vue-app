<?php

namespace App\Actions\Entities;

use App\Models\Asset;
use App\Models\AssetPosition;

class AssetsCreateOrUpdateAction
{
    public static function run($assetData)
    {
        $assetData = (object) $assetData;
        
        $newAsset = Asset::store($assetData);

        AssetPosition::store($assetData, $newAsset->id);
    }
}