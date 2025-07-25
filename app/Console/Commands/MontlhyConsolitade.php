<?php

namespace App\Console\Commands;

use App\Actions\ReportView\DashAction;
use App\Models\Consolidated;
use Illuminate\Console\Command;

class MontlhyConsolitade extends Command
{
    protected $signature = 'consolidate:monthly';

    protected $description = 'Extract a consolidate data, providing a monthly picture of investments.';



    public function handle()
    {
        $this->info('Starting the monthly consolidation process...');

        $assets = (new DashAction)->getAssets((object) ['search' => '', 'assetTypeId' => '', 'sortBy' => 'type_name', 'sortDir' => 'asc']);

        $doc = [];

        foreach($assets as $typeId => $assetType)
        {
            $doc[$assetType->type_name] = round($assetType->sum('value'));
            echo("Ativo de renda: $assetType->type_name: " . round($assetType->sum('value')). "\n");
        }

        $valueAssets = (new DashAction)->getValueAssets((object) ['search' => '', 'assetTypeId' => '', 'sortBy' => 'type_name', 'sortDir' => 'asc']);

        foreach($valueAssets as $type => $valueAsset)
        {
            $doc[$type] = round($valueAsset->sum('value'));
            echo("Ativo de valor: $type: " . round($valueAsset->sum('value')). "\n");
        }

        $doc['Total'] = round(array_sum($doc));
        echo("-> Total: " . $doc['Total']. "\n");

        $consolidate = new Consolidated();
        $consolidate->store((object) ['doc' => $doc]);

        $this->info('Finished the monthly consolidation process.');
    }
}
