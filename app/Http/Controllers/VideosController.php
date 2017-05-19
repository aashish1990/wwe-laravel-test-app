<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use function public_path;
use function redirect;
use function view;

class VideosController extends Controller {

    public function add() {
        return view('videos/add');
    }

    public function save(Request $request) {
        if ($request->hasFile('fileToUpload')) {
            $file = $request->file('fileToUpload');
            if ($file->getMimeType() == "video/mp4") {
                $this->validate($request, [
                    'title' => 'required|unique:videos',
                ]);

                $randName = Hash::make(Carbon::now()->timestamp);
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

}
