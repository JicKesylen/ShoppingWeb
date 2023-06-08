<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ADImage;
use App\Util\ApiResponse;
use Illuminate\Support\Facades\Log;

class ADImageController extends Controller
{
    public function GetADImage() {
        $ImageUrl = ADImage::pluck('ImageURL') -> all();
        return (new ApiResponse(true, "", 0, 200, $ImageUrl)) -> toJson();
    }
}
