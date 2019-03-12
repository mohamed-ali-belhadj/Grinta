<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Stadium;
use App\Http\Resources\Stadium as StadiumResource;

class StadiumController extends Controller
{
    /**
     * Display a listing of  all  stadiums.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStadiums()
    {
        $stadiums = Stadium::all();
        return StadiumResource::collection($stadiums);
    }
    /**
     * Store a newly created stadium in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
