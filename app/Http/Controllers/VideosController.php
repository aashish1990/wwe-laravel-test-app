<?php

namespace App\Http\Controllers;

use App\Keyword;
use App\Location;
use App\Video;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Request;
use function public_path;
use function redirect;
use function response;
use function view;

class VideosController extends Controller {

    public function all() {

        $videos = Video::with('keywords')
                ->get();

        foreach ($videos as $video) {
            if ($video->location_id != null) {
                $video["location"] = $video->location;
            }
        }

        $keywords = Keyword::all();
        $locations = Location::all();

        return view('videos/list')->with([
                    'videos' => $videos,
                    'keywords' => $keywords,
                    'locations' => $locations
        ]);
    }

    public function add() {
        return view('videos/add');
    }

    public function save(Request $request) {
        $this->validate($request, [
            'title' => 'required|unique:videos',
            'fileToUpload' => 'required'
        ]);
        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            if ($file->getMimeType() == "video/mp4") {

                $randName = Carbon::now()->timestamp;
                $file->move(public_path() . '/uploads/', $randName);

                $video = new Video();
                $video->title = $request->input('title');
                $video->filename = htmlspecialchars($file->getClientOriginalName());
                $video->url = 'uploads/' . $randName;
                $video->save();

                return redirect('videos/add')
                                ->with('success', 'Successfully uploaded!');
            } else {
                return Redirect::back()
                                ->withInput()
                                ->withErrors(['This is not in "mp4" format']);
            }
        }
    }

    public function assignKeyword($videoId, $keywordId) {
        try {
            $video = Video::findOrFail($videoId);
            $keyword = Keyword::findOrFail($keywordId);

            if ($video->keywords()->where('keywords.id', $keywordId)->exists()) {
                return response(null, 400);
            } else {
                $video->keywords()->attach($keywordId);
                return response(null, 200);
            }
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function unAssignKeyword($videoId, $keywordId) {
        try {
            $video = Video::findOrFail($videoId);
            $video->keywords()->detach($keywordId);
            return response(null, 200);
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function removeLocation($videoId) {
        try {
            $video = Video::findOrFail($videoId);
            $video->location_id = null;
            $video->save();
            return response(null, 200);
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function assignLocation($videoId, $locationId) {
        try {
            $video = Video::findOrFail($videoId);
            $location = Location::findOrFail($locationId);
            $video->location_id = $locationId;
            $video->save();
            return response(null, 200);
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function like($videoId) {
        try {
            $video = Video::findOrFail($videoId);
            $video->is_liked = true;
            $video->save();
            return response(null, 200);
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function dislike($videoId) {
        try {
            $video = Video::findOrFail($videoId);
            $video->is_liked = false;
            $video->save();
            return response(null, 200);
        } catch (ModelNotFoundException $ex) {
            return response(null, 404);
        }
    }

    public function likedVideos() {

        $videos = Video::where('is_liked', true)
                ->get();

        return view('videos/likedList')->with([
                    'videos' => $videos
        ]);
    }

}
