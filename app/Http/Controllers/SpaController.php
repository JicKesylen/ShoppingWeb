<?php

namespace App\Http\Controllers;

class SpaController extends Controller
{
    public function index()
    {
        $maintaining = config("env.MIX_MAINTAIN", false);
        if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }
        $allow_ips = config("env.MIX_MAINTAIN_ALLOW_IPS", "");
        $allow_ips = explode(",", $allow_ips);

        $packageStr = file_get_contents('../package.json');
        $package = (array)json_decode($packageStr);
        $version = $package["version"];
        $fileExists = file_exists("js/$version/app.js");
        if (!$fileExists) {
            return view('maintain', ["message" => config("env.MIX_MAINTAIN_MESSAGE", "系統維護中, 請稍後再試")]);
        }
        if ((!$maintaining || in_array($ip, $allow_ips))) {
            return view('spa');
        }
        return view('maintain', ["message" => config("env.MIX_MAINTAIN_MESSAGE", "系統維護中")]);

        // $notallowed_hosts = array('local.foresee');
        // if ($maintaining && (!isset($_SERVER['HTTP_HOST']) || in_array($_SERVER['HTTP_HOST'], $notallowed_hosts))) {
        //     return view('maintain');
        // }
    }
}
