<?php

namespace App\Actions\ReportView;

class CompareAction
{
    use \App\Traits\AssetPositionsTrait;
    public function getPositions($filter)
    {
        $positions = $this->variableAssetsQuery($filter);

        $positions = $positions->map(function ($position){
            $position->value = $position->doc->shares * $position->Asset->doc->value;
            $position->type_id = $position->Asset->type_id;
            $position->last_deal = $position->doc->last_deal ?? null;
            $position->sector = $position->Asset->Sector->name ?? null;
            $position->weight = $position->getWeight() ?? null;

            return $position;
        });

        $positions = $positions->map(function ($position) use ($positions){
            $typeWeight = $positions->where('type_id', $position->Asset->type_id)->sum('doc.weight');
            $position->typeWeight = $position->doc->weight / $typeWeight;

            $position->typeValue = $positions->where('type_id', $position->Asset->type_id)->sum('value');
            $position->percent = $position->value / ($positions->where('type_id', $position->Asset->type_id)->sum('value') ?: 1);

            $position->sector_percent = $position->value / ($positions->where('sector', $position->sector)->sum('value') ?: 1);

            $typeShare = $positions->where('type_id', $position->Asset->type_id)->sum('value') / $positions->sum('value');
            $position->overall_share = $typeShare * $position->percent;

            $position->wanted = $position->typeWeight * $position->typeValue;
            $position->to_buy = $position->wanted - $position->value;
            $position->dividends = $position->value * $position->Asset->getDy() / 12 / 100;

            return $position;
        });

        if($filter->sortDir === 'desc') {
            $positions = $positions->sortByDesc($filter->sortBy);
        } else {
            $positions = $positions->sortBy($filter->sortBy);
        }

        return $positions;
    }

    public function orderPositionsBySector($positions)
    {
        $positionsBySector = [];
        foreach($positions->groupBy('Asset.sector_id') as $sectorPositions) {
            $sector = (object) [];
            $sector->name = $sectorPositions->first()->Asset->Sector->name ?? 'Unknown';
            $sector->value = $sectorPositions->sum('value');
            $sector->total_value = $positions->sum('value');
            $sector->wanted_percent = $sectorPositions->sum('doc.weight') / $positions->sum('doc.weight');
            $sector->percent = $sectorPositions->sum('value') / $positions->sum('value');
            $positionsBySector[] = $sector;
        };
        $positionsBySector = collect($positionsBySector)->sortByDesc('value');

        return $positionsBySector;
    }
}