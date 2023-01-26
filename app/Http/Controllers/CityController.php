<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::select('cities.id', 'cities.city_name', 'cities.status', 'st.state_name')->join('states as st', 'st.id', '=', 'cities.state_id')->get();


        if ($cities) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"  => $cities
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $city = new City;

        $city->state_id = $request->state_id;
        $city->city_name = $request->city_name;

        $result = $city->save();

        if ($result) {
            return response()->json([
                'message' => "Data Inserted Successfully",
                "code"    => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }




    public function show($id)
    {
        //
    }


    public function edit(Request $request)
    {
        $result = City::where('id', $request->id)->first();


        if ($result) {
            return response()->json([
                'message' => "Data Found",
                "code"    => 200,
                "data"    => $result
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    public function update(Request $request)
    {
        $result = City::where('id', $request->id)->update([
            'state_id'      => $request->edit_state_id,
            'city_name'     => $request->edit_city_name,
            'status'        => $request->edit_status
        ]);

        if ($result) {
            return response()->json([
                'message' => "Data Updated Successfully!",
                "code"    => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $result = City::where('id', $request->id)->delete();

        if ($result) {
            return response()->json([
                'message' => "Data Deleted Successfully!",
                "code"    => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
}
