<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GeolocationLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'country',
        'region',
        'city',
        'latitude',
        'longitude',
    ];

    public static function storeGeolocation($ipAddress, $geolocationData)
    {
        // Cache the fetched data for 24 hours
        Cache::put('geolocation:'.$ipAddress, $geolocationData, now()->addHours(24));

        // Store the fetched data in the database
        return self::create([
            'ip_address' => $ipAddress,
            'country' => $geolocationData['country'] ?? null,
            'region' => $geolocationData['region'] ?? null,
            'city' => $geolocationData['city'] ?? null,
            'latitude' => $geolocationData['latitude'] ?? null,
            'longitude' => $geolocationData['longitude'] ?? null,
        ]);
    }
}
