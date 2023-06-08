<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Util\ApiResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function GetProduct() {
        $Product = Product::all();
        $Product = json_decode($Product, true);
        return (new ApiResponse(true, "", 0, 200, $Product)) -> toJson();
    }
}
