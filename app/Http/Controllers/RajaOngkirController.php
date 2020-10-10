<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use GuzzleHttp\Client;

class RajaOngkirController extends Controller
{

  public function getDistrict()
  {
    $districts = District::where('city_id', request()->city_id)->get();
    return response()->json(['status' => 'success', 'data' => $districts]);
  }

  public function getProvince(Request $request)
  {
    $url = env('ONGKIR_URL') . '/province';
    $client = new Client();
    $key = env('ONGKIR_KEY');

    if($request->id){
      $url = $url . "?id=" . $request->id;
    }

    $response = $client->request('GET', $url, [
      'headers' => [
        'Key' => $key
      ]
    ]);

    $body = json_decode($response->getBody(), true);
    return response()->json(['status' => 'success', 'data' => $body["rajaongkir"]["results"]]);
  }

  public function getCity(Request $request)
  {
    $url = env('ONGKIR_URL') . '/city';
    $client = new Client();
    $key = env('ONGKIR_KEY');

    if($request->province){
      $url = $url . "?province=" . $request->province;
    }

    $response = $client->request('GET', $url, [
      'headers' => [
        'Key' => $key
      ]
    ]);

    $body = json_decode($response->getBody(), true);
    return response()->json(['status' => 'success', 'data' => $body["rajaongkir"]["results"]]);
  }
}
