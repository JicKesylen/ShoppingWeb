<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Util\ApiResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function GetProduct() {
        $model = new product;
        $Product = $model -> GetAllData();
        $Product = json_decode($Product, true);
        Log::info($Product);
        return (new ApiResponse(true, "OK", 0, 200, $Product)) -> toJson();
    }
}
