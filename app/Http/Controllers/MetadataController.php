<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Keyword;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function redirect;
use function view;

class MetadataController extends Controller {

    public function addKeyword() {
        return view('metadata/keywords/add');
    }

    public function saveKeyword(Request $request) {
        $validator = Validator::make($request->all(), [
                    'keyword_name' => 'required|unique:keywords,name',
        ]);

        if ($validator->fails()) {
            return redirect('metadata/keywords/add')
                            ->withErrors($validator)
                            ->withInput();
        }

        $keyword = new Keyword();
        $keyword->name = $request->input('keyword_name');
        $keyword->save();

        return redirect('metadata/keywords/add')
                        ->with('success', 'Successfully Added!');
    }

    public function addLocation() {
        return view('metadata/locations/add');
    }

    public function saveLocation(Request $request) {
        $validator = Validator::make($request->all(), [
                    'location_name' => 'required|unique:locations,name',
        ]);

        if ($validator->fails()) {
            return redirect('metadata/locations/add')
                            ->withErrors($validator)
                            ->withInput();
        }

        $location = new Location();
        $location->name = $request->input('location_name');
        $location->save();

        return redirect('metadata/locations/add')
                        ->with('success', 'Successfully Added!');
    }

    public function listAll() {
        $keywords = Keyword::all();
        $locations = Location::all();
        return view('metadata/list')->with([
                    'keywords' => $keywords,
                    'locations' => $locations
        ]);
    }

}
