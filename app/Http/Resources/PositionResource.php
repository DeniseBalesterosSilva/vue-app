<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'asset_type'       => $this->Asset?->AssetType?->getName() ?? '—',
            'asset_ticker'     => $this->Asset?->getTicker() ?? '—',
            'asset_id'         => $this->Asset?->id,
            'weight'           => $this->weight,
            'value'            => moneyFormat($this->value),
            'wanted'           => moneyFormat($this->wanted),
            'to_buy'           => moneyFormat($this->to_buy),
            'sector'           => $this->sector,
            'sector_percent'   => percentFormat($this->sector_percent),
            'percent'          => percentFormat($this->percent),
            'overall_share'    => percentFormat($this->overall_share),
            'dividends'        => moneyFormat($this->dividends),
            'last_deal'        => $this->last_deal ?? '—',
            'date'             => $this->date, // se estiver usando também
        ];
    }
}
