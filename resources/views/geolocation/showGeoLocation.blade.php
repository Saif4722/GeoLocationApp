<!-- resources/views/geolocation/showGeoLocation.blade.php -->
@extends('geolocation.layouts.app')

@section('title', 'Geolocation Information')

@section('content')
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Geolocation Information</h1>
        @if($geolocationLog)
            <ul>
                <li><i class="fas fa-globe label-icon"></i> <span class="label">IP Address:</span> <span class="value">{{ $geolocationLog->ip_address }}</span></li>
                <li><i class="fas fa-flag label-icon"></i> <span class="label">Country:</span> <span class="value">{{ $geolocationLog->country }}</span></li>
                <li><i class="fas fa-map-marker-alt label-icon"></i> <span class="label">Region:</span> <span class="value">{{ $geolocationLog->region }}</span></li>
                <li><i class="fas fa-city label-icon"></i> <span class="label">City:</span> <span class="value">{{ $geolocationLog->city }}</span></li>
                <li><i class="fas fa-map-marked-alt label-icon"></i> <span class="label">Latitude:</span> <span class="value">{{ $geolocationLog->latitude }}</span></li>
                <li><i class="fas fa-map-marked label-icon"></i> <span class="label">Longitude:</span> <span class="value">{{ $geolocationLog->longitude }}</span></li>
            </ul>
            <!-- Map section -->
            <div id="map" style="height: 400px;"></div>
        @else
            <p>No geolocation information available.</p>
        @endif
        
        <!-- Buttons section -->
        <div class="mt-4">
            <a href="{{ route('index') }}" class="btn btn-primary">Check with Another IP</a>
            <a href="{{ route('allGeographicLocations') }}" class="btn btn-secondary">All Geographic Locations</a>
        </div>

    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* Your specific CSS styles for this view here */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        li:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #333;
        }
        .value {
            color: #666;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var latitude = {{ $geolocationLog->latitude }};
        var longitude = {{ $geolocationLog->longitude }};
        
        var map = L.map('map').setView([latitude, longitude], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        
        var marker = L.marker([latitude, longitude]).addTo(map);
    </script>
@endpush

