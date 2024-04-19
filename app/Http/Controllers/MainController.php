<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\District;
use App\Models\Currency;
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
    
    public function currencies(Request $request)
    {
        Currency::truncate();
        
        $response = Http::get('https://openexchangerates.org/api/currencies.json?prettyprint=false&show_alternative=false&show_inactive=false&app_id=1');
        $data = $response->json();

        foreach ($data as $key => $value) { 
            Currency::create([
                "code" => $key,
                "name" => $value
            ]);
        }
        return response()->json(['success' => 'success'], 200);
    }
}
