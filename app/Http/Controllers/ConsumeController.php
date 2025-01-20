<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConsumeController extends Controller
{
    public function index()
    {
        // $apiKey = 'test_tf5WlMc5yVwKWk6dsQoeS4Qmz9mCkk8rZVnzCjjZ';
        //     $apiUrl = 'https://api.zippopotam.us/us/33162';
        //     $response = Http::get($apiUrl, [
        //         'api_key' => $apiKey,
        //         // Add other parameters as needed
        //     ]);
        //     $data = $response->json();
        //     return view('consume', ['data' => $data]);

        $apiUrl = 'https://futuramaapi.com/api/characters';
        $response = Http::get($apiUrl, [
            'morgan' => 'Morgan Proctor'
        ]);



        $data = $response->json();
        return view('consume', ['data' => $data]);
    }
}
