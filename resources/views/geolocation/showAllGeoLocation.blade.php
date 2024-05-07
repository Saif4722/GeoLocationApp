@extends('geolocation.layouts.app')

@section('title', 'All Georaphic Information')

@section('content')
    
    <div class="container">
        <h1>Geolocation Information</h1>
        <table class="table">
            <thead>
                <tr>
                    <th><i class="fas fa-globe label-icon"></i> IP Address</th>
                    <th><i class="fas fa-flag label-icon"></i> Country</th>
                    <th><i class="fas fa-map-marker-alt label-icon"></i> Region</th>
                    <th><i class="fas fa-city label-icon"></i> City</th>
                    <th><i class="fas fa-map-marked-alt label-icon"></i> Latitude</th>
                    <th><i class="fas fa-map-marked label-icon"></i> Longitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allGeolocationLog as $geolocationLog)
                <tr>
                    <td>{{ $geolocationLog->ip_address }}</td>
                    <td>{{ $geolocationLog->country }}</td>
                    <td>{{ $geolocationLog->region }}</td>
                    <td>{{ $geolocationLog->city }}</td>
                    <td>{{ $geolocationLog->latitude }}</td>
                    <td>{{ $geolocationLog->longitude }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Buttons section -->
        <div class="mt-4">
            <a href="{{ route('index') }}" class="btn btn-primary">Check with Another IP</a>
            <!-- <a href="{{ route('index') }}" class="btn btn-secondary">All Geographic Locations</a> -->
        </div>

    </div>
@endsection

@push('styles')
    <style>
        /* Your specific CSS styles for this view here */
        .container {
            max-width: 1000;
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
