<?php

namespace App\Http\Controllers;

use App\Actions\ReportView\CompareAction;
use App\Http\Resources\PositionResource;
use App\Models\AssetsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $filter = (object) [
            'search' => $request->search,
            'assetTypeId' => $request->assetTypeIdSelected,
            'sortBy' => $request->sortBy,
            'sortDir' => $request->sortDir,
        ];
        $positions = (new CompareAction())->getPositions($filter);

        $positionsBySector = (new CompareAction())->orderPositionsBySector($positions);

        $assetTypes = AssetsType::select('id', DB::raw('doc->>"$.name" as name'))->where('share', '>', 0)->get();

        return Inertia::render('Compare', [
            'positions' => PositionResource::collection($positions),
            'assetTypes' => $assetTypes,
            'positionsBySector' => $positionsBySector,
            'sortBy' => $request->sortBy ?? 'asset_ticker',
            'sortDir' => $request->sortDir ?? 'asc',
            'selectedAssetType' => $request->assetTypeIdSelected
        ]);
    }
}
