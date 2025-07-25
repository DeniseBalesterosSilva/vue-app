<?php

namespace App\Actions\ReportView;

class AssetsListAction
{
    use \App\Traits\AssetPositionsTrait;
    public function getAssets($filter)
    {
        $assets = $this->variableAssetsQuery($filter);

        $assets = $assets->map(function ($asset) {
            $asset->type_name = $asset->Asset->AssetType->getName();
            $asset->name = $asset->Asset->getTicker();
            $asset->sector_name = @$asset->Asset->Sector->name;
            $asset->weight = @$asset->getWeight();
            $asset->shares = @$asset->getShares();
            $asset->value = @$asset->Asset->getValue();
            $asset->dy = @$asset->Asset->getDy();

            return $asset;
        });

        if($filter->sortDir === 'desc') {
            $assets = $assets->sortByDesc($filter->sortBy);
        } else {
            $assets = $assets->sortBy($filter->sortBy);
        }

        return $assets;
    }
}