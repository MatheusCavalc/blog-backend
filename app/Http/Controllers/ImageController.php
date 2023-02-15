<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function getImage($path)
    {
        $image_path = 'storage/image/' . $path;
        return response()->file( $image_path );
    }
}
