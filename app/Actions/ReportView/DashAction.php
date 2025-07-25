<?php

namespace App\Actions\ReportView;

use App\Models\Asset;
use App\Models\AssetsType;

class DashAction
{
    use \App\Traits\AssetPositionsTrait;
    public function getAssets($filter)
    {
        $assetsByType = $this->variableAssetsQuery($filter);

        $types = AssetsType::where('group_id', AssetsType::GROUP_INCOME)->get();

        $assetsByType = $assetsByType->map(function ($asset) {
            $asset->type_id = $asset->Asset->type_id;
            $asset->value = @$asset->Asset->getValue() * @$asset->getShares();

            return $asset;
        });

        $assetsByType = $assetsByType->whereIn('type_id', $types->pluck('id'));

        $totalValue = $assetsByType->sum('value');

        $assetsByType = $assetsByType->groupBy('type_id');
        $assetsByType->totalValue = $totalValue;

        $assetsByType = $assetsByType->map(function ($assets, $typeId) use ($types, $assetsByType){
            $assetType = $types->firstWhere('id', $typeId);

            $assets->type_name = $assetType->getName();
            $assets->share = $assetType->share;
            $assets->old_share = $assetType->doc->old_share;
            $assets->locale = $assetType->locale;
            $assets->variable = $assetType->variable;
            $assets->value = $assets->sum('value');
            $assets->percent = $assets->sum('value') / $assetsByType->totalValue;
            $assets->diff = $assets->share - $assets->percent;
            $assets->diff_old = $assets->old_share - ($assets->percent * 0.775);

            return $assets;
        });

        if($filter->sortDir === 'desc') {
            $assetsByType = $assetsByType->sortByDesc($filter->sortBy);
        } else {
            $assetsByType = $assetsByType->sortBy($filter->sortBy);
        }

        $assetsByType->totalValue = $totalValue;
        $assetsByType->totalShare = $assetsByType->sum('share'); 

        return $assetsByType;
    }


    public function getValueAssets($filter)
    {
        $types = AssetsType::where('group_id', AssetsType::GROUP_VALUE)->get();

        $assets = Asset::where('status_id', Asset::STATUS_ACTIVE)->whereIn('type_id', $types->pluck('id'))->with('AssetPosition')->get();

        $assets = $assets->map(function ($asset) {
            $asset->type_name = $asset->AssetType->getName();
            $asset->value = @$asset->getValue() * @$asset->AssetPosition->getShares();

            return $asset;
        });
        $total = $assets->sum('value');

        $assets = $assets->groupBy('type_name');
        $assets->total = $total;

        return $assets;
    }
}