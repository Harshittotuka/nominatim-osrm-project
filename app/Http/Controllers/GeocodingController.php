<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GeocodingController extends Controller
{
    private $nominatimUrl = 'https://nominatim.openstreetmap.org/search.php';

    public function getCoordinates(Request $request)
    {
        $address = $request->input('address');
        
        $client = new Client();
        $response = $client->get($this->nominatimUrl, [
            'query' => [
                'q' => $address,
                'format' => 'json',
                'limit' => 1
            ],
            'headers' => [
                'User-Agent' => 'your-app-name/1.0 (your-email@example.com)'
            ]
        ]);
        $data = json_decode($response->getBody(), true);

        if (!isset($data[0])) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        $lat = $data[0]['lat'];
        $lon = $data[0]['lon'];

        return response()->json([
            'latitude' => $lat,
            'longitude' => $lon
        ]);
    }

    public function getSuggestions(Request $request)
    {
        $query = $request->input('query');
    
        if (empty($query)) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }
    
        $nominatimUrl = 'https://nominatim.openstreetmap.org/search.php';
        $client = new \GuzzleHttp\Client();
        
        try {
            $response = $client->get($nominatimUrl, [
                'query' => [
                    'q' => $query,
                    'format' => 'json',
                    'addressdetails' => 1,
                    'limit' => 5
                ],
                'headers' => [
                    'User-Agent' => 'your-app-name/1.0 (your-email@example.com)'
                ]
            ]);
    
            $data = json_decode($response->getBody(), true);
    
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch suggestions'], 500);
        }
    }
    
}
