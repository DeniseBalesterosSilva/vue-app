<?php

namespace App\Traits;

use App\Models\Asset;
use App\Models\AssetPosition;
use App\Models\AssetsType;

trait AssetPositionsTrait
{
    public function variableAssetsQuery($filter)
    {
        $assetTypes = AssetsType::where('share', '>', 0)->get();

        $assets = Asset::where('status_id', Asset::STATUS_ACTIVE)
        ->when($filter->assetTypeId, function ($query) use ($filter) {
            return $query->where('type_id', $filter->assetTypeId);
        })
        ->when($filter->search, function ($query) use ($filter) {
            return $query->whereRaw("LOWER(doc->>'$.ticker') LIKE LOWER(?)", ['%' . $filter->search . '%']);
        })
        ->whereIn('type_id', $assetTypes->pluck('id'))->get();

        $positions = AssetPosition::whereIn('asset_id', $assets->pluck('id'))->with('Asset')->get();

        return $positions;
    }
}