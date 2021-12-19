<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function getVideo()
    {

        if (Auth::check()) {
        $fileContents = Storage::disk('local')->get("test.mp4");
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;

    }
    }
}
