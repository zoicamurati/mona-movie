<?php

namespace App\Helper;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

function get_video()
{
    $fileContents = Storage::disk('local')->get("test.mp4");
    $response = Response::make($fileContents, 200);
    /*$response->header('Content-Type', "video/mp4");*/
    return $response;
}