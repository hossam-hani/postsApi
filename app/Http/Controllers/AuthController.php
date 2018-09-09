<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;
class AuthController extends Controller
{
    public function register(Request $request){
        
        // validation 
        
        // import User To DB
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Get The Token
        $http = new Client;

        $response = $http->post('http://posts.dev.hossam/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'lU7g1t8TrtkiveTpLmpmAo4JIw1inVp3dvH7WvNY',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);



    }
}
