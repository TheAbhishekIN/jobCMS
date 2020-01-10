<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Country;

class PagesController extends Controller
{
    public function render_data(Request $request)
    {
        if ($request->ajax()) {
        	if ($request['action']=='GetCountry') {
            $_all_countries = DB::table('countries')->pluck('name','id');
        		$_data = ['all_countries'=>$_all_countries,'action'=>$request['action']];
        	return response()->json($_data);
        	}

        	if ($request['action']=='GetStates') {
            $_all_states = DB::table('states')->where('country_id',$request['country_id'])->pluck('name','id');
            // pr($_all_states);
        		$_data = ['all_states'=>$_all_states,'action'=>$request['action']];
        	return response()->json($_data);
        	}
        }
    }

}
