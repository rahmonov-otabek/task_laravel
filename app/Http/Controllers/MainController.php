<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\District;
use Spatie\QueryBuilder\QueryBuilder;

class MainController extends Controller
{
    public function regionsList(Request $request)
    {
        $regions = Region::all(); 
        return response()->json($regions);
    }

    public function districtsList(Request $request)
    {
        $districts = QueryBuilder::for(District::class)
            ->allowedFilters('region_id')
            ->get();  
        return response()->json($districts);
    }
}
