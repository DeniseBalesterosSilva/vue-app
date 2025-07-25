<?php

namespace App\Services;

use App\Infra\Adapters\BrapiStockApi;
use App\Infra\Adapters\PolygonStockApi;
use App\Models\AssetsType;

class StockDataGetter
{
    public $usAssetTypes;

    public function __construct()
    {
        $this->usAssetTypes = [AssetsType::getId('Stock'), AssetsType::getId('ETF'), AssetsType::getId('REIT'), AssetsType::getId('Global'), AssetsType::getId('Bonds')];
    }


    public function getByAsset($asset)
    {   
        if(in_array($asset->type_id, $this->usAssetTypes)){
            $currency = "US";
            $value = $this->getValueAsUS($asset);
        }
        else{
            $currency = "BR";
            $value = $this->getValueAsBR($asset);
        }

        if(!is_numeric($value)){
            return false;
        }

        $value = ($currency == "US") ? $value * exchangeRate() : $value;

        return $value;
    }


    public function getValueAsUS($asset)
    {
        $polygonStockApi = new PolygonStockApi();
        return $polygonStockApi->getStockValue($asset);
    }

    public function getValueAsBR($asset)
    {
        $brapiStockApi = new BrapiStockApi();
        $response = $brapiStockApi->getStockValue($asset);

        if($response) return $response;

        else throw new \Exception("Erro na busca Brapi para asset {$asset->getTicker()}");
    }
}
