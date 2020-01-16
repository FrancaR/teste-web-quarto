<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class GoogleMaps
{
    protected $key = null;

    protected $url = 'https://maps.googleapis.com/maps/api/';

    public function __construct()
    {
        $this->key = config('services.gmaps.key');
    }

    /**
     * Get the geocode by address.
     * 
     * @param string $address
     * @param string $neighborhood
     * @param string $city
     * @param string $state
     * 
     * @return array
     */
    public function byAddress(string $address, string $neighborhood, string $city, string $state): array
    {
        $this->url = $this->url . 'geocode/json';

        $response = json_decode($this->request(['address' => $address . ', ' . $neighborhood . ', ' . $city . ', ' . $state]), true);

        return [
            'lat' => Arr::get($response, 'results.0.geometry.location.lat'),
            'lng' => Arr::get($response, 'results.0.geometry.location.lng'),
        ];
    }

    /**
     * Get the address by geocode.
     * 
     * @param float $lat
     * @param float $lng
     * 
     * @return array
     */
    public function byGeocode(float $lat, float $lng)
    {
        $this->url = $this->url . 'geocode/json';

        $response = $this->request(['latlng' => $lat . ',' . $lng]);

        return Arr::get($response, 'results.formatted_address');
    }

    /**
     * Make request to Google Maps.
     * 
     * @param array $request
     * @return Psr\Http\Message\ResponseInterface
     */
    private function request(array $request)
    {
        $request = Arr::add($request, 'key', $this->key);

        $client = new Client();
        $response = $client->request('GET', $this->url, [
            'query' => $request
        ]);

        if ($response->getStatusCode() === 200) {
            return (string) $response->getBody();
        }

        report(404, 'Oops!');
    }
}