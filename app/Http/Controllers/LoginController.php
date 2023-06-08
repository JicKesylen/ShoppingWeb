<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\ApiResponse;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    public function SignUp(Request $request) {
        try{
            $exists = User::where('email', $request -> Email) -> exists();
            if($exists) {
                return (new ApiResponse(false, "Email已被使用", 100001)) -> toJson();
            } else {
                $UserModel = new User;
                $UserModel -> Email = $request -> Email;
                $UserModel -> Password = bcrypt($request -> Password);
                $UserModel -> save();
                return (new ApiResponse(true, "", 0, 200)) -> toJson();
            }
        }
        catch (Exception $e) {
            Log::debug($e);
        }
    }
}
