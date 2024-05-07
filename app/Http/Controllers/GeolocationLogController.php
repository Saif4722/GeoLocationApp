<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\IPGeolocationService;
use App\Models\GeolocationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class GeolocationLogController extends Controller
{
    /**
     * The IP geolocation service instance.
     *
     * @var \App\Services\IPGeolocationService
     */
    protected $geolocationService;


    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\IPGeolocationService  $geolocationService
     * @return void
     */
    public function __construct(IPGeolocationService $geolocationService)
    {
        $this->geolocationService = $geolocationService;
    }

    /**
     * Show the form to add IP address.
     *
     * @return \Illuminate\View\View
     */

    public function index(){
        return view('geolocation.addIpAddress');
    }

     /**
     * Store the geolocation information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */

    public function storeGeoLocation(Request $request)
    {
        $ipAddress = $request->input('ip_address');
        // Check if geolocation data is already cached
        $cachedGeoLocationData = Cache::get('geolocation:'.$ipAddress);
        
        if ($cachedGeoLocationData) {
            // Retrieve data from cache
            $geolocationData = $cachedGeoLocationData;
        } else { 
            // Fetch geolocation data
            $geolocationData = $this->geolocationService->fetchGeolocation($ipAddress);
            // Store geolocation data in the database and cache
            GeolocationLog::storeGeolocation($ipAddress, $geolocationData);
        }

        // Retrieve geolocation data from the database
        $geolocationLog = GeolocationLog::where('ip_address', $ipAddress)->first();
        $request->session()->flash('success', 'Geographic information fetched successfully.');
        return view('geolocation.showGeoLocation', ['geolocationLog' => $geolocationLog]);
    }

    /**
     * Show all geographic locations.
     *
     * @return \Illuminate\View\View
     */

    public function allGeographicLocations(){
        $allGeolocationLogInfo = GeolocationLog::all();
        return view('geolocation.showAllGeoLocation', ['allGeolocationLog' => $allGeolocationLogInfo]);
    }
}
