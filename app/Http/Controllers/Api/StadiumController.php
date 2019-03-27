<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stadium;
use App\Http\Resources\Stadium as StadiumResource;
use Illuminate\Support\Facades\DB;

class StadiumController extends Controller
{
    public function getAllStadiums()
    {
        $stadiums = Stadium::all();
        return StadiumResource::collection($stadiums);
    }

    public function store(Request $request)
    {
        $stadium = new Stadium();
        $stadium->stadium_name = $request->input('stadium_name');
        $stadium->pitch_type = $request->input('pitch_type');
        $stadium->is_free = $request->input('is_free');
        $stadium->latitude = $request->input('latitude');
        $stadium->longitude = $request->input('longitude');
        if ($stadium->save())
          return new StadiumResource($stadium);
        return response()->json('An error occured.');
    }


    function nearbyStadiums(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');
        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM stadiums HAVING distance < ' . 10 . ' ORDER BY distance') );
        if($results){
            return ($results);
        }else{
            return response()->json('No nearby stadiums found');
        }
    }
}
