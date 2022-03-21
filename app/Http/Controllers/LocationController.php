<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;


class LocationController extends Controller
{
    public function lokasi(Request $request)
    {
        $ip = $request->ip(); /* Dynamic IP address */
        /*$ip = '180.253.165.229';  Static IP address */
        $currentUserInfo = Location::get($ip);

        return view('absensi/lokasi', compact('currentUserInfo'));
    }
}
