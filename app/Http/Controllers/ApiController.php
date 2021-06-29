<?php

namespace App\Http\Controllers;

use App\Models\User;

//use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as BaseClient;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function register(Request $request){

        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('TutsForWeb')->accessToken;

        return response()->json(['token' => $token], 200);
        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt( $request->password);
        // $user->save();


        // $response = Http::post('http://localhost/laravelVuejsPos/public/oauth/token',[
        //     'form_params' => [
        //         'grant_type' => 'password',
        //         'client_id' => '2',
        //         'client_secret' => 'KxPbKZ1w2qCqc34Lx8SRpqiomSsd5P3bozvGwgE9',
        //         'username' => $request->name,
        //         'password' => $request->password,
        //         'scope' => '',
        //     ],

        // ]);
        // return json_decode((string) $response->getBody(),true);
    }


    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('TutsForWeb')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
