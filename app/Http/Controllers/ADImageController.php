<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adimage;
use App\Util\ApiResponse;
use Illuminate\Support\Facades\Log;

class ADImageController extends Controller
{
    public function GetADImage() {
        $ImageUrl = adimage::pluck('ImageURL') -> all();
        return (new ApiResponse(true, "", 0, 200, $ImageUrl)) -> toJson();
    }
}
